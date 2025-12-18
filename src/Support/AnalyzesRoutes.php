<?php

namespace Laravel\Ranger\Support;

use Closure;
use Laravel\Surveyor\Analyzed\MethodResult;
use Laravel\Surveyor\Debug\Debug;

trait AnalyzesRoutes
{
    protected function analyzeRoute(array $action): ?MethodResult
    {
        if ($action['uses'] instanceof Closure) {
            return null;
        }

        $uses = @unserialize($action['uses']) ?: $action['uses'];

        if (! is_string($uses)) {
            return null;
        }

        [$controller, $method] = explode('@', $uses);
        $analyzed = $this->analyzer->analyzeClass($controller)->result();

        if (! $analyzed->hasMethod($method)) {
            Debug::log("Method `{$method}` not found in class `{$controller}`");

            return null;
        }

        $result = $analyzed->getMethod($method);

        if (! $result instanceof MethodResult) {
            return null;
        }

        return $result;
    }
}
