<?php

namespace Laravel\Ranger\Support;

use Spatie\StructureDiscoverer\Data\DiscoveredStructure;
use Spatie\StructureDiscoverer\Discover;
use Spatie\StructureDiscoverer\Support\Conditions\ConditionBuilder;
use Spatie\StructureDiscoverer\Support\Conditions\HasConditions;

class Inventory
{
    /**
     * Structures found in a set of paths, keyed by those paths.
     *
     * @var array<string, array<DiscoveredStructure>>
     */
    protected static array $scans = [];

    /**
     * @param  list<string>  $paths
     */
    public function __construct(protected array $paths) {}

    public static function in(string ...$paths): self
    {
        return new self($paths);
    }

    /**
     * Drop the scanned structures, so the next question re-reads from disk.
     */
    public static function flush(): void
    {
        static::$scans = [];
    }

    /**
     * @return array<DiscoveredStructure>
     */
    public function structures(): array
    {
        return static::$scans[implode('|', $this->paths)] ??= Discover::in(...$this->paths)
            ->full()
            ->get();
    }

    /**
     * Classes extending any of the given parents, however far up the chain.
     *
     * @return list<class-string>
     */
    public function classesExtending(string ...$parents): array
    {
        return $this->match(ConditionBuilder::create()->classes()->extending(...$parents));
    }

    /**
     * Classes implementing any of the given interfaces, however far up the chain.
     *
     * @return list<class-string>
     */
    public function classesImplementing(string ...$interfaces): array
    {
        return $this->match(ConditionBuilder::create()->classes()->implementing(...$interfaces));
    }

    /**
     * @return list<class-string>
     */
    public function enums(): array
    {
        return $this->match(ConditionBuilder::create()->enums());
    }

    /**
     * @return list<class-string>
     */
    protected function match(HasConditions $conditions): array
    {
        $store = $conditions->conditionsStore();
        $found = [];

        foreach ($this->structures() as $structure) {
            if ($store->satisfies($structure)) {
                $found[] = $structure->getFcqn();
            }
        }

        return $found;
    }
}
