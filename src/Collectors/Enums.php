<?php

namespace Laravel\Ranger\Collectors;

use Illuminate\Database\Eloquent\ModelInspector;
use Illuminate\Support\Collection;
use Laravel\Ranger\Components\Enum as EnumComponent;
use Spatie\StructureDiscoverer\Discover;

class Enums extends Collector
{
    public function __construct(protected ModelInspector $inspector)
    {
        //
    }

    public function collect(): Collection
    {
        return collect(Discover::in(app_path())->enums()->get())
            ->map(fn (string $enum) => new EnumComponent(
                $enum,
                collect($enum::cases())->mapWithKeys(
                    fn ($case) => [$case->name => $case->value]
                )->all()
            ));
    }
}
