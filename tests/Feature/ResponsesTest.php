<?php

use Laravel\Ranger\Collectors\Routes;
use Laravel\Ranger\Components\JsonApiResponse;
use Laravel\Ranger\Components\JsonResponse;
use Laravel\Ranger\Components\ResourceResponse;
use Laravel\Ranger\Components\Route;

beforeEach(function () {
    $this->routes = app(Routes::class)->collect();
});

function ranger_route(string $name): Route
{
    return test()->routes->first(fn (Route $r) => $r->name() === $name);
}

describe('resource responses', function () {
    it('captures Eloquent API resources', function () {
        $route = ranger_route('resources.users.show');
        $responses = $route->possibleResponses();

        expect($responses)->toHaveCount(1);
        expect($responses[0])->toBeInstanceOf(ResourceResponse::class);
        expect($responses[0]->resourceClass)->toBe('App\\Http\\Resources\\UserResource');
        expect($responses[0]->isCollection)->toBeFalse();
        expect($responses[0]->wrap)->toBe('data');
        expect(array_keys($responses[0]->data))->toEqual(['id', 'name', 'email']);
    });

    it('captures Eloquent API resource collections', function () {
        $route = ranger_route('resources.users.index');
        $responses = $route->possibleResponses();

        expect($responses)->toHaveCount(1);
        expect($responses[0])->toBeInstanceOf(ResourceResponse::class);
        expect($responses[0]->resourceClass)->toBe('App\\Http\\Resources\\UserResource');
        expect($responses[0]->isCollection)->toBeTrue();
    });

    it('captures JSON:API resource responses', function () {
        $route = ranger_route('resources.users.json-api');
        $responses = $route->possibleResponses();

        expect($responses)->toHaveCount(1);
        expect($responses[0])->toBeInstanceOf(JsonApiResponse::class);
        expect($responses[0]->resourceClass)->toBe('App\\Http\\Resources\\UserJsonApiResource');
        expect($responses[0]->isCollection)->toBeFalse();
        expect(array_keys($responses[0]->attributes))->toEqual(['name', 'email']);
    });

    it('captures arrayable DTOs as JSON responses', function () {
        $route = ranger_route('resources.checkout');
        $responses = $route->possibleResponses();

        expect($responses)->toHaveCount(1);
        expect($responses[0])->toBeInstanceOf(JsonResponse::class);
        expect(array_keys($responses[0]->data))->toEqual(['total', 'currency']);
    });

    it('ignores classes that are not arrayable', function () {
        $route = ranger_route('resources.plain');

        expect($route->possibleResponses())->toBe([]);
    });
});
