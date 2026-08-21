<?php

namespace Laravel\Ranger\Collectors;

use BackedEnum;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\Enum as EnumComponent;
use Laravel\Ranger\Support\Ignores;
use ReflectionEnum;
use ReflectionEnumBackedCase;
use Spatie\StructureDiscoverer\Discover;

class Enums extends Collector
{
    /**
     * @return Collection<EnumComponent>
     */
    public function collect(): Collection
    {
        return collect(Discover::in(...$this->appPaths)->enums()->get())
            ->map($this->toComponent(...))
            ->filter()
            ->values();
    }

    /**
     * @param  class-string<BackedEnum|\UnitEnum>  $enum
     */
    protected function toComponent(string $enum): ?EnumComponent
    {
        $reflection = new ReflectionEnum($enum);

        if (Ignores::marked($reflection)) {
            return null;
        }

        $cases = [];

        foreach ($reflection->getCases() as $index => $case) {
            if (Ignores::marked($case)) {
                continue;
            }

            $cases[$case->getName()] = $case instanceof ReflectionEnumBackedCase
                ? $case->getBackingValue()
                : $index;
        }

        $component = new EnumComponent($enum, $cases);
        $component->setFilePath($reflection->getFileName());

        return $component;
    }
}
