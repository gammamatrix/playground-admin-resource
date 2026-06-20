# Playground: Admin Resource

[![Playground CI Workflow](https://github.com/gammamatrix/playground-admin-resource/actions/workflows/ci.yml/badge.svg?branch=develop)](https://raw.githubusercontent.com/gammamatrix/playground-admin-resource/testing/develop/testdox.txt)
[![Test Coverage](https://raw.githubusercontent.com/gammamatrix/playground-admin-resource/testing/develop/coverage.svg)](tests)
[![PHPStan Level 10](https://img.shields.io/badge/PHPStan-level%2010-brightgreen)](.github/workflows/ci.yml#L128)

Playground: Admin Resource

This package provides an API and a Blade UI for interacting with the [Playground: Admin](https://github.com/gammamatrix/playground-admin), a model package for Laravel.

If you need a JSON API without a UI, then have a look at [Playground: Admin API.](https://github.com/gammamatrix/playground-admin-api)

## Documentation

Read more on using [Playground: Admin Resource at Read the Docs: Playground Documentation](https://gammamatrix-playground.readthedocs.io/en/develop/built-components/admin.html)

### Postman

A postman collection is provided in the repository: [postman-playground-admin-resource.json.](postman-playground-admin-resource.json)
- This same collection is viewable on the [.]()

### OpenAPI

This application provides OpenAPI documentation: [openapi.yaml](openapi.yaml).
- The endpoint models support locks, trash with force delete, restoring, revisions and more.
- Index endpoints support advanced query filtering.

OpenAPI API Documentation is built with npm using Redocly.
- npm is only needed to generate documentation and is not needed to operate the Playground: Admin Resource API.

See [package.json](package.json) requirements.

Install npm.

```sh
npm install
```

Build the documentation to generate the [openapi.yaml](openapi.yaml) configuration.

```sh
npm run docs
```

Documentation
- Preview [openapi.yaml on the Redocly Editor UI.](https://redocly.github.io/redoc/?url=https://raw.githubusercontent.com/gammamatrix/playground-admin-resource/develop/openapi.yaml)

## Installation

You can install the package via composer:

```bash
composer require gammamatrix/playground-admin-resource
```

## `artisan about`

Playground provides information in the `artisan about` command.

<!-- <img src="resources/docs/artisan-about-playground-admin-resource.png" alt="screenshot of artisan about command with Playground: Admin Resource."> -->

## Configuration

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Playground\Admin\Resource\ServiceProvider" --tag="playground-config"
```

All routes are enabled by default. They may be disabled via environment variable or the configuration.

See the contents of the published config file: [config/playground-admin-resource.php](config/playground-admin-resource.php)

You can publish the routes file with:
```bash
php artisan vendor:publish --provider="Playground\Admin\Resource\ServiceProvider" --tag="playground-routes"
```
- The routes while be published in a folder at `routes/playground-admin-resource`

### Environment Variables

If you are unable or do not want to publish [configuration files for this package](config/playground-admin-resource.php),
you may override the options via system environment variables.

Information on [environment variables is available on the wiki for this package](https://github.com/gammamatrix/playground-admin-resource/wiki/Environment-Variables)

## Migrations

This package requires the migrations in [playground-admin](https://github.com/gammamatrix/playground-admin) a Laravel package.

## Cloc

```sh
composer cloc
```

```
➜  playground-admin-resource git:(develop) ✗ composer cloc
     119 text files.
     106 unique files.                                          
      62 files ignored.

github.com/AlDanial/cloc v 2.08  T=0.07 s (1540.2 files/s, 294536.5 lines/s)
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
JSON                             4              0              0          10671
PHP                             57            824           1064           3124
YAML                            15              5              6           1749
Blade                           14             75             19           1574
XML                             13              0              7            949
Markdown                         2             54              1            133
INI                              1              3              0             12
-------------------------------------------------------------------------------
SUM:                           106            961           1097          18212
-------------------------------------------------------------------------------
```

## PHPStan

Tests at level 10 on:
- `config/`
- `lang/`
- `resources/views/`
- `routes/`
- `src/`
- `tests/Feature/`
- `tests/Unit/`

```sh
composer analyse
```

## Coding Standards

Format source code:
```sh
composer format
```

Format blades in resources/views:

```sh
composer format-blade
```
- **NOTE:** requires installing dev packages from package.json.

```sh
npm install
```

## Testing

Run unit tests:
```sh
composer test
```

Run unit and feature tests:
```sh
composer test-dev
```

Run unit and feature tests in parallel:
```sh
composer test-parallel
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
