<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Admin\Resource\Console\Commands\About;

use Illuminate\Testing\PendingCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Admin\Resource\ServiceProvider;
use Tests\Feature\Playground\Admin\Resource\TestCase;

/**
 * \Tests\Feature\Playground\Admin\Resource\Console\Commands\About
 */
#[CoversClass(ServiceProvider::class)]
class CommandTest extends TestCase
{
    public function test_command_about_displays_package_information_and_succeed_with_code_0(): void
    {
        /**
         * @var PendingCommand $result
         */
        $result = $this->artisan('about');
        $result->assertExitCode(0);
        $result->expectsOutputToContain('Playground:Admin Resource');
    }
}
