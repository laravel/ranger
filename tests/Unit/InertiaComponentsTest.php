<?php

use Laravel\Ranger\Collectors\InertiaComponents;
use Laravel\Ranger\Components\InertiaResponse;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\IntType;
use Laravel\Surveyor\Types\StringType;

beforeEach(function () {
    $reflection = new ReflectionClass(InertiaComponents::class);
    $property = $reflection->getProperty('components');
    $property->setValue(null, []);
});

describe('InertiaComponents static class', function () {
    it('can add and retrieve components', function () {
        $data = new ArrayType(['title' => new StringType]);
        InertiaComponents::addComponent('Dashboard', $data);

        $component = InertiaComponents::getComponent('Dashboard');

        expect($component)->toBeInstanceOf(InertiaResponse::class);
        expect($component->component)->toBe('Dashboard');
        expect($component->data)->toBeArray();
        expect($component->data)->toHaveKey('title');
        expect($component->data['title'])->toBeInstanceOf(StringType::class);
        expect($component->data['title']->isOptional())->toBeFalse();
    });

    it('returns empty data for non-existent components', function () {
        $component = InertiaComponents::getComponent('NonExistent');

        expect($component)->toBeInstanceOf(InertiaResponse::class);
        expect($component->component)->toBe('NonExistent');
        expect($component->data)->toBe([]);
    });

    it('merges data from multiple additions of same component', function () {
        $data1 = new ArrayType(['title' => new StringType]);
        $data2 = new ArrayType(['count' => new IntType]);

        InertiaComponents::addComponent('Page', $data1);
        InertiaComponents::addComponent('Page', $data2);

        $component = InertiaComponents::getComponent('Page');

        expect($component->data)->toHaveKey('title');
        expect($component->data)->toHaveKey('count');
        expect($component->data['title']->isOptional())->toBeTrue();
        expect($component->data['count']->isOptional())->toBeTrue();
    });
});
