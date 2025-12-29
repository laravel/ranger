<?php

use Laravel\Ranger\Collectors\EnvironmentVariables;
use Laravel\Ranger\Components\EnvironmentVariable;

describe('EnvironmentVariables collector', function () {
    beforeEach(function () {
        $this->tempDir = __DIR__.'/../../workbench/.env-test-'.uniqid();
        mkdir($this->tempDir);
    });

    afterEach(function () {
        if (file_exists($this->tempDir.'/.env')) {
            unlink($this->tempDir.'/.env');
        }
        if (is_dir($this->tempDir)) {
            rmdir($this->tempDir);
        }
    });

    it('creates EnvironmentVariable components from .env file', function () {
        file_put_contents($this->tempDir.'/.env', <<<'ENV'
APP_NAME=MyApp
APP_DEBUG=true
ENV);

        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir);
        $variables = $collector->collect();

        expect($variables)->toHaveCount(2);
        expect($variables->first())->toBeInstanceOf(EnvironmentVariable::class);
    });

    it('parses string values correctly', function () {
        file_put_contents($this->tempDir.'/.env', <<<'ENV'
APP_NAME=MyApp
APP_ENV=production
ENV);

        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir);
        $variables = $collector->collect();

        $appName = $variables->firstWhere('key', 'APP_NAME');
        $appEnv = $variables->firstWhere('key', 'APP_ENV');

        expect($appName->value)->toBe('MyApp');
        expect($appEnv->value)->toBe('production');
    });

    it('casts integer values', function () {
        file_put_contents($this->tempDir.'/.env', <<<'ENV'
CACHE_TTL=3600
MAX_CONNECTIONS=100
ENV);

        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir);
        $variables = $collector->collect();

        $cacheTtl = $variables->firstWhere('key', 'CACHE_TTL');
        $maxConnections = $variables->firstWhere('key', 'MAX_CONNECTIONS');

        expect($cacheTtl->value)->toBe(3600);
        expect($cacheTtl->value)->toBeInt();
        expect($maxConnections->value)->toBe(100);
        expect($maxConnections->value)->toBeInt();
    });

    it('casts float values', function () {
        file_put_contents($this->tempDir.'/.env', <<<'ENV'
RATE_LIMIT=1.5
THRESHOLD=0.75
ENV);

        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir);
        $variables = $collector->collect();

        $rateLimit = $variables->firstWhere('key', 'RATE_LIMIT');
        $threshold = $variables->firstWhere('key', 'THRESHOLD');

        expect($rateLimit->value)->toBe(1.5);
        expect($rateLimit->value)->toBeFloat();
        expect($threshold->value)->toBe(0.75);
        expect($threshold->value)->toBeFloat();
    });

    it('handles null values', function () {
        file_put_contents($this->tempDir.'/.env', <<<'ENV'
EMPTY_VAR=
ENV);

        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir);
        $variables = $collector->collect();

        $emptyVar = $variables->firstWhere('key', 'EMPTY_VAR');

        expect($emptyVar->value)->toBeNull();
    });

    it('supports variable interpolation', function () {
        file_put_contents($this->tempDir.'/.env', <<<'ENV'
BASE_URL=https://example.com
API_URL=${BASE_URL}/api
WEBHOOK_URL=${BASE_URL}/webhook
ENV);

        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir);
        $variables = $collector->collect();

        $apiUrl = $variables->firstWhere('key', 'API_URL');
        $webhookUrl = $variables->firstWhere('key', 'WEBHOOK_URL');

        expect($apiUrl->value)->toBe('https://example.com/api');
        expect($webhookUrl->value)->toBe('https://example.com/webhook');
    });

    it('supports nested variable interpolation', function () {
        file_put_contents($this->tempDir.'/.env', <<<'ENV'
HOST=localhost
PORT=3000
BASE_URL=http://${HOST}:${PORT}
API_URL=${BASE_URL}/api/v1
ENV);

        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir);
        $variables = $collector->collect();

        $baseUrl = $variables->firstWhere('key', 'BASE_URL');
        $apiUrl = $variables->firstWhere('key', 'API_URL');

        expect($baseUrl->value)->toBe('http://localhost:3000');
        expect($apiUrl->value)->toBe('http://localhost:3000/api/v1');
    });

    it('returns empty collection when .env file does not exist', function () {
        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir);
        $variables = $collector->collect();

        expect($variables)->toBeEmpty();
    });

    it('returns empty collection when no base paths are set', function () {
        $collector = new EnvironmentVariables;
        $variables = $collector->collect();

        expect($variables)->toBeEmpty();
    });

    it('handles invalid .env files gracefully', function () {
        file_put_contents($this->tempDir.'/.env', <<<'ENV'
VALID_KEY=valid
"INVALID LINE WITHOUT EQUALS
ANOTHER_VALID=value
ENV);

        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir);
        $variables = $collector->collect();

        expect($variables)->toBeEmpty();
    });

    it('handles quoted values correctly', function () {
        file_put_contents($this->tempDir.'/.env', <<<'ENV'
SINGLE_QUOTED='Hello World'
DOUBLE_QUOTED="Hello World"
WITH_SPACES="  spaced  "
ENV);

        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir);
        $variables = $collector->collect();

        $singleQuoted = $variables->firstWhere('key', 'SINGLE_QUOTED');
        $doubleQuoted = $variables->firstWhere('key', 'DOUBLE_QUOTED');
        $withSpaces = $variables->firstWhere('key', 'WITH_SPACES');

        expect($singleQuoted->value)->toBe('Hello World');
        expect($doubleQuoted->value)->toBe('Hello World');
        expect($withSpaces->value)->toBe('  spaced  ');
    });

    it('uses first base path that contains .env file', function () {
        $secondDir = __DIR__.'/../../workbench/.env-test-second-'.uniqid();
        mkdir($secondDir);

        file_put_contents($secondDir.'/.env', <<<'ENV'
FROM_SECOND=yes
ENV);

        $collector = new EnvironmentVariables;
        $collector->setBasePaths($this->tempDir, $secondDir);
        $variables = $collector->collect();

        $fromSecond = $variables->firstWhere('key', 'FROM_SECOND');

        expect($fromSecond->value)->toBe('yes');

        unlink($secondDir.'/.env');
        rmdir($secondDir);
    });
});
