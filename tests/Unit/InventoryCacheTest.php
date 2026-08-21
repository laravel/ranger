<?php

use Laravel\Ranger\Support\Config;
use Laravel\Ranger\Support\Inventory;

beforeEach(function () {
    $this->source = sys_get_temp_dir().'/ranger-inventory-src-'.getmypid();
    $this->cache = sys_get_temp_dir().'/ranger-inventory-cache-'.getmypid();

    foreach ([$this->source, $this->cache] as $directory) {
        if (is_dir($directory)) {
            array_map('unlink', glob($directory.'/*') ?: []);
        } else {
            mkdir($directory, 0755, true);
        }
    }

    Config::set('cache.directory', $this->cache);
    Inventory::flush();

    $this->write = function (string $name, string $body) {
        file_put_contents($this->source."/{$name}.php", "<?php namespace Fixture; {$body}");
    };

    $this->read = function () {
        Inventory::flush();

        return array_map(
            fn ($structure) => $structure->getFcqn(),
            Inventory::in($this->source)->structures(),
        );
    };
});

afterEach(function () {
    Config::set('cache.directory', null);

    foreach ([$this->source, $this->cache] as $directory) {
        array_map('unlink', glob($directory.'/*') ?: []);
        @rmdir($directory);
    }
});

it('writes an index it can read back', function () {
    ($this->write)('Alpha', 'class Alpha {}');

    expect(($this->read)())->toBe(['Fixture\Alpha']);
    expect(glob($this->cache.'/inventory-*.cache'))->toHaveCount(1);

    // Second read comes from the index rather than the files.
    expect(($this->read)())->toBe(['Fixture\Alpha']);
});

it('re-reads a file that changed', function () {
    ($this->write)('Alpha', 'class Alpha {}');
    expect(($this->read)())->toBe(['Fixture\Alpha']);

    ($this->write)('Alpha', 'class AlphaRenamed {}');

    expect(($this->read)())->toBe(['Fixture\AlphaRenamed']);
});

it('drops files that were deleted', function () {
    ($this->write)('Alpha', 'class Alpha {}');
    ($this->write)('Beta', 'class Beta {}');
    expect(($this->read)())->toHaveCount(2);

    unlink($this->source.'/Beta.php');

    expect(($this->read)())->toBe(['Fixture\Alpha']);
});

it('picks up files that were added', function () {
    ($this->write)('Alpha', 'class Alpha {}');
    expect(($this->read)())->toHaveCount(1);

    ($this->write)('Beta', 'class Beta {}');

    expect(($this->read)())->toHaveCount(2);
});

it('resolves chains across files that came from the index', function () {
    ($this->write)('Base', 'class Base {}');
    ($this->write)('Middle', 'class Middle extends Base {}');
    ($this->write)('Leaf', 'class Leaf extends Middle {}');

    // Prime the index, then read it back and check the chain still resolves.
    ($this->read)();

    expect(Inventory::in($this->source)->classesExtending('Fixture\Base'))
        ->toContain('Fixture\Middle', 'Fixture\Leaf');
});

it('falls back to reading the files when the index is unreadable', function () {
    ($this->write)('Alpha', 'class Alpha {}');
    ($this->read)();

    file_put_contents(glob($this->cache.'/inventory-*.cache')[0], 'not a serialized index');

    expect(($this->read)())->toBe(['Fixture\Alpha']);
});

it('ignores an index written by a different version', function () {
    ($this->write)('Alpha', 'class Alpha {}');
    ($this->read)();

    $file = glob($this->cache.'/inventory-*.cache')[0];
    file_put_contents($file, serialize(['version' => -1, 'files' => ['bogus' => ['stamp' => 'x', 'structures' => []]]]));

    expect(($this->read)())->toBe(['Fixture\Alpha']);
});

it('works without a cache directory and writes nothing', function () {
    Config::set('cache.directory', null);

    ($this->write)('Alpha', 'class Alpha {}');

    expect(($this->read)())->toBe(['Fixture\Alpha']);
    expect(glob($this->cache.'/inventory-*.cache'))->toBeEmpty();
});

// Modification time has a second of resolution, so a file rewritten in the
// same second the index was, at the same length, still looks untouched.
// Renaming a parent class to another of the same length does exactly that.
it('notices a same-second change that keeps the file length', function () {
    ($this->write)('Base', 'class Base {}');
    ($this->write)('Other', 'class Othr {}');
    ($this->write)('Leaf', 'class Leaf extends Base {}');

    expect(Inventory::in($this->source)->classesExtending('Fixture\Base'))->toBe(['Fixture\Leaf']);

    $leaf = $this->source.'/Leaf.php';
    $before = filemtime($leaf);

    // Same length as the original, so only the contents differ.
    ($this->write)('Leaf', 'class Leaf extends Othr {}');
    touch($leaf, $before);

    expect(filemtime($leaf))->toBe($before);

    Inventory::flush();

    expect(Inventory::in($this->source)->classesExtending('Fixture\Base'))->toBe([]);
    expect(Inventory::in($this->source)->classesExtending('Fixture\Othr'))->toBe(['Fixture\Leaf']);
});

it('does not re-read files older than the index', function () {
    ($this->write)('Alpha', 'class Alpha {}');
    ($this->read)();

    // Backdate the file so it sits clearly before the index was written, then
    // change it underneath without touching its stamp. A file that old cannot
    // be in the racy window, so the index is trusted and the edit is missed —
    // which is the trade that keeps a warm read down to a stat per file.
    $file = $this->source.'/Alpha.php';
    touch($file, time() - 3600);
    ($this->read)();

    $stamp = filemtime($file);
    file_put_contents($file, '<?php namespace Fixture; class Alphb {}');
    touch($file, $stamp);

    expect(($this->read)())->toBe(['Fixture\Alpha']);
});

it('clears the index from disk', function () {
    ($this->write)('Alpha', 'class Alpha {}');
    ($this->read)();

    expect(glob($this->cache.'/inventory-*.cache'))->toHaveCount(1);

    Inventory::clear();

    expect(glob($this->cache.'/inventory-*.cache'))->toBeEmpty();
    expect(($this->read)())->toBe(['Fixture\Alpha']);
});

// Wayfinder points Ranger and Surveyor at the same directory, so clearing one
// must not take the other's entries with it.
it('leaves cache entries that are not its own alone', function () {
    ($this->write)('Alpha', 'class Alpha {}');
    ($this->read)();

    $foreign = $this->cache.'/'.md5('someone-else').'.cache';
    file_put_contents($foreign, 'not ours');

    Inventory::clear();

    expect(glob($this->cache.'/inventory-*.cache'))->toBeEmpty();
    expect(is_file($foreign))->toBeTrue();
});

it('can be cleared with no cache directory configured', function () {
    Config::set('cache.directory', null);

    Inventory::clear();
})->throwsNoExceptions();
