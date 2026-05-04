<?php

use App\Models\DocBlockBinding;
use App\Models\User;
use Laravel\Ranger\Support\RouteParameter;
use Laravel\Surveyor\Types\IntType;
use Laravel\Surveyor\Types\StringType;
use Laravel\Surveyor\Types\Type;

describe('Parameter component', function () {
    it('can be instantiated with basic properties', function () {
        $param = new RouteParameter('user', false, null, null);

        expect($param->name)->toBe('user');
        expect($param->optional)->toBeFalse();
        expect($param->key)->toBeNull();
        expect($param->default)->toBeNull();
    });

    it('generates placeholder for required parameters', function () {
        $param = new RouteParameter('user', false, null, null);

        expect($param->placeholder)->toBe('{user}');
    });

    it('generates placeholder for optional parameters', function () {
        $param = new RouteParameter('user', true, null, null);

        expect($param->placeholder)->toBe('{user?}');
    });

    it('stores the binding key', function () {
        $param = new RouteParameter('user', false, 'uuid', null);

        expect($param->key)->toBe('uuid');
    });

    it('stores the default value', function () {
        $param = new RouteParameter('locale', true, null, 'en');

        expect($param->default)->toBe('en');
    });

    it('has default types when no bound parameter', function () {
        $param = new RouteParameter('id', false, null, null);

        expect($param->types)->toEqual([Type::string(), Type::number()]);
    });

    it('resolves bound model parameter type from the database schema', function () {
        $reflection = new ReflectionFunction(fn (User $user) => null);
        $bound = $reflection->getParameters()[0];

        $param = new RouteParameter('user', false, null, null, $bound);

        expect($param->types)->toHaveCount(1);
        expect($param->types[0])->toBeInstanceOf(IntType::class);
        expect($param->key)->toBe('id');
    });

    it('falls back to model docblock @property tags when the schema is unavailable', function () {
        // DocBlockBinding points at a table that does not exist in migrations,
        // so ModelInspector throws and only the @property docblock is available.
        $reflection = new ReflectionFunction(fn (DocBlockBinding $binding) => null);
        $bound = $reflection->getParameters()[0];

        $param = new RouteParameter('binding', false, null, null, $bound);

        expect($param->types)->toHaveCount(1);
        expect($param->types[0])->toBeInstanceOf(IntType::class);
        expect($param->key)->toBe('id');
    });

    it('resolves an explicit string key via the model docblock', function () {
        $reflection = new ReflectionFunction(fn (DocBlockBinding $binding) => null);
        $bound = $reflection->getParameters()[0];

        $param = new RouteParameter('binding', false, 'slug', null, $bound);

        expect($param->types)->toHaveCount(1);
        expect($param->types[0])->toBeInstanceOf(StringType::class);
        expect($param->key)->toBe('slug');
    });
});
