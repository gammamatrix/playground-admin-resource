<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Admin\Resource;

/**
 * \Tests\Unit\Playground\Admin\Resource\PackageProviders
 */
trait PackageProviders
{
    protected function getPackageProviders($app)
    {
        return [
            \Playground\Test\ServiceProvider::class,
            \Playground\ServiceProvider::class,
            \Playground\Auth\ServiceProvider::class,
            \Playground\Blade\ServiceProvider::class,
            \Playground\Http\ServiceProvider::class,
            \Playground\Login\Blade\ServiceProvider::class,
            \Playground\Site\Blade\ServiceProvider::class,
            \Playground\Admin\ServiceProvider::class,
            \Playground\Admin\Resource\ServiceProvider::class,
        ];
    }
}
