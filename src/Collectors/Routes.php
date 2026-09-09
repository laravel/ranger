<?php

namespace Laravel\Ranger\Collectors;

use Closure;
use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Illuminate\Routing\Route as BaseRoute;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Ranger\Components\Route;
use Laravel\Ranger\Support\Config;
use Laravel\Ranger\Support\Ignores;
use ReflectionClass;
use ReflectionProperty;

class Routes extends Collector
{
    protected ?string $forcedScheme;

    protected ?string $forcedRoot;

    protected $urlDefaults = [];

    protected $universalUrlDefaults = [];

    protected $globalMiddleware = [];

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
        $this->syncMiddlewareFromHttpKernel();
        $this->collectProviderUrlDefaults();

        return collect($this->router->getRoutes())
            ->filter($this->filterRoute(...))
            ->map($this->mapToRoute(...))
            ->map($this->resolveResponses(...));
    }

    protected function syncMiddlewareFromHttpKernel(): void
    {
        if (! app()->bound(HttpKernel::class)) {
            return;
        }

        $groups = $this->router->getMiddlewareGroups();
        $aliases = $this->router->getMiddleware();

        // Resolving the kernel syncs its middleware onto the router, overwriting existing groups
        $kernel = app(HttpKernel::class);

        foreach ($groups as $group => $middleware) {
            foreach ($middleware as $name) {
                $this->router->pushMiddlewareToGroup($group, $name);
            }
        }

        foreach ($aliases as $name => $class) {
            $this->router->aliasMiddleware($name, $class);
        }

        // Global middleware is never synced to the router, and the getter is not on the kernel contract
        if (method_exists($kernel, 'getGlobalMiddleware')) {
            $this->globalMiddleware = $kernel->getGlobalMiddleware();
        }
    }

    protected function collectProviderUrlDefaults(): void
    {
        $discovered = $this->inventory()->classesExtending(ServiceProvider::class);

        foreach ($discovered as $class) {
            $this->universalUrlDefaults = array_merge(
                $this->universalUrlDefaults,
                $this->getDefaultsFromClassMethod($class, 'register'),
                $this->getDefaultsFromClassMethod($class, 'boot'),
            );
        }

        foreach ($this->globalMiddleware as $middleware) {
            $this->universalUrlDefaults = array_merge(
                $this->universalUrlDefaults,
                $this->collectMiddlewareDefaults($middleware),
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

        if ($this->actionIsMarkedIgnored($route)) {
            return false;
        }

        return count($this->ignoreUrls) === 0 || ! Str::is($this->ignoreUrls, $route->uri());
    }

    protected function actionIsMarkedIgnored(BaseRoute $route): bool
    {
        $controller = $route->getControllerClass();

        if (! $controller || ! class_exists(ltrim($controller, '\\'))) {
            return false;
        }

        $reflection = new ReflectionClass(ltrim($controller, '\\'));

        if (Ignores::marked($reflection)) {
            return true;
        }

        $method = $route->getActionMethod();

        return $reflection->hasMethod($method) && Ignores::marked($reflection->getMethod($method));
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

    /**
     * Unwrap a quoted token, leaving quotes that belong to the value itself in place.
     */
    protected function tokenValue(string $token): string
    {
        $quote = $token[0] ?? '';

        if (strlen($token) < 2 || ! in_array($quote, ["'", '"']) || ! str_ends_with($token, $quote)) {
            return $token;
        }

        $contents = substr($token, 1, -1);

        return $quote === "'"
            ? preg_replace('/\\\\([\\\\\'])/', '$1', $contents)
            : stripcslashes($contents);
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

                $isString = is_array($valueToken) && $valueToken[0] === T_CONSTANT_ENCAPSED_STRING;
                $value = $this->tokenValue($valueToken[1]);

                if (! $isString) {
                    $value = match ($value) {
                        'true' => 1,
                        'false' => 0,
                        default => $value,
                    };
                }

                $defaults[$this->tokenValue($previousToken[1])] = $value;
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
