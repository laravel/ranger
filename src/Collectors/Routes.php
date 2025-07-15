<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Routing\Route as BaseRoute;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\Route;
use ReflectionProperty;

class Routes extends Collector
{
    private ?string $forcedScheme;

    private ?string $forcedRoot;

    private $urlDefaults = [];

    public function __construct(
        private Router $router,
        private UrlGenerator $url,
    ) {
        $this->forcedScheme = (new ReflectionProperty($this->url, 'forceScheme'))->getValue($this->url);
        $this->forcedRoot = (new ReflectionProperty($this->url, 'forcedRoot'))->getValue($this->url);
    }

    public function collect(): Collection
    {
        return collect($this->router->getRoutes())->map($this->mapToRoute(...));
    }

    protected function mapToRoute(BaseRoute $route): Route
    {
        $defaults = collect($this->router->gatherRouteMiddleware($route))
            ->map($this->collectMiddlewareDefaults(...))
            ->flatMap(fn($r) => $r);

        $newRoute = new Route($route, $defaults, $this->forcedScheme, $this->forcedRoot);

        $requestValidator = app(FormRequests::class)->parseRequest($route->getAction());

        if ($requestValidator) {
            $newRoute->setRequestValidator($requestValidator);
        }

        $possibleResponses = [];

        $inertiaResponses = app(InertiaData::class)->parseResponse($route->getAction());

        if (count($inertiaResponses) > 0) {
            // TODO: What about scenarios where the same component is returned from multiple routes
            array_push($possibleResponses, ...$inertiaResponses);
        }

        $newRoute->setPossibleResponses($possibleResponses);

        return $newRoute;
    }

    protected function collectMiddlewareDefaults($middleware): array
    {
        if ($middleware instanceof \Closure) {
            return [];
        }

        $this->urlDefaults[$middleware] ??= $this->getDefaultsForMiddleware($middleware);

        return $this->urlDefaults[$middleware];
    }

    private function getDefaultsForMiddleware(string $middleware)
    {
        if (! class_exists($middleware)) {
            return [];
        }

        $reflection = new \ReflectionClass($middleware);

        if (! $reflection->hasMethod('handle')) {
            return [];
        }

        $method = $reflection->getMethod('handle');

        // Get the file name and line numbers
        $fileName = $method->getFileName();
        $startLine = $method->getStartLine();
        $endLine = $method->getEndLine();

        // Read the file and extract the method contents
        $lines = file($fileName);
        $methodContents = implode('', array_slice($lines, $startLine - 1, $endLine - $startLine + 1));

        if (! str_contains($methodContents, 'URL::defaults')) {
            return [];
        }

        $methodContents = str($methodContents)->after('{')->beforeLast('}')->trim();
        $tokens = token_get_all('<?php ' . $methodContents);
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
