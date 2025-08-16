<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Admin\Resource\Http\Requests\User;

use Playground\Admin\Resource\Http\Requests\User\EditRequest;
use Tests\Unit\Playground\Admin\Resource\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Admin\Resource\Http\Requests\User\EditRequestTest
 */
class EditRequestTest extends RequestTestCase
{
    protected string $requestClass = EditRequest::class;

    public function test_return_playground_rules(): void
    {
        $instance = new EditRequest;

        $rules = $instance->rules();

        $this->assertIsArray($rules);

        $keys = [
            'user_type',
            'banned_at',
            'suspended_at',
            'gids',
            'po',
            'pg',
            'pw',
            'status',
            'rank',
            'size',
            'active',
            'banned',
            'flagged',
            'internal',
            'locked',
            'problem',
            'suspended',
            'unknown',
            'name',
            'email',
            'address',
            'password',
            'phone',
            'locale',
            'timezone',
            'label',
            'title',
            'byline',
            'slug',
            'url',
            'description',
            'introduction',
            'content',
            'summary',
            'icon',
            'image',
            'avatar',
            'ui',
            'abilities',
            'meta',
            'options',
            'sources',
            '_return_url',
        ];

        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $rules);
        }

        $this->assertCount(count($keys), $rules);
    }

    public function test_return_laravel_rules(): void
    {
        config([
            'playground-admin-resource.users.rules' => 'laravel',
        ]);
        $instance = new EditRequest;

        $rules = $instance->rules();

        $this->assertIsArray($rules);

        $keys = [
            'name',
            'email',
            '_return_url',
        ];

        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $rules);
        }

        $this->assertCount(count($keys), $rules);
    }
}
