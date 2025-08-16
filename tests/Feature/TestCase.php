<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Tests\Feature\Playground\Admin\Resource;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Playground\Test\OrchestraTestCase;
use Tests\Unit\Playground\Admin\Resource\PackageProviders;

/**
 * \Tests\Feature\Playground\Admin\Resource\TestCase
 */
class TestCase extends OrchestraTestCase
{
    use DatabaseTransactions;
    use PackageProviders;

    /**
     * @var array<string, array<string, array<int, string>>>
     */
    protected array $load_migrations = [
        'gammamatrix' => [
            'playground-admin' => [
                // 'migrations',
            ],
        ],
    ];

    protected bool $hasMigrations = true;

    protected bool $load_migrations_laravel = false;

    protected bool $load_migrations_playground = true;

    protected bool $setUpUserForPlayground = false;
}
