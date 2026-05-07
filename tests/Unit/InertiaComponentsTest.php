<?php

use Laravel\Ranger\Collectors\InertiaComponents;
use Laravel\Ranger\Components\InertiaResponse;
use Laravel\Surveyor\Types\ArrayShapeType;
use Laravel\Surveyor\Types\ArrayType;
use Laravel\Surveyor\Types\BoolType;
use Laravel\Surveyor\Types\IntType;
use Laravel\Surveyor\Types\StringType;
use Laravel\Surveyor\Types\Type;
use Laravel\Surveyor\Types\UnionType;

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

    it('merges nested array props marking unique keys as optional', function () {
        // Route 1: stats has users + canRegister
        $data1 = new ArrayType([
            'stats' => new ArrayType([
                'users' => new IntType,
                'canRegister' => new BoolType,
            ]),
        ]);

        // Route 2: stats has only users
        $data2 = new ArrayType([
            'stats' => new ArrayType([
                'users' => new IntType,
            ]),
        ]);

        InertiaComponents::addComponent('Dashboard', $data1);
        InertiaComponents::addComponent('Dashboard', $data2);

        $component = InertiaComponents::getComponent('Dashboard');

        expect($component->data)->toHaveKey('stats');
        expect($component->data['stats'])->toBeInstanceOf(ArrayType::class);

        $stats = $component->data['stats']->value;

        expect($stats)->toHaveKey('users');
        expect($stats)->toHaveKey('canRegister');

        // users is in both routes, should be required
        expect($stats['users']->isOptional())->toBeFalse();

        // canRegister is only in first route, should be optional
        expect($stats['canRegister']->isOptional())->toBeTrue();
    });

    it('merges a prop whose type changes between an array and a non-array across renders', function () {
        // Route 1: todaySchedules is some non-array (e.g. fallback empty string)
        $data1 = new ArrayType([
            'todaySchedules' => new StringType,
        ]);

        // Route 2: todaySchedules is a populated array shape
        $data2 = new ArrayType([
            'todaySchedules' => new ArrayType([
                'id' => new IntType,
            ]),
        ]);

        InertiaComponents::addComponent('Dashboard', $data1);
        InertiaComponents::addComponent('Dashboard', $data2);

        $component = InertiaComponents::getComponent('Dashboard');

        expect($component->data)->toHaveKey('todaySchedules');
        expect($component->data['todaySchedules'])->toBeInstanceOf(UnionType::class);
    });

    it('accepts a union type as the top-level component data', function () {
        // e.g. Inertia::render('Foo', $cond ? ['a' => 1] : ['b' => 2])
        // surveyor reports the data argument as a union of array shapes.
        $data = Type::union(
            new ArrayType(['a' => new IntType]),
            new ArrayType(['b' => new StringType]),
        );

        InertiaComponents::addComponent('Foo', $data);

        $component = InertiaComponents::getComponent('Foo');

        expect($component->data)->toHaveKey('a');
        expect($component->data)->toHaveKey('b');
        expect($component->data['a']->isOptional())->toBeTrue();
        expect($component->data['b']->isOptional())->toBeTrue();
    });

    it('merges nested array shape props correctly', function () {
        // Route 1: stats has users + canRegister
        $data1 = new ArrayShapeType(Type::string(), Type::mixed());

        // Route 2: stats has only users
        $data2 = new ArrayType([
            'canRegister' => new BoolType,
        ]);

        InertiaComponents::addComponent('Dashboard', $data1);
        InertiaComponents::addComponent('Dashboard', $data2);

        $component = InertiaComponents::getComponent('Dashboard');

        expect($component->data)->toHaveKey('canRegister');
        expect($component->data['canRegister']->isOptional())->toBeTrue();
    });
});
