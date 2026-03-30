<?php

namespace Laravel\Ranger\Collectors;

use Closure;
use Laravel\Ranger\Components\JsonResponse;
use Laravel\Ranger\Components\ResourceResponse;
use Laravel\Ranger\Support\AnalyzesRoutes;
use Laravel\Surveyor\Analyzed\MethodResult;
use Laravel\Surveyor\Analyzer\Analyzer;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\Contracts\MultiType;
use Laravel\Surveyor\Types\Entities\InertiaRender;
use Laravel\Surveyor\Types\Entities\ResourceResponse as SurveyorResourceResponse;

class Response
{
    use AnalyzesRoutes;

    public function __construct(protected Analyzer $analyzer)
    {
        //
    }

    /**
     * @return list<InertiaResponse|JsonResponse>
     */
    public function parseResponse(array $action): array
    {
        $result = $this->analyzeRoute($action);

        if (! $result) {
            return [];
        }

        return array_merge(
            $this->getInertiaResponse($result),
            $this->getJsonResponse($result),
            $this->getResourceResponse($result),
        );
    }

    protected function getInertiaResponse(MethodResult $result): array
    {
        /** @var InertiaRender[] $responses */
        $responses = $this->filterReturnTypesFor(
            $result,
            fn ($type) => $type instanceof InertiaRender,
        );

        foreach ($responses as $response) {
            InertiaComponents::addComponent($response->view, $response->data);
        }

        return array_map(fn ($response) => $response->view, $responses);
    }

    protected function getJsonResponse(MethodResult $result): array
    {
        /** @var ArrayType[] $responses */
        $responses = $this->filterReturnTypesFor(
            $result,
            fn ($type) => $type instanceof ArrayType,
        );

        return array_map(fn ($response) => new JsonResponse($response->value), $responses);
    }

    protected function getResourceResponse(MethodResult $result): array
    {
        /** @var SurveyorResourceResponse[] $responses */
        $responses = $this->filterReturnTypesFor(
            $result,
            fn ($type) => $type instanceof SurveyorResourceResponse,
        );

        return array_map(fn ($response) => new ResourceResponse(
            resourceClass: $response->resourceClass,
            data: $response->data instanceof ArrayType ? $response->data->value : [],
            isCollection: $response->isCollection,
            wrap: $response->wrap,
            additional: $response->additional instanceof ArrayType ? $response->additional->value : [],
        ), $responses);
    }

    protected function filterReturnTypesFor(MethodResult $result, Closure $filter): array
    {
        $returnType = $result->returnType();
        $returnTypes = ($returnType instanceof MultiType) ? $returnType->types : [$returnType];

        return array_values(array_filter($returnTypes, $filter));
    }
}
