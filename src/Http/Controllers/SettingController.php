<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Admin\Resource\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Playground\Admin\Models\Setting;
use Playground\Admin\Resource\Http\Requests;
use Playground\Admin\Resource\Http\Resources;

/**
 * \Playground\Admin\Resource\Http\Controllers\SettingController
 */
class SettingController extends Controller
{
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
        'module_label_plural' => 'Directories',
        'module_route' => 'playground.admin.resource',
        'module_slug' => 'admin',
        'privilege' => 'playground-admin-resource:setting',
        'table' => 'admin_settings',
        'view' => 'playground-admin-resource::setting',
    ];

    /**
     * Create the Setting resource in storage.
     *
     * @route GET /resource/admin/settings/create playground.admin.resource.settings.create
     */
    public function create(
        Requests\Setting\CreateRequest $request
    ): JsonResponse|View|Resources\Setting {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $setting = new Setting($validated);

        if ($request->expectsJson()) {
            return new Resources\Setting($setting)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => null,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $setting,
            'meta' => $meta,
            '_method' => 'post',
        ];

        $flash = $setting->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
            $data['_return_url'] = $validated['_return_url'];
        }

        if (! $request->session()->has('errors')) {
            session()->flashInput($flash);
        }

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Edit the Setting resource in storage.
     *
     * @route GET /resource/admin/settings/edit/{setting} playground.admin.resource.settings.edit
     */
    public function edit(
        Setting $setting,
        Requests\Setting\EditRequest $request
    ): JsonResponse|View|Resources\Setting {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        if ($request->expectsJson()) {
            return new Resources\Setting($setting)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $user = $request->user();

        $flash = $setting->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
        }

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $setting->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $setting,
            'meta' => $meta,
            '_method' => 'patch',
        ];

        if (! empty($validated['_return_url'])) {
            $data['_return_url'] = $validated['_return_url'];
        }

        session()->flashInput($flash);

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Remove the Setting resource from storage.
     *
     * @route DELETE /resource/admin/settings/{setting} playground.admin.resource.settings.destroy
     */
    public function destroy(
        Setting $setting,
        Requests\Setting\DestroyRequest $request
    ): Response|RedirectResponse {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $setting->modified_by_id = $user->id;
        }

        if (empty($validated['force'])) {
            $setting->delete();
        } else {
            $setting->forceDelete();
        }

        if ($request->expectsJson()) {
            return response()->noContent();
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route($packageInfo->model_route()));
    }

    /**
     * Lock the Setting resource in storage.
     *
     * @route PUT /resource/admin/settings/{setting} playground.admin.resource.settings.lock
     */
    public function lock(
        Setting $setting,
        Requests\Setting\LockRequest $request
    ): JsonResponse|RedirectResponse|Resources\Setting {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        if ($user?->id) {
            $setting->modified_by_id = $user->id;
        }

        $setting->locked = true;

        $setting->save();

        if ($request->expectsJson()) {
            return new Resources\Setting($setting)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $packageInfo->model_route()
        ), ['setting' => $setting->id]));
    }

    /**
     * Display a listing of Setting resources.
     *
     * @route GET /resource/admin/settings playground.admin.resource.settings
     */
    public function index(
        Requests\Setting\IndexRequest $request
    ): JsonResponse|View|Resources\SettingCollection {

        $packageInfo = $this->packageInfo();

        /**
         * @var array{
         *     sort: string|array<mixed>,
         *     filter: array{
         *         trash: string
         *     },
         *     perPage: int
         * } $validated
         */
        $validated = $request->validated();

        $query = Setting::addSelect(sprintf('%1$s.*', $packageInfo->table()));

        $query->sort($validated['sort'] ?? null);

        if (! empty($validated['filter']) && is_array($validated['filter'])) {

            $query->filterTrash($validated['filter']['trash'] ?? null);

            $query->filterIds(
                $request->getPaginationIds(),
                $validated
            );

            $query->filterFlags(
                $request->getPaginationFlags(),
                $validated
            );

            $query->filterDates(
                $request->getPaginationDates(),
                $validated
            );

            $query->filterColumns(
                $request->getPaginationColumns(),
                $validated
            );
        }

        $perPage = ! empty($validated['perPage']) && is_int($validated['perPage']) ? $validated['perPage'] : null;
        $paginator = $query->paginate($perPage);

        $paginator->appends($validated);

        if ($request->expectsJson()) {
            return new Resources\SettingCollection($paginator)->response($request);
        }

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'columns' => $request->getPaginationColumns(),
            'dates' => $request->getPaginationDates(),
            'flags' => $request->getPaginationFlags(),
            'ids' => $request->getPaginationIds(),
            'rules' => $request->rules(),
            'sortable' => $request->getSortable(),
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $packageInfo,
        ];

        $data = [
            'paginator' => $paginator,
            'meta' => $meta,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/index', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Restore the Setting resource from the trash.
     *
     * @route PUT /resource/admin/settings/restore/{setting} playground.admin.resource.settings.restore
     */
    public function restore(
        Setting $setting,
        Requests\Setting\RestoreRequest $request
    ): JsonResponse|RedirectResponse|Resources\Setting {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $setting->modified_by_id = $user?->id;

        $setting->restore();

        if ($request->expectsJson()) {
            return new Resources\Setting($setting)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $packageInfo->model_route()
        ), ['setting' => $setting->id]));
    }

    /**
     * Display the Setting resource.
     *
     * @route GET /resource/admin/settings/{setting} playground.admin.resource.settings.show
     */
    public function show(
        Setting $setting,
        Requests\Setting\ShowRequest $request
    ): JsonResponse|View|Resources\Setting {

        $packageInfo = $this->packageInfo();

        if ($request->expectsJson()) {
            return new Resources\Setting($setting)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $setting->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $setting,
            'meta' => $meta,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/detail', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Store a newly created API Setting resource in storage.
     *
     * @route POST /resource/admin/settings playground.admin.resource.settings.post
     */
    public function store(
        Requests\Setting\StoreRequest $request
    ): Response|JsonResponse|RedirectResponse|Resources\Setting {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $setting = new Setting($validated);

        $setting->created_by_id = $user?->id;

        $setting->save();

        if ($request->expectsJson()) {
            return new Resources\Setting($setting)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request)->setStatusCode(201);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $packageInfo->model_route()
        ), ['setting' => $setting->id]));
    }

    /**
     * Unlock the Setting resource in storage.
     *
     * @route DELETE /resource/admin/settings/lock/{setting} playground.admin.resource.settings.unlock
     */
    public function unlock(
        Setting $setting,
        Requests\Setting\UnlockRequest $request
    ): JsonResponse|RedirectResponse|Resources\Setting {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $setting->locked = false;

        $setting->modified_by_id = $user?->id;

        $setting->save();

        if ($request->expectsJson()) {
            return new Resources\Setting($setting)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $packageInfo->model_route()
        ), ['setting' => $setting->id]));
    }

    /**
     * Update the Setting resource in storage.
     *
     * @route PATCH /resource/admin/settings/{setting} playground.admin.resource.settings.patch
     */
    public function update(
        Setting $setting,
        Requests\Setting\UpdateRequest $request
    ): JsonResponse|RedirectResponse|Resources\Setting {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = $request->user();

        $setting->modified_by_id = $user?->id;

        $setting->update($validated);

        if ($request->expectsJson()) {
            return new Resources\Setting($setting)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route(sprintf(
            '%1$s.show',
            $packageInfo->model_route()
        ), ['setting' => $setting->id]));
    }
}
