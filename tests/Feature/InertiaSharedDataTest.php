<?php

use Laravel\Ranger\Collectors\InertiaSharedData;
use Laravel\Ranger\Components\InertiaSharedData as InertiaSharedDataComponent;

beforeEach(function () {
    $this->collector = app(InertiaSharedData::class);
});

it('collects all inertia middleware classes', function () {
    $sharedData = $this->collector->collect();

    expect($sharedData)->toHaveCount(3);
});

it('creates shared data components with correct structure', function () {
    $sharedData = $this->collector->collect();

    expect($sharedData->first())->toBeInstanceOf(InertiaSharedDataComponent::class);
});

it('sets withAllErrors to false when property is not overridden', function () {
    $sharedData = $this->collector->collect();

    $component = $sharedData->first(
        fn (InertiaSharedDataComponent $c) => $c->withAllErrors === false
    );

    expect($component)->toBeInstanceOf(InertiaSharedDataComponent::class);
});

it('sets withAllErrors to true when property is set to true', function () {
    $sharedData = $this->collector->collect();

    $component = $sharedData->first(
        fn (InertiaSharedDataComponent $c) => $c->withAllErrors === true
    );

    expect($component)->toBeInstanceOf(InertiaSharedDataComponent::class);
});
