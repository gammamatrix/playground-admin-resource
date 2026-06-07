<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Tests\Feature\Playground\Admin\Resource\Http\Controllers;

use Playground\Admin\Models\Setting;

/**
 * \Tests\Feature\Playground\Admin\Resource\Http\Controllers\SettingTestCase
 */
class SettingTestCase extends TestCase
{
    public string $fqdn = Setting::class;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'Setting',
        'model_label_plural' => 'Settings',
        'model_route' => 'playground.admin.resource.settings',
        'model_slug' => 'setting',
        'model_slug_plural' => 'settings',
        'module_label' => 'Admin',
        'module_label_plural' => 'Admin',
        'module_route' => 'playground.admin.resource',
        'module_slug' => 'admin',
        'privilege' => 'playground-admin-resource:setting',
        'table' => 'admin_settings',
        'view' => 'playground-admin-resource::setting',
    ];

    /**
     * @var array<int, string>
     */
    protected $structure_model = [
        'id',
        'created_by_id',
        'modified_by_id',
        'owned_by_id',
        'parent_id',
        'setting_type',
        'created_at',
        'deleted_at',
        'updated_at',
        'resolved_at',
        'suspended_at',
        'gids',
        'po',
        'pg',
        'pw',
        'status',
        'rank',
        'size',
        'active',
        'encrypted',
        'flagged',
        'internal',
        'locked',
        'problem',
        'secure',
        'suspended',
        'unknown',
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
        'setting',
        'ui',
        'assets',
        'meta',
        'options',
        'sources',
    ];
}
