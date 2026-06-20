<?php

/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Playground\Models\User;

/*
|--------------------------------------------------------------------------
| Admin Resource Routes: User
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'resource/admin/user',
    'middleware' => config('playground-admin-resource.middleware.default'),
    'namespace' => '\Playground\Admin\Resource\Http\Controllers',
], function () {

    Route::get('/{user:slug}', [
        'as' => 'playground.admin.resource.users.slug',
        'uses' => 'UserController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'resource/admin/users',
    'middleware' => config('playground-admin-resource.middleware.default'),
    'namespace' => '\Playground\Admin\Resource\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.admin.resource.users',
        'uses' => 'UserController@index',
    ])->can('index', User::class);

    Route::post('/index', [
        'as' => 'playground.admin.resource.users.index',
        'uses' => 'UserController@index',
    ])->can('index', User::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.admin.resource.users.create',
        'uses' => 'UserController@create',
    ])->can('create', User::class);

    Route::get('/edit/{user}', [
        'as' => 'playground.admin.resource.users.edit',
        'uses' => 'UserController@edit',
    ])->whereUuid('user')->can('edit', 'user');

    // Route::get('/go/{id}', [
    //     'as' => 'playground.admin.resource.users.go',
    //     'uses' => 'UserController@go',
    // ]);

    Route::get('/{user}', [
        'as' => 'playground.admin.resource.users.show',
        'uses' => 'UserController@show',
    ])->whereUuid('user')->can('detail', 'user')->withTrashed();

    // API

    Route::put('/lock/{user}', [
        'as' => 'playground.admin.resource.users.lock',
        'uses' => 'UserController@lock',
    ])->whereUuid('user')->can('lock', 'user');

    Route::delete('/lock/{user}', [
        'as' => 'playground.admin.resource.users.unlock',
        'uses' => 'UserController@unlock',
    ])->whereUuid('user')->can('unlock', 'user');

    Route::delete('/{user}', [
        'as' => 'playground.admin.resource.users.destroy',
        'uses' => 'UserController@destroy',
    ])->whereUuid('user')->can('delete', 'user')->withTrashed();

    Route::put('/restore/{user}', [
        'as' => 'playground.admin.resource.users.restore',
        'uses' => 'UserController@restore',
    ])->whereUuid('user')->can('restore', 'user')->withTrashed();

    Route::post('/', [
        'as' => 'playground.admin.resource.users.post',
        'uses' => 'UserController@store',
    ])->can('store', User::class);

    // Route::put('/', [
    //     'as' => 'playground.admin.resource.users.put',
    //     'uses' => 'UserController@store',
    // ])->can('store', Playground\Admin\Models\User::class);
    //
    // Route::put('/{user}', [
    //     'as' => 'playground.admin.resource.users.put.id',
    //     'uses' => 'UserController@store',
    // ])->whereUuid('user')->can('update', 'user');

    Route::patch('/{user}', [
        'as' => 'playground.admin.resource.users.patch',
        'uses' => 'UserController@update',
    ])->whereUuid('user')->can('update', 'user');
});
