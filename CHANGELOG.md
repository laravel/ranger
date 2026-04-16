# Release Notes

## [Unreleased](https://github.com/laravel/ranger/compare/v0.1.12...main)

## [v0.1.12](https://github.com/laravel/ranger/compare/v0.1.10...v0.1.12) - 2026-04-16

### What's Changed

* Return relative URIs for explicit Route::domain routes by [@benddailey](https://github.com/benddailey) in https://github.com/laravel/ranger/pull/26

### New Contributors

* [@benddailey](https://github.com/benddailey) made their first contribution in https://github.com/laravel/ranger/pull/26

**Full Changelog**: https://github.com/laravel/ranger/compare/v0.1.10...v0.1.12

## [v0.1.10](https://github.com/laravel/ranger/compare/v0.1.9...v0.1.10) - 2026-04-07

### What's Changed

* Respect app URL base path by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/24
* Fix model binding key resolution for camelCase route parameters by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/25

**Full Changelog**: https://github.com/laravel/ranger/compare/v0.1.9...v0.1.10

## [v0.1.9](https://github.com/laravel/ranger/compare/v0.1.8...v0.1.9) - 2026-03-17

* Makes imports consistent by [@nunomaduro](https://github.com/nunomaduro) in https://github.com/laravel/ranger/pull/21
* Add Laravel 13 support by [@pascalbaljet](https://github.com/pascalbaljet) in https://github.com/laravel/ranger/pull/22

## [v0.1.8](https://github.com/laravel/ranger/compare/v0.1.7...v0.1.8) - 2026-01-27

### What's Changed

* Fix error when projects contain UnitEnums. by [@Jasonej](https://github.com/Jasonej) in https://github.com/laravel/ranger/pull/15
* Fix integer id seen as string by [@mathieutu](https://github.com/mathieutu) in https://github.com/laravel/ranger/pull/16
* fix(broadcast-events): support ShouldBroadcastNow alongside ShouldBroadcast by [@JorgeRui](https://github.com/JorgeRui) in https://github.com/laravel/ranger/pull/18
* Fix unit enum case values in Enums collector by [@JorgeRui](https://github.com/JorgeRui) in https://github.com/laravel/ranger/pull/19

### New Contributors

* [@Jasonej](https://github.com/Jasonej) made their first contribution in https://github.com/laravel/ranger/pull/15
* [@mathieutu](https://github.com/mathieutu) made their first contribution in https://github.com/laravel/ranger/pull/16
* [@JorgeRui](https://github.com/JorgeRui) made their first contribution in https://github.com/laravel/ranger/pull/18

**Full Changelog**: https://github.com/laravel/ranger/compare/v0.1.7...v0.1.8

## [v0.1.7](https://github.com/laravel/ranger/compare/v0.1.6...v0.1.7) - 2026-01-12

### What's Changed

* Handle empty Inertia props correctly by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/13
* Strip scheme from forced route URL in route by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/14

**Full Changelog**: https://github.com/laravel/ranger/compare/v0.1.6...v0.1.7

## [v0.1.6](https://github.com/laravel/ranger/compare/v0.1.5...v0.1.6) - 2026-01-06

### What's Changed

* Exclude `/workbench` directory as it only used for package development by [@crynobone](https://github.com/crynobone) in https://github.com/laravel/ranger/pull/11
* Detect and record `withAllErrors` property in Inertia by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/12

### New Contributors

* [@crynobone](https://github.com/crynobone) made their first contribution in https://github.com/laravel/ranger/pull/11

**Full Changelog**: https://github.com/laravel/ranger/compare/v0.1.5...v0.1.6

## [v0.1.5](https://github.com/laravel/ranger/compare/v0.1.4...v0.1.5) - 2025-12-29

### What's Changed

* Add file paths to model component by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/10

**Full Changelog**: https://github.com/laravel/ranger/compare/v0.1.4...v0.1.5

## [v0.1.4](https://github.com/laravel/ranger/compare/v0.1.3...v0.1.4) - 2025-12-29

### What's Changed

* Fix environment variable parsing for base paths specifically by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/8

**Full Changelog**: https://github.com/laravel/ranger/compare/v0.1.3...v0.1.4

## [v0.1.3](https://github.com/laravel/ranger/compare/v0.1.2...v0.1.3) - 2025-12-26

### What's Changed

* Handle eager loading of models and snake casing by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/6
* Create release script by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/7

**Full Changelog**: https://github.com/laravel/ranger/compare/v0.1.2...v0.1.3

## [v0.1.2](https://github.com/laravel/ranger/compare/v0.1.1...v0.1.2) - 2025-12-26

### What's Changed

* Model relations fix by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/3
* Fix static analysis by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/4
* Remove unnecessary artifacts from release by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/5

**Full Changelog**: https://github.com/laravel/ranger/compare/v0.1.1...v0.1.2

## [v0.1.1](https://github.com/laravel/ranger/compare/v0.1.0...v0.1.1) - 2025-12-22

### What's Changed

* Set paths for tests by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/1
* Fix Inertia optional property detection by [@joetannenbaum](https://github.com/joetannenbaum) in https://github.com/laravel/ranger/pull/2

### New Contributors

* [@joetannenbaum](https://github.com/joetannenbaum) made their first contribution in https://github.com/laravel/ranger/pull/1

**Full Changelog**: https://github.com/laravel/ranger/compare/v0.1.0...v0.1.1

## v0.1.0 (202x-xx-xx)

Initial pre-release.
