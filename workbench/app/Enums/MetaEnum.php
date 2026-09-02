<?php

namespace App\Enums;

use App\Attributes\ConditionalIgnore;
use App\Attributes\Ignore;
use App\Support\CheckoutSummary;
use Generator;
use RuntimeException;

enum MetaEnum: string
{
    case FIRST = 'first';
    case SECOND = 'second';

    public function label(): string
    {
        return match ($this) {
            self::FIRST => 'The First',
            self::SECOND => 'The Second',
        };
    }

    public function color(): string
    {
        return 'green';
    }

    public function next(): self
    {
        return $this === self::FIRST ? self::SECOND : self::FIRST;
    }

    public function summary(): CheckoutSummary
    {
        return new CheckoutSummary(total: 100, currency: 'usd');
    }

    public function tags(): array
    {
        return ['one', ['nested' => true]];
    }

    public function onlyForFirst(): string
    {
        if ($this === self::SECOND) {
            throw new RuntimeException('Not available.');
        }

        return 'first only';
    }

    public function unrepresentable(): object
    {
        return new class {};
    }

    #[Ignore]
    public function internalNote(): string
    {
        return 'held back';
    }

    #[ConditionalIgnore(unless: 'features.fake')]
    public function flagged(): string
    {
        return 'flagged';
    }

    public function withArgument(string $prefix): string
    {
        return $prefix.$this->value;
    }

    public function generated(): Generator
    {
        yield 'nope';
    }

    public function nothing(): void
    {
        //
    }

    public static function statically(): string
    {
        return 'static';
    }
}
