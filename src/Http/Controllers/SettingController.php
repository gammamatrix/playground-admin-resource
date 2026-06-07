<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Playground\Admin\Models\Setting;
use Playground\Admin\Resource\Http\Requests\Setting\CreateRequest;
use Playground\Admin\Resource\Http\Requests\Setting\DestroyRequest;
use Playground\Admin\Resource\Http\Requests\Setting\EditRequest;
use Playground\Admin\Resource\Http\Requests\Setting\IndexRequest;
use Playground\Admin\Resource\Http\Requests\Setting\LockRequest;
use Playground\Admin\Resource\Http\Requests\Setting\RestoreRequest;
use Playground\Admin\Resource\Http\Requests\Setting\ShowRequest;
use Playground\Admin\Resource\Http\Requests\Setting\StoreRequest;
use Playground\Admin\Resource\Http\Requests\Setting\UnlockRequest;
use Playground\Admin\Resource\Http\Requests\Setting\UpdateRequest;
use Playground\Admin\Resource\Http\Resources\Setting as SettingResource;
use Playground\Admin\Resource\Http\Resources\SettingCollection;

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
        'module_label_plural' => 'Admin',
        'module_route' => 'playground.admin.resource',
        'module_slug' => 'admin',
        'privilege' => 'playground-admin-resource:setting',
        'table' => 'admin_settings',
        'view' => 'playground-admin-resource::setting',
    ];

    /**
     * CREATE the Setting resource in storage.
     *
     * @route GET /resource/admin/settings/create playground.admin.resource.settings.create
     */
    public function create(
        CreateRequest $request
    ): JsonResponse|View {

        $validated = $request->validated();

        $user = $request->user();

        $setting = new Setting($validated);

        $meta = [
            'session_user_id' => $user?->id,
            'id' => null,
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $setting,
            'meta' => $meta,
            '_method' => 'post',
        ];

        if ($request->expectsJson()) {
            return response()->json($data);
        }

        $flash = $setting->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
            $data['_return_url'] = $validated['_return_url'];
        }

        if (! $request->session()->has('errors')) {
            session()->flashInput($flash);
        }

        return view($this->getViewPath('setting', 'form'), $data);
    }

    /**
     * Edit the Setting resource in storage.
     *
     * @route GET /resource/admin/settings/settings/edit playground.admin.resource.settings.edit
     */
    public function edit(
        Setting $setting,
        EditRequest $request
    ): JsonResponse|View {
        $validated = $request->validated();

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $setting->id,
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $setting,
            'meta' => $meta,
            '_method' => 'patch',
        ];

        if ($request->expectsJson()) {
            return response()->json($data);
        }

        $flash = $setting->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
            $data['_return_url'] = $validated['_return_url'];
        }

        session()->flashInput($flash);

        return view(
            'playground-admin-resource::setting/form',
            $data
        );
    }

    /**
     * Remove the Setting resource from storage.
     *
     * @route DELETE /resource/admin/settings/{setting} playground.admin.resource.settings.destroy
     */
    public function destroy(
        Setting $setting,
        DestroyRequest $request
    ): Response|RedirectResponse {
        $validated = $request->validated();

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

        return redirect(route('playground.admin.resource.settings'));
    }

    /**
     * Lock the Setting resource in storage.
     *
     * @route PUT /resource/admin/settings/{setting} playground.admin.resource.settings.lock
     */
    public function lock(
        Setting $setting,
        LockRequest $request
    ): JsonResponse|RedirectResponse|SettingResource {
        $validated = $request->validated();

        $user = $request->user();

        $setting->setAttribute('locked', true);

        $setting->save();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $setting->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $this->packageInfo,
        ];
        // dump($request);

        if ($request->expectsJson()) {
            return (new SettingResource($setting))->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route('playground.admin.resource.settings.show', ['setting' => $setting->id]));
    }

    /**
     * Display a listing of Setting resources.
     *
     * @route GET /resource/admin/settings playground.admin.resource.settings
     */
    public function index(
        IndexRequest $request
    ): JsonResponse|View|SettingCollection {
        $user = $request->user();

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

        $query = Setting::addSelect(sprintf('%1$s.*', $this->packageInfo['table']));

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
            return (new SettingCollection($paginator))->response($request);
        }

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
            'info' => $this->packageInfo,
        ];

        $data = [
            'paginator' => $paginator,
            'meta' => $meta,
        ];

        return view(
            'playground-admin-resource::setting/index',
            $data
        );
    }

    /**
     * Restore the Setting resource from the trash.
     *
     * @route PUT /resource/admin/settings/restore/{setting} playground.admin.resource.settings.restore
     */
    public function restore(
        Setting $setting,
        RestoreRequest $request
    ): JsonResponse|RedirectResponse|SettingResource {
        $validated = $request->validated();

        $user = $request->user();

        $setting->restore();

        if ($request->expectsJson()) {
            return (new SettingResource($setting))->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route('playground.admin.resource.settings.show', ['setting' => $setting->id]));
    }

    /**
     * Display the Setting resource.
     *
     * @route GET /resource/admin/settings/{setting} playground.admin.resource.settings.show
     */
    public function show(
        Setting $setting,
        ShowRequest $request
    ): JsonResponse|View|SettingResource {
        $validated = $request->validated();

        $user = $request->user();

        $meta = [
            'session_user_id' => $user?->id,
            'id' => $setting->id,
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        if ($request->expectsJson()) {
            return (new SettingResource($setting))->response($request);
        }

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $setting,
            'meta' => $meta,
        ];

        return view(
            'playground-admin-resource::setting/detail',
            $data
        );
    }

    /**
     * Store a newly created API Setting resource in storage.
     *
     * @route POST /resource/admin playground.admin.resource.settings.post
     */
    public function store(
        StoreRequest $request
    ): Response|JsonResponse|RedirectResponse|SettingResource {
        $validated = $request->validated();

        $user = $request->user();

        $setting = new Setting($validated);

        $setting->save();

        if ($request->expectsJson()) {
            return (new SettingResource($setting))
                ->response($request)
                ->setStatusCode(201);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route('playground.admin.resource.settings.show', ['setting' => $setting->id]));
    }

    /**
     * Unlock the Setting resource in storage.
     *
     * @route DELETE /resource/admin/settings/lock/{setting} playground.admin.resource.settings.unlock
     */
    public function unlock(
        Setting $setting,
        UnlockRequest $request
    ): JsonResponse|RedirectResponse|SettingResource {
        $validated = $request->validated();

        $user = $request->user();

        $setting->setAttribute('locked', false);

        $setting->save();

        if ($request->expectsJson()) {
            return (new SettingResource($setting))->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route('playground.admin.resource.settings.show', ['setting' => $setting->id]));
    }

    /**
     * Update the Setting resource in storage.
     *
     * @route PATCH /resource/admin/settings/{setting} playground.admin.resource.settings.patch
     */
    public function update(
        Setting $setting,
        UpdateRequest $request
    ): JsonResponse|RedirectResponse|SettingResource {
        $validated = $request->validated();

        $user = $request->user();

        $setting->update($validated);

        if ($request->expectsJson()) {
            return (new SettingResource($setting))->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route('playground.admin.resource.settings.show', ['setting' => $setting->id]));
    }
}
