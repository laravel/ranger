<?php

use Laravel\Ranger\Support\RouteParameter;
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
});
