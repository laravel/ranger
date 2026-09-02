<?php

namespace Laravel\Ranger\Components;

use Laravel\Ranger\Concerns\HasFilePath;
use Laravel\Ranger\Support\EnumMeta;

class Enum
{
    use HasFilePath;

    /** @var array<string, array<string, mixed>>|null */
    protected ?array $meta = null;

    /**
     * @param  array<string, int|string|null>  $cases
     */
    public function __construct(
        public readonly string $name,
        public readonly array $cases
    ) {
        //
    }

    /**
     * The value every no-argument method returns for every case, keyed by case
     * name then method name.
     *
     * Resolving means calling the methods, so it is left until a consumer asks
     * rather than done while collecting: an application that has no use for the
     * values never has its code run.
     *
     * @return array<string, array<string, mixed>>
     */
    public function meta(): array
    {
        return $this->meta ??= EnumMeta::resolve($this->name, array_keys($this->cases));
    }
}
