<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Tests\Unit\Playground\Admin\Resource\Http\Controllers\UserController;

use Playground\Admin\Resource\Http\Controllers\UserController;
use Playground\Test\MockingTrait;
use Tests\Unit\Playground\Admin\Resource\TestCase;
use ValueError;

/**
 * \Tests\Unit\Playground\Admin\Resource\Http\Controllers\UserController\InstanceTest
 */
class InstanceTest extends TestCase
{
    use MockingTrait;

    public function test_user_providerget_user_class_with_invalid_user_class(): void
    {
        $this->expectException(ValueError::class);
        // $this->expectExceptionMessage(InvalidArgumentException::class);

        $this->expectExceptionMessage('Expecting the user model class to exist');
        $this->expectExceptionMessage('\\Does\\Not\\Exist\\User');

        $this->expectExceptionMessage(__('playground-admin-resource::admin.users.provider.invalid', [
            'user-class' => '\\Does\\Not\\Exist\\User',
        ]));

        config(['auth.providers.users.model' => '\\Does\\Not\\Exist\\User']);

        $instance = new UserController;

        $this->invokeProtected($instance, 'getUserClass');
    }
}
