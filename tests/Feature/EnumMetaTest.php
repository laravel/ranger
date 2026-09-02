<?php

use App\Enums\MetaEnum;
use App\Enums\PartiallyIgnoredEnum;
use App\Enums\Status;
use App\Support\MetaCalls;
use Illuminate\Support\Facades\Config;
use Laravel\Ranger\Collectors\Enums;
use Laravel\Ranger\Components\Enum;

beforeEach(function () {
    MetaCalls::flush();

    $this->meta = fn (string $enum) => app(Enums::class)->collect()
        ->first(fn (Enum $component) => $component->name === $enum)
        ->meta();
});

it('resolves a method for every case', function () {
    expect(($this->meta)(MetaEnum::class))->toHaveKeys(['FIRST', 'SECOND']);

    expect(($this->meta)(MetaEnum::class)['FIRST']['label'])->toBe('The First');
    expect(($this->meta)(MetaEnum::class)['SECOND']['label'])->toBe('The Second');
    expect(($this->meta)(MetaEnum::class)['FIRST']['color'])->toBe('green');
});

it('normalizes values it can represent', function () {
    $meta = ($this->meta)(MetaEnum::class)['FIRST'];

    expect($meta['next'])->toBe('second');
    expect($meta['summary'])->toBe(['total' => 100, 'currency' => 'usd']);
    expect($meta['tags'])->toBe(['one', ['nested' => true]]);
});

it('leaves out a method that throws for one case alone', function () {
    $meta = ($this->meta)(MetaEnum::class);

    expect($meta['FIRST']['onlyForFirst'])->toBe('first only');
    expect($meta['SECOND'])->not->toHaveKey('onlyForFirst');
});

it('leaves out a value it cannot represent', function () {
    expect(($this->meta)(MetaEnum::class)['FIRST'])->not->toHaveKey('unrepresentable');
});

it('leaves out methods it cannot call for every case', function () {
    expect(($this->meta)(MetaEnum::class)['FIRST'])
        ->not->toHaveKey('withArgument')
        ->not->toHaveKey('generated')
        ->not->toHaveKey('nothing')
        ->not->toHaveKey('statically');
});

it('leaves out a marked method', function () {
    expect(($this->meta)(MetaEnum::class)['FIRST'])->not->toHaveKey('internalNote');
});

it('leaves out a conditionally marked method while its condition fails', function () {
    expect(($this->meta)(MetaEnum::class)['FIRST'])->not->toHaveKey('flagged');
});

it('keeps a conditionally marked method while its condition holds', function () {
    Config::set('features.fake', true);

    expect(($this->meta)(MetaEnum::class)['FIRST']['flagged'])->toBe('flagged');
});

it('is empty for an enum without methods', function () {
    expect(($this->meta)(Status::class))->toBe([]);
});

it('never calls a method on a marked case', function () {
    $meta = ($this->meta)(PartiallyIgnoredEnum::class);

    expect(array_keys($meta))->toBe(['PUBLIC_CASE', 'OTHER_CASE']);
    expect(MetaCalls::$cases)->toBe(['PUBLIC_CASE', 'OTHER_CASE']);
});

it('resolves once per component', function () {
    $component = app(Enums::class)->collect()
        ->first(fn (Enum $enum) => $enum->name === PartiallyIgnoredEnum::class);

    $component->meta();
    $component->meta();

    expect(MetaCalls::$cases)->toBe(['PUBLIC_CASE', 'OTHER_CASE']);
});

it('does not resolve while collecting', function () {
    app(Enums::class)->collect();

    expect(MetaCalls::$cases)->toBe([]);
});
