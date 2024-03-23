<?php

declare(strict_types=1);
/**
 * Playground
 */
namespace Tests\Unit\Playground\Admin\Resource\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
use Playground\Admin\Resource\ServiceProvider;
use Tests\Unit\Playground\Admin\Resource\TestCase;
use TiMacDonald\Log\LogEntry;
use TiMacDonald\Log\LogFake;

/**
 * \Tests\Unit\Playground\Admin\Resource\ServiceProvider\InstanceTest
 */
class InstanceTest extends TestCase
{
    public function test_version_matches(): void
    {
        $instance = (new \ReflectionClass(ServiceProvider::class))->newInstanceWithoutConstructor();

        $this->assertNotEmpty(ServiceProvider::VERSION);
        $this->assertIsString(ServiceProvider::VERSION);
        $this->assertSame(ServiceProvider::VERSION, $instance->version());
    }

    public function test_setPolicies_with_empty_array(): void
    {
        $instance = (new \ReflectionClass(ServiceProvider::class))->newInstanceWithoutConstructor();

        $policies = [];

        $instance->setPolicies($policies);

        $this->assertSame(
            $policies,
            $instance->policies()
        );
    }

    public function test_setPolicies_with_invalid_model(): void
    {
        $log = LogFake::bind();

        $instance = (new \ReflectionClass(ServiceProvider::class))->newInstanceWithoutConstructor();

        /**
         * @var array<class-string, class-string> $policies
         */
        $policies = [
            '\\Some\\InvalidModelClass' => '\\Some\\InvalidPolicyClass',
        ];

        $instance->setPolicies($policies);

        // $log->dump();

        $log->assertLogged(
            fn (LogEntry $log) => $log->level === 'error'
        );

        $log->assertLogged(
            fn (LogEntry $log) => is_string($log->message) && str_contains(
                $log->message,
                'Expecting the model to exist for the policy.'
            )
        );
    }

    public function test_setPolicies_with_invalid_policy(): void
    {
        $log = LogFake::bind();

        $instance = (new \ReflectionClass(ServiceProvider::class))->newInstanceWithoutConstructor();

        /**
         * @var array<class-string, class-string> $policies
         */
        $policies = [
            Model::class => '\\Some\\InvalidPolicyClass',
        ];

        $instance->setPolicies($policies);

        // $log->dump();

        $log->assertLogged(
            fn (LogEntry $log) => $log->level === 'error'
        );

        $log->assertLogged(
            fn (LogEntry $log) => is_string($log->message) && str_contains(
                $log->message,
                'Expecting the policy to exist for the model.'
            )
        );
    }
}
