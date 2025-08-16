<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Tests\Unit\Playground\Admin\Resource\Policies\SettingPolicy;

use Playground\Admin\Resource\Policies\SettingPolicy;
use Tests\Unit\Playground\Admin\Resource\TestCase;

/**
 * \ests\Unit\Playground\Admin\Resource\Policies\SettingPolicy\PolicyTest
 */
class PolicyTest extends TestCase
{
    public function test_policy_instance(): void
    {
        $instance = new SettingPolicy;

        $this->assertInstanceOf(SettingPolicy::class, $instance);
    }
}
