<?php

namespace Laravel\Ranger\Support;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Spatie\StructureDiscoverer\Data\DiscoveredStructure;
use Spatie\StructureDiscoverer\Support\Conditions\ConditionBuilder;
use Spatie\StructureDiscoverer\Support\Conditions\HasConditions;
use Spatie\StructureDiscoverer\Support\StructureChainResolver;
use Spatie\StructureDiscoverer\TokenParsers\FileTokenParser;
use SplFileInfo;
use Throwable;

class Inventory
{
    protected const VERSION = 1;

    protected const HASH = 'xxh128';

    /**
     * Prefixes the index files. The cache directory is likely to be shared
     * with Surveyor's, so clearing ours must not reach its entries.
     */
    protected const PREFIX = 'inventory-';

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
     * Forget what was read this run, so the next question goes back to the
     * files. What is on disk is left alone.
     */
    public static function flush(): void
    {
        static::$scans = [];
    }

    /**
     * Throw away everything that was read, on disk as well as in memory.
     */
    public static function clear(): void
    {
        static::flush();

        $directory = Config::get('cache.directory');

        if ($directory === null || ! is_dir($directory)) {
            return;
        }

        foreach (glob($directory.'/'.self::PREFIX.'*.cache') ?: [] as $file) {
            unlink($file);
        }
    }

    /**
     * @return array<DiscoveredStructure>
     */
    public function structures(): array
    {
        return static::$scans[implode('|', $this->paths)] ??= $this->read();
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

    /**
     * @return array<DiscoveredStructure>
     */
    protected function read(): array
    {
        [$stamps, $mtimes] = $this->stampFiles();
        [$cached, $writtenAt] = $this->load();

        $records = [];
        $changed = count($cached) !== count($stamps);

        $parser = new FileTokenParser;

        foreach ($stamps as $file => $stamp) {
            $record = $cached[$file] ?? null;

            if ($record !== null && $record['stamp'] === $stamp && ! $this->racy($mtimes[$file], $writtenAt, $file, $record)) {
                $records[$file] = $record;

                continue;
            }

            $records[$file] = $this->record($parser, $stamp, $file);
            $changed = true;
        }

        // Written before the chains are resolved, because a chain is a fact
        // about the whole set rather than about one file, and a cached record
        // carrying one would stop the next run from working it out again.
        if ($changed) {
            $this->save($records);
        }

        $structures = [];

        foreach ($records as $record) {
            foreach ($record['structures'] as $fqcn => $structure) {
                $structures[$fqcn] = $structure;
            }
        }

        // The resolver's docblock names only the subclasses it acts on, but it
        // reads the whole discovered set.
        // @phpstan-ignore argument.type
        (new StructureChainResolver)->execute($structures);

        return array_values($structures);
    }

    /**
     * @return array{stamp: string, hash: string, structures: array<string, DiscoveredStructure>}
     */
    protected function record(FileTokenParser $parser, string $stamp, string $file): array
    {
        $contents = file_get_contents($file) ?: '';

        try {
            $structures = $parser->execute($file, $contents);
        } catch (Throwable) {
            // A file that cannot be parsed holds nothing we can act on, and
            // failing the whole run over one of them is worse than skipping it.
            $structures = [];
        }

        return ['stamp' => $stamp, 'hash' => hash(self::HASH, $contents), 'structures' => $structures];
    }

    /**
     * Whether a file could have changed without its stamp changing.
     *
     * A stamp is the modification time and size, and modification time only
     * has a second of resolution, so a file written in the same second the
     * index was, at the same length, still looks untouched. Renaming a parent
     * class to another of the same length does exactly that, and a watcher
     * runs within the same second as the save that woke it. Files that old or
     * older cannot be in that window, so only the recent ones are read.
     *
     * @param  array{stamp: string, hash: string, structures: array<string, DiscoveredStructure>}  $record
     */
    protected function racy(int $mtime, ?int $writtenAt, string $file, array $record): bool
    {
        if ($writtenAt === null || $mtime < $writtenAt) {
            return false;
        }

        return hash(self::HASH, file_get_contents($file) ?: '') !== $record['hash'];
    }

    /**
     * Modification time and size of every PHP file in the paths, which is what
     * decides whether a file has to be read again. Hashing every file instead
     * would be sturdier but means reading all of them on every run, so only
     * the files recent enough to be ambiguous get hashed. See racy().
     *
     * @return array{0: array<string, string>, 1: array<string, int>}
     */
    protected function stampFiles(): array
    {
        $stamps = [];
        $mtimes = [];

        foreach ($this->paths as $path) {
            if (! is_dir($path)) {
                continue;
            }

            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
            );

            /** @var SplFileInfo $file */
            foreach ($files as $file) {
                if ($file->getExtension() !== 'php') {
                    continue;
                }

                $mtimes[$file->getPathname()] = $mtime = $file->getMTime();
                $stamps[$file->getPathname()] = $mtime.':'.$file->getSize();
            }
        }

        return [$stamps, $mtimes];
    }

    /**
     * @return array{0: array<string, array{stamp: string, hash: string, structures: array<string, DiscoveredStructure>}>, 1: int|null}
     */
    protected function load(): array
    {
        $file = $this->cacheFile();

        if ($file === null || ! is_file($file)) {
            return [[], null];
        }

        try {
            $index = unserialize(file_get_contents($file) ?: '');
        } catch (Throwable) {
            return [[], null];
        }

        if (! is_array($index) || ($index['version'] ?? null) !== self::VERSION) {
            return [[], null];
        }

        return [$index['files'] ?? [], $index['written_at'] ?? null];
    }

    /**
     * @param  array<string, array{stamp: string, hash: string, structures: array<string, DiscoveredStructure>}>  $records
     */
    protected function save(array $records): void
    {
        $file = $this->cacheFile();

        if ($file === null) {
            return;
        }

        if (! is_dir($directory = dirname($file))) {
            mkdir($directory, 0755, true);
        }

        file_put_contents($file, serialize([
            'version' => self::VERSION,
            'written_at' => time(),
            'files' => $records,
        ]));
    }

    protected function cacheFile(): ?string
    {
        $directory = Config::get('cache.directory');

        if ($directory === null) {
            return null;
        }

        return $directory.'/'.self::PREFIX.md5(implode('|', $this->paths)).'.cache';
    }
}
