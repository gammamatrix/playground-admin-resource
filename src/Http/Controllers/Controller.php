<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Admin\Resource\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Playground\PackageInfo;

/**
 * \Playground\Admin\Resource\Http\Controllers\Controller
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
    // use DispatchesJobs;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'module_label' => 'Admin',
        'module_label_plural' => 'Admin',
        'module_route' => 'playground.admin.resource',
        'module_slug' => 'admin',
        'privilege' => 'playground-admin-resource',
    ];

    public function packageInfo(): PackageInfo
    {
        return (new PackageInfo)->setOptions($this->packageInfo);
    }
}
