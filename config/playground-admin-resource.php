<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Playground\Admin\Models\Setting;
use Playground\Admin\Resource\Policies\SettingPolicy;
use Playground\Admin\Resource\Policies\UserPolicy;
use Playground\Auth\Policies\Policy;
use Playground\Models\User;

/**
 * Playground: CMS Resource Configuration and Environment Variables
 *
 * @return array{
 *       about: bool,
 *       blade: string,
 *       layout: string,
 *       load: array{
 *           policies: bool,
 *           routes: bool,
 *           translations: bool,
 *           views: bool
 *       },
 *       matrix: array{
 *            enabled: bool,
 *        },
 *       middleware: array{
 *           default: string|string[],
 *           auth: string|string[],
 *           guest: string|string[]
 *       },
 *       policies: array<
 *           class-string<Model>,
 *           class-string<Policy>
 *       >,
 *       permissions: array{
 *           forbidden: string[],
 *            settable: string[],
 *        },
 *       roles: array{
 *           forbidden: string[],
 *            settable: string[],
 *        },
 *       routes: array{
 *           cms: bool,
 *           pages: bool,
 *           snippets: bool,
 *       },
 *       users: array{
 *           lockable: bool,
 *           trashable: bool,
 *           rules: string,
 *       },
 *       sitemap: array{
 *            enable: bool,
 *            guest: bool,
 *            user: bool,
 *            view: string
 *       },
 *       abilities: array<string, string[]>
 *   }
 */
return [
    /*
    |--------------------------------------------------------------------------
    | About Information
    |--------------------------------------------------------------------------
    |
    | By default, information will be displayed about this package when using:
    |
    | `artisan about`
    |
    */

    'about' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_ABOUT', true),

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    |
    */

    'blade' => env('PLAYGROUND_ADMIN_RESOURCE_BLADE', 'playground-admin-resource::'),

    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    |
    | By default, translations and views are loaded.
    |
    */

    'load' => [
        'policies' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_LOAD_POLICIES', true),
        'routes' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_LOAD_ROUTES', true),
        'translations' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_LOAD_TRANSLATIONS', true),
        'views' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_LOAD_VIEWS', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    |
    */

    'middleware' => [
        'default' => env('PLAYGROUND_ADMIN_RESOURCE_MIDDLEWARE_DEFAULT', ['web']),
        'auth' => env('PLAYGROUND_ADMIN_RESOURCE_MIDDLEWARE_AUTH', ['web', 'auth']),
        'guest' => env('PLAYGROUND_ADMIN_RESOURCE_MIDDLEWARE_GUEST', ['web']),
    ],

    /*
    |--------------------------------------------------------------------------
    | Policies
    |--------------------------------------------------------------------------
    |
    |
    */

    'policies' => [
        Setting::class => SettingPolicy::class,
        User::class => UserPolicy::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    |
    |
    */

    'permissions' => [
        'forbidden' => [],
        'settable' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    |
    |
    */

    'roles' => [
        'forbidden' => [
            'root',
        ],
        'settable' => [
            // Admins may be promoted to wheel.
            [
                'id' => 'admin',
                'label' => 'Admin',
                'group' => 'admin',
            ],
            [
                'id' => 'client',
                'label' => 'Client',
                'group' => 'user',
            ],
            [
                'id' => 'client-admin',
                'label' => 'Client Admin',
                'group' => 'admin',
            ],
            [
                'id' => 'guest',
                'label' => 'Guest',
                'group' => 'user',
            ],
            [
                'id' => 'manager',
                'label' => 'Manager',
                'group' => 'admin',
            ],
            [
                'id' => 'manager-admin',
                'label' => 'Manager Admin',
                'group' => 'admin',
            ],
            [
                'id' => 'nobody',
                'label' => 'Nobody',
                'group' => 'user',
            ],
            [
                'id' => 'partner',
                'label' => 'Partner',
                'group' => 'user',
            ],
            [
                'id' => 'partner-admin',
                'label' => 'Partner Admin',
                'group' => 'admin',
            ],
            [
                'id' => 'publisher',
                'label' => 'Publisher',
                'group' => 'admin',
            ],
            [
                'id' => 'publisher-admin',
                'label' => 'Publisher Admin',
                'group' => 'admin',
            ],
            [
                'id' => 'sales',
                'label' => 'Sales',
                'group' => 'admin',
            ],
            [
                'id' => 'sales-admin',
                'label' => 'Sales Admin',
                'group' => 'admin',
            ],
            [
                'id' => 'support',
                'label' => 'Support',
                'group' => 'user',
            ],
            [
                'id' => 'support-admin',
                'label' => 'Support Admin',
                'group' => 'admin',
            ],
            [
                'id' => 'user',
                'label' => 'User',
                'group' => 'user',
            ],
            [
                'id' => 'user-admin',
                'label' => 'User Admin',
                'group' => 'admin',
            ],
            [
                'id' => 'vendor',
                'label' => 'Vendor',
                'group' => 'user',
            ],
            [
                'id' => 'vendor-admin',
                'label' => 'Vendor Admin',
                'group' => 'admin',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    'routes' => [
        'admin' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_ROUTES_ADMIN', true),
        'settings' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_ROUTES_SETTINGS', true),
        'users' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_ROUTES_USERS', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    |
    |
    */

    'users' => [
        'lockable' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_USERS_LOCKABLE', true),
        'trashable' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_USERS_TRASHABLE', true),
        'rules' => env('PLAYGROUND_ADMIN_RESOURCE_USERS_RULES', 'playground'),
        // 'rules' => env('PLAYGROUND_ADMIN_RESOURCE_USERS_RULES', 'laravel'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Sitemap
    |--------------------------------------------------------------------------
    |
    |
    */

    'sitemap' => [
        'enable' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_SITEMAP_ENABLE', true),
        'guest' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_SITEMAP_GUEST', true),
        'user' => (bool) env('PLAYGROUND_ADMIN_RESOURCE_SITEMAP_USER', true),
        'view' => env('PLAYGROUND_ADMIN_RESOURCE_SITEMAP_VIEW', 'playground-admin-resource::sitemap'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Abilities
    |--------------------------------------------------------------------------
    |
    |
    */

    'abilities' => [
        'admin' => [
            'playground-admin-resource:*',
        ],
        'manager' => [
            'playground-admin-resource:user:*',
            'playground-admin-resource:setting:*',
        ],
        'user' => [
            'playground-admin-resource:user:view',
            // 'playground-admin-resource:user:viewAny',
            'playground-admin-resource:setting:view',
            // 'playground-admin-resource:setting:viewAny',
        ],
        // 'guest' => [
        //     'deny',
        // ],
        // 'guest' => [
        //     'app:view',

        //     'playground:view',

        //     'playground-auth:logout',
        //     'playground-auth:reset-password',

        //     'playground-admin-resource:user:view',
        //     'playground-admin-resource:user:viewAny',
        //     'playground-admin-resource:setting:view',
        //     'playground-admin-resource:setting:viewAny',
        // ],
    ],
];
