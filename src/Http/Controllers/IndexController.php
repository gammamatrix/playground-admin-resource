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
     * Show the index.
     */
    public function index(): View
    {
        return view('playground-admin-resource::index');
    }
}
