# Playground Admin Resource

[![Playground CI Workflow](https://github.com/gammamatrix/playground-admin-resource/actions/workflows/ci.yml/badge.svg?branch=develop)](https://raw.githubusercontent.com/gammamatrix/playground-admin-resource/testing/develop/testdox.txt)
[![Test Coverage](https://raw.githubusercontent.com/gammamatrix/playground-admin-resource/testing/develop/coverage.svg)](tests)

[//]: # ([![PHPStan Level 9 src and tests]&#40;https://img.shields.io/badge/PHPStan-level%209-brightgreen&#41;]&#40;.github/workflows/ci.yml#L120&#41;)

The `playground-admin-resource` Laravel package.

## Documentation

Read more on using [Playground Admin Resource at Read the Docs: Playground Documentation.](https://gammamatrix-playground.readthedocs.io/en/develop/components/admin.html)


### Swagger

This application provides Swagger documentation: [swagger.json](swagger.json).
- The endpoint models support locks, trash with force delete, restoring and more.
- Index endpoints support advanced query filtering.

Swagger API Documentation is built with npm.
- npm is only needed to generate documentation and is not needed to operate the Admin UI and API Resource.

See [package.json](package.json) requirements.

Install npm.

```sh
npm install
```

Build the documentation to generate the [swagger.json](swagger.json) configuration.

```sh
npm run docs
```

Documentation
- Preview [swagger.json on the Swagger Editor UI.](https://editor.swagger.io/?url=https://raw.githubusercontent.com/gammamatrix/playground-admin-resource/develop/swagger.json)
- Preview [swagger.json on the Swagger Next Editor UI.](https://editor-next.swagger.io/?url=https://raw.githubusercontent.com/gammamatrix/playground-admin-resource/develop/swagger.json)
- Preview [swagger.json on the Redocly Editor UI.](https://redocly.github.io/redoc/?url=https://raw.githubusercontent.com/gammamatrix/playground-admin-resource/develop/swagger.json)

## Installation

You can install the package via composer:

```bash
composer require gammamatrix/playground-admin-resource
```

## `artisan about`

Playground provides information in the `artisan about` command.

<!-- <img src="resources/docs/artisan-about-playground-admin-resource.png" alt="screenshot of artisan about command with Playground Admin Resource."> -->

## Configuration

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Playground\Admin\Resource\ServiceProvider" --tag="playground-config"
```

All routes are enabled by default. They may be disabled via enviroment variable or the configuration.

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
➜  playground-admin-resource git:(develop) composer cloc
> cloc --exclude-dir=output,vendor .
     142 text files.
      97 unique files.
      46 files ignored.

github.com/AlDanial/cloc v 1.98  T=0.16 s (595.4 files/s, 64488.0 lines/s)
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
PHP                             59            707            881           3340
JSON                             3              0              0           2613
YAML                            14              5              0           1731
Blade                           15             70             15            783
XML                              3              0              5            225
Markdown                         2             41              1             74
INI                              1              3              0             12
-------------------------------------------------------------------------------
SUM:                            97            826            902           8778
-------------------------------------------------------------------------------
```

## PHPStan

Tests at level 9 on:
- `config/`
- `database/`
- `resources/views/`
- `routes/`
- `src/`
- `tests/Feature/`
- `tests/Unit/`

```sh
composer analyse
```

## Coding Standards

```sh
composer format
```

## Tests

```sh
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.
