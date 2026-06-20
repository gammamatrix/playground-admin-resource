<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Controllers;

use Illuminate\View\View;

/**
 * \Playground\Admin\Resource\Http\Controllers\IndexController
 */
class IndexController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'module_label' => 'Admin',
        'module_label_plural' => 'Admin',
        'module_route' => 'playground.admin.resource',
        'module_slug' => 'admin',
        'privilege' => 'playground-admin-resource',
        'view' => 'playground-admin-resource',
    ];

    /**
     * Show the index.
     */
    public function index(): View
    {
        $packageInfo = $this->packageInfo();

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::index', $packageInfo->view());

        return view($view, [
            'packageInfo' => $packageInfo,
        ]);
    }
}
