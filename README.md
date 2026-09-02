<p align="center">
<a href="https://github.com/laravel/ranger/actions"><img src="https://github.com/laravel/ranger/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/ranger"><img src="https://img.shields.io/packagist/dt/laravel/ranger" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/ranger"><img src="https://img.shields.io/packagist/v/laravel/ranger" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/ranger"><img src="https://img.shields.io/packagist/l/laravel/ranger" alt="License"></a>
</p>

# Laravel Ranger

> [!IMPORTANT]
> Ranger is currently in Beta, the API is subject (and likely) to change prior to the v1.0.0 release. All notable changes will be documented in the [changelog](./CHANGELOG.md).

## Introduction

Ranger is a powerful introspection library for Laravel applications. It walks through your codebase and collects detailed information about your application's components, including routes, models, enums, broadcast events, environment variables, and Inertia.js components.

With Ranger, you can register callbacks that fire as each component is discovered, each callback returns a detailed Data Transport Object (DTO) that you can decide what to do with.

### Basic Usage

```php
use Laravel\Ranger\Ranger;
use Laravel\Ranger\Components;
use Illuminate\Support\Collection;

$ranger = app(Ranger::class);

// Register callbacks for individual items
$ranger->onRoute(function (Components\Route $route) {
    echo $route->uri();
});

$ranger->onModel(function (Components\Model $model) {
    foreach ($model->getAttributes() as $name => $type) {
        //
    }
});

$ranger->onEnum(function (Components\Enum $enum) {
    //
});

$ranger->onBroadcastEvent(function (Components\BroadcastEvent $event) {
    //
});

// Or register callbacks for entire collections
$ranger->onRoutes(function (Collection $routes) {
    // Called once all of the routes have been discovered and processed
});

$ranger->onModels(function (Collection $models) {
    // Called once all of the models have been discovered and processed
});

// Walk through the application and trigger all callbacks
$ranger->walk();
```

### What Ranger Collects

| Collector                 | Description                                                                                                    |
| ------------------------- | -------------------------------------------------------------------------------------------------------------- |
| **Routes**                | All registered routes with URIs, parameters, HTTP verbs, controllers, validation rules, and possible responses |
| **Models**                | Eloquent models with their attributes, types, and relationships                                                |
| **Enums**                 | PHP enums with their cases, values, and the meta each case's methods return                                    |
| **Broadcast Events**      | Events implementing `ShouldBroadcast` with their payloads                                                      |
| **Broadcast Channels**    | Registered broadcast channels                                                                                  |
| **Environment Variables** | Variables defined in your `.env` file                                                                          |
| **Inertia Shared Data**   | Globally shared Inertia.js props                                                                               |
| **Inertia Components**    | Inertia.js page components with their expected props                                                           |

Each collector skips whatever carries an ignore marker. See [Ignore Markers](#ignore-markers).

### Enum Meta

An enum component carries its cases, and can also hand back what every no-argument method on the enum returns for each case, keyed by case name then method name:

```php
enum Status: string
{
    case Active = 'active';
    case Draft = 'draft';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Is Active',
            self::Draft => 'Is Draft',
        };
    }
}

$enum->meta(); // ['Active' => ['label' => 'Is Active'], 'Draft' => ['label' => 'Is Draft']]
```

Resolving means calling the methods, so it waits until you ask: collecting an enum never runs an application's own code. A method is left out unless it is public, declared on the enum itself, takes no required arguments, and returns something representable as data. Objects are unwrapped through `JsonSerializable`, `Arrayable`, or `Stringable`, and a backed enum comes back as its value. A method that throws, or returns something we cannot represent, is left out for that case alone, so a method covering only some cases still makes it through.

### Ignore Markers

Every collector leaves out declarations an application has marked to be left out, so a consumer cannot pass on something the author held back. Ranger honors any attribute implementing `Laravel\Surveyor\Contracts\Ignored`, on a model, an enum or one of its cases or methods, a broadcast event or channel, and a controller class or action, whose routes are dropped with it. A relation pointing at a marked model is dropped too, since no type is left to point at.

Markers can carry a condition, which ranger resolves as a config key, a `[class, method]` callable, or a plain bool:

```php
#[Ignore(unless: 'services.fake_source_provider')]
case GitFake = 'gitfake';
```

Conditions are resolved while collecting, not while analyzing, so a cached analysis is still answered for the environment collecting it.

## Contributing

Thank you for considering contributing to Ranger! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

Please review [our security policy](https://github.com/laravel/ranger/security/policy) on how to report security vulnerabilities.

## License

Laravel Ranger is open-sourced software licensed under the [MIT license](LICENSE.md).
