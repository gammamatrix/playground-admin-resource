<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Playground\Admin\Models\Setting;

/*
|--------------------------------------------------------------------------
| Admin Routes: Setting
|--------------------------------------------------------------------------
|
|
*/
Route::group([
    'prefix' => 'resource/admin/setting',
    'middleware' => config('playground-admin-resource.middleware.auth'),
    'namespace' => '\Playground\Admin\Resource\Http\Controllers',
], function () {

    Route::get('/{setting:slug}', [
        'as' => 'playground.admin.resource.settings.slug',
        'uses' => 'SettingController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'resource/admin/settings',
    'middleware' => config('playground-admin-resource.middleware.auth'),
    'namespace' => '\Playground\Admin\Resource\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.admin.resource.settings',
        'uses' => 'SettingController@index',
    ])->can('index', Setting::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.admin.resource.settings.create',
        'uses' => 'SettingController@create',
    ])->can('create', Setting::class);

    Route::get('/edit/{setting}', [
        'as' => 'playground.admin.resource.settings.edit',
        'uses' => 'SettingController@edit',
    ])->whereUuid('setting')
        ->can('edit', 'setting');

    // Route::get('/go/{id}', [
    //     'as'   => 'playground.admin.resource.settings.go',
    //     'uses' => 'SettingController@go',
    // ]);

    Route::get('/{setting}', [
        'as' => 'playground.admin.resource.settings.show',
        'uses' => 'SettingController@show',
    ])->whereUuid('setting')
        ->can('detail', 'setting');

    // API

    Route::put('/lock/{setting}', [
        'as' => 'playground.admin.resource.settings.lock',
        'uses' => 'SettingController@lock',
    ])->whereUuid('setting')
        ->can('lock', 'setting');

    Route::delete('/lock/{setting}', [
        'as' => 'playground.admin.resource.settings.unlock',
        'uses' => 'SettingController@unlock',
    ])->whereUuid('setting')
        ->can('unlock', 'setting');

    Route::delete('/{setting}', [
        'as' => 'playground.admin.resource.settings.destroy',
        'uses' => 'SettingController@destroy',
    ])->whereUuid('setting')
        ->can('delete', 'setting')
        ->withTrashed();

    Route::put('/restore/{setting}', [
        'as' => 'playground.admin.resource.settings.restore',
        'uses' => 'SettingController@restore',
    ])->whereUuid('setting')
        ->can('restore', 'setting')
        ->withTrashed();

    Route::post('/', [
        'as' => 'playground.admin.resource.settings.post',
        'uses' => 'SettingController@store',
    ])->can('store', Setting::class);

    // Route::put('/', [
    //     'as'   => 'playground.admin.resource.settings.put',
    //     'uses' => 'SettingController@store',
    // ])->can('store', \Playground\Admin\Models\Setting::class);
    //
    // Route::put('/{setting}', [
    //     'as'   => 'playground.admin.resource.settings.put.id',
    //     'uses' => 'SettingController@store',
    // ])->whereUuid('setting')->can('update', 'setting');

    Route::patch('/{setting}', [
        'as' => 'playground.admin.resource.settings.patch',
        'uses' => 'SettingController@update',
    ])->whereUuid('setting')->can('update', 'setting');
});
