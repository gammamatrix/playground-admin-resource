<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Tests\Feature\Playground\Admin\Resource\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Playground\Models\User;
use ValueError;

/**
 * \Tests\Feature\Playground\Admin\Resource\Http\Controllers\UserTestCase
 */
class UserTestCase extends TestCase
{
    // NOTE: App\Models\User does not exist during testing
    public string $fqdn = User::class;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'User',
        'model_label_plural' => 'Users',
        'model_route' => 'playground.admin.resource.users',
        'model_slug' => 'user',
        'model_slug_plural' => 'users',
        'module_label' => 'Admin',
        'module_label_plural' => 'Admin',
        'module_route' => 'playground.admin.resource',
        'module_slug' => 'admin',
        'privilege' => 'playground-admin-resource:user',
        'table' => 'users',
        'view' => 'playground-admin-resource::user',
    ];

    /**
     * @var array<int, string>
     */
    protected $structure_model = [
        'id',
        'created_by_id',
        'modified_by_id',
        'user_type',
        'created_at',
        'deleted_at',
        'updated_at',
        // 'banned_at',
        // 'suspended_at',
        'gids',
        'po',
        'pg',
        'pw',
        'rank',
        'size',
        'active',
        // 'banned',
        // 'flagged',
        // 'internal',
        'locked',
        // 'problem',
        // 'suspended',
        // 'unknown',
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
        // 'meta',
        // 'options',
        // 'sources',
    ];

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        /**
         * @var class-string<Model&Authenticatable>
         */
        $uc = config('auth.providers.users.model', '\\App\\Models\\User');

        if (! is_string($uc) || ! $uc || ! class_exists($uc)) {
            throw new ValueError(__('playground-admin-resource.admin.users.provider.invalid', [
                'user-class' => is_string($uc) ? $uc : gettype($uc),
            ]));
        }

        $this->fqdn = $uc;
    }
}
