<?php

use Laravel\Ranger\Collectors\Response;
use Laravel\Surveyor\Analyzed\MethodResult;
use Laravel\Surveyor\Analyzer\Analyzer;
use Laravel\Surveyor\Types\Contracts\Type as TypeContract;
use Laravel\Surveyor\Types\Entities\ResourceResponse;
use Laravel\Surveyor\Types\Type;

it('preserves resource payload types', function (TypeContract $data) {
    $result = new MethodResult('show');
    $result->addReturnType(new ResourceResponse(
        resourceClass: 'App\\Http\\Resources\\UserResource',
        data: $data,
    ), 1);

    $collector = new class(app(Analyzer::class)) extends Response
    {
        public function getResourceResponse(MethodResult $result): array
        {
            return parent::getResourceResponse($result);
        }
    };

    $responses = $collector->getResourceResponse($result);

    expect($responses)->toHaveCount(1);
    expect($responses[0]->data)->toEqual($data);
})->with([
    'list' => fn () => Type::arrayShape(Type::int(), Type::array(['id' => Type::int()])),
    'keyed collection' => fn () => Type::arrayShape(Type::string(), Type::array(['id' => Type::int()])),
    'union' => fn () => Type::union(
        Type::array(['id' => Type::int()]),
        Type::array(['message' => Type::string()]),
    ),
]);
