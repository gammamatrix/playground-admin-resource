<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Playground\Admin\Models\Setting;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'resource/admin',
    'middleware' => config('playground-admin-resource.middleware.default'),
    'namespace' => '\Playground\Admin\Resource\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.admin.resource',
        'uses' => 'IndexController@index',
    ])->can('index', Setting::class);
});
