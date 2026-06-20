<?php

/**
 * Playground
 */

namespace Playground\Admin\Resource\Policies;

use Playground\Auth\Policies\ModelPolicy;

/**
 * \Playground\Admin\Resource\Policies\UserPolicy
 */
class UserPolicy extends ModelPolicy
{
    protected string $package = 'playground-admin-resource';

    /**
     * @var array<int, string> The roles allowed to view the MVC.
     */
    protected $rolesToView = [
        'user',
        'staff',
        'publisher',
        'manager',
        'admin',
        'root',
    ];

    /**
     * @var array<int, string> The roles allowed for actions in the MVC.
     */
    protected $rolesForAction = [
        'publisher',
        'manager',
        'admin',
        'root',
    ];
}
