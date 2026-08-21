<?php

namespace Laravel\Ranger\Collectors;

use BackedEnum;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\Enum as EnumComponent;
use ReflectionClass;

class Enums extends Collector
{
    /**
     * @return Collection<EnumComponent>
     */
    public function collect(): Collection
    {
        return collect($this->inventory()->enums())
            ->map($this->toComponent(...));
    }

    /**
     * @param  class-string<BackedEnum|\UnitEnum>  $enum
     */
    protected function toComponent(string $enum): EnumComponent
    {
        $cases = collect($enum::cases())
            ->mapWithKeys(fn ($case, $index) => [$case->name => $case instanceof BackedEnum ? $case->value : (int) $index])
            ->all();

        $component = new EnumComponent($enum, $cases);
        $component->setFilePath((new ReflectionClass($enum))->getFileName());

        return $component;
    }
}
