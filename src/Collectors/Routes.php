<?php

namespace Laravel\Ranger\Collectors;

use Closure;
use Illuminate\Routing\Route as BaseRoute;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Ranger\Components\Route;
use Laravel\Ranger\Support\Config;
use ReflectionClass;
use ReflectionProperty;
use Spatie\StructureDiscoverer\Discover;

class Routes extends Collector
{
    protected ?string $forcedScheme;

    protected ?string $forcedRoot;

    protected $urlDefaults = [];

    protected $universalUrlDefaults = [];

    protected array $ignoreNames = [];

    protected array $ignoreUrls = [];

    public function __construct(
        protected Router $router,
        protected UrlGenerator $url,
        protected Response $responseCollector,
        protected FormRequests $formRequestCollector,
    ) {
        $this->forcedScheme = $this->getUrlGeneratorProp('forceScheme');
        $this->forcedRoot = $this->getUrlGeneratorProp('forcedRoot');
        $this->ignoreNames = Config::get('routes.ignore_names', []);
        $this->ignoreUrls = Config::get('routes.ignore_urls', []);
    }

    /**
     * @return Collection<Route>
     */
    public function collect(): Collection
    {
        $this->collectProviderUrlDefaults();

        return collect($this->router->getRoutes())
            ->filter($this->filterRoute(...))
            ->map($this->mapToRoute(...))
            ->map($this->resolveResponses(...));
    }

    protected function collectProviderUrlDefaults(): void
    {
        $discovered = Discover::in(...$this->appPaths)
            ->classes()
            ->extending(ServiceProvider::class)
            ->get();

        foreach ($discovered as $class) {
            $this->universalUrlDefaults = array_merge(
                $this->universalUrlDefaults,
                $this->getDefaultsFromClassMethod($class, 'register'),
                $this->getDefaultsFromClassMethod($class, 'boot'),
            );
        }
    }

    protected function getUrlGeneratorProp(string $prop): mixed
    {
        return (new ReflectionProperty($this->url, $prop))->getValue($this->url);
    }

    protected function filterRoute(BaseRoute $route): bool
    {
        if ($route->getName() && count($this->ignoreNames) > 0 && Str::is($this->ignoreNames, $route->getName())) {
            return false;
        }

        return count($this->ignoreUrls) === 0 || ! Str::is($this->ignoreUrls, $route->uri());
    }

    protected function resolveResponses(Route $route): Route
    {
        $route->setPossibleResponses(
            array_map(
                fn ($response) => is_string($response) ? InertiaComponents::getComponent($response) : $response,
                $route->possibleResponses(),
            ),
        );

        return $route;
    }

    protected function mapToRoute(BaseRoute $route): Route
    {
        $defaults = collect($this->router->gatherRouteMiddleware($route))
            ->map($this->collectMiddlewareDefaults(...))
            ->flatMap(fn ($r) => $r);

        $component = new Route($route, collect($this->universalUrlDefaults)->merge($defaults), $this->forcedScheme, $this->forcedRoot);

        $component->setBasePaths(...$this->basePaths)->setAppPaths(...$this->appPaths);

        if ($requestValidator = $this->formRequestCollector->getValidator($route->getAction())) {
            $component->setRequestValidator($requestValidator);
        }

        $component->setPossibleResponses(
            $this->responseCollector->parseResponse($route->getAction()),
        );

        return $component;
    }

    protected function collectMiddlewareDefaults($middleware): array
    {
        if ($middleware instanceof Closure) {
            return [];
        }

        return $this->urlDefaults[$middleware] ??= $this->getDefaultsFromClassMethod($middleware, 'handle');
    }

    protected function getDefaultsFromClassMethod(string $class, string $method)
    {
        if (! class_exists($class)) {
            return [];
        }

        $reflection = new ReflectionClass($class);

        if (! $reflection->hasMethod($method)) {
            return [];
        }

        $methodReflection = $reflection->getMethod($method);

        // Get the file name and line numbers
        $fileName = $methodReflection->getFileName();
        $startLine = $methodReflection->getStartLine();
        $endLine = $methodReflection->getEndLine();

        // Read the file and extract the method contents
        $lines = file($fileName);
        $methodContents = implode('', array_slice($lines, $startLine - 1, $endLine - $startLine + 1));

        if (! str_contains($methodContents, 'URL::defaults')) {
            return [];
        }

        $methodContents = str($methodContents)->after('{')->beforeLast('}')->trim();
        $tokens = token_get_all('<?php '.$methodContents);
        $foundUrlFacade = false;
        $defaults = [];
        $inArray = false;

        foreach ($tokens as $index => $token) {
            if (is_array($token) && token_name($token[0]) === 'T_STRING') {
                if (
                    $token[1] === 'URL'
                    && is_array($tokens[$index + 1])
                    && $tokens[$index + 1][1] === '::'
                    && is_array($tokens[$index + 2])
                    && $tokens[$index + 2][1] === 'defaults'
                ) {
                    $foundUrlFacade = true;
                }
            }

            if (! $foundUrlFacade) {
                continue;
            }

            if ((is_array($token) && $token[0] === T_ARRAY) || $token === '[') {
                $inArray = true;
            }

            // If we are in an array context and the token is a string (key)
            if (! $inArray) {
                continue;
            }

            if (is_array($token) && $token[0] === T_DOUBLE_ARROW) {
                $count = 1;
                $previousToken = $tokens[$index - $count];

                // Work backwards to get the key
                while (is_array($previousToken) && $previousToken[0] === T_WHITESPACE) {
                    $count++;
                    $previousToken = $tokens[$index - $count];
                }

                $valueToken = $tokens[$index + 1];
                $count = 1;

                // Work backwards to get the key
                while (is_array($valueToken) && $valueToken[0] === T_WHITESPACE) {
                    $count++;
                    $valueToken = $tokens[$index + $count];
                }

                $value = trim($valueToken[1], "'\"");

                $value = match ($value) {
                    'true' => 1,
                    'false' => 0,
                    default => $value,
                };

                $defaults[trim($previousToken[1], "'\"")] = $value;
            }

            // Check for the closing bracket of the array
            if ($token === ']') {
                $inArray = false;
                break;
            }
        }

        return $defaults;
    }
}
