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
use Playground\Admin\Resource\Http\Requests;
use Playground\Admin\Resource\Http\Resources;
use Playground\Models\User;

/**
 * \Playground\Admin\Resource\Http\Controllers\UserController
 */
class UserController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'name',
        'model_label' => 'User',
        'model_label_plural' => 'Users',
        'model_route' => 'playground.admin.resource.users',
        'model_slug' => 'user',
        'model_slug_plural' => 'users',
        'module_label' => 'Admin',
        'module_label_plural' => 'Users',
        'module_route' => 'playground.admin.resource',
        'module_slug' => 'admin',
        'privilege' => 'playground-admin-resource:user',
        'table' => 'users',
        'view' => 'playground-admin-resource::user',
    ];

    /**
     * Create the User resource in storage.
     *
     * @route GET /resource/admin/users/create playground.admin.resource.users.create
     */
    public function create(
        Requests\User\CreateRequest $request
    ): JsonResponse|View|Resources\User {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $user = new User($validated);

        if ($request->expectsJson()) {
            return new Resources\User($user)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $currentUser = $request->user();

        $meta = [
            'session_user_id' => $currentUser?->id,
            'id' => null,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $user,
            'meta' => $meta,
            '_method' => 'post',
        ];

        $flash = $user->toArray();

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
     * Edit the User resource in storage.
     *
     * @route GET /resource/admin/users/edit/{user} playground.admin.resource.users.edit
     */
    public function edit(
        User $user,
        Requests\User\EditRequest $request
    ): JsonResponse|View|Resources\User {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        if ($request->expectsJson()) {
            return new Resources\User($user)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $currentUser = $request->user();

        $flash = $user->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
        }

        $meta = [
            'session_user_id' => $currentUser?->id,
            'id' => $currentUser?->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $user,
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
     * Edit the user permissions in storage.
     *
     * @route GET /resource/admin/users/edit/{user}/permissions playground.admin.resource.users.permissions.edit
     */
    public function editPermissions(
        User $user,
        Requests\User\EditRequest $request
    ): JsonResponse|View|Resources\User {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        if ($request->expectsJson()) {
            return new Resources\User($user)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $currentUser = $request->user();

        $flash = $user->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
        }

        $meta = [
            'session_user_id' => $currentUser?->id,
            'id' => $currentUser?->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $user,
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
        $view = sprintf('%1$s/permissions/form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Remove the User resource from storage.
     *
     * @route DELETE /resource/admin/users/{user} playground.admin.resource.users.destroy
     */
    public function destroy(
        User $user,
        Requests\User\DestroyRequest $request
    ): Response|RedirectResponse {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $currentUser = $request->user();

        if ($currentUser?->id) {
            $user->modified_by_id = $currentUser->id;
        }

        if (empty($validated['force'])) {
            $user->delete();
        } else {
            $user->forceDelete();
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
     * Lock the User resource in storage.
     *
     * @route PUT /resource/admin/users/{user} playground.admin.resource.users.lock
     */
    public function lock(
        User $user,
        Requests\User\LockRequest $request
    ): JsonResponse|RedirectResponse|Resources\User {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $currentUser = $request->user();

        if ($currentUser?->id) {
            $user->modified_by_id = $currentUser->id;
        }

        $user->locked = true;

        $user->save();

        if ($request->expectsJson()) {
            return new Resources\User($user)->additional(['meta' => [
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
        ), ['user' => $user->id]));
    }

    /**
     * Display a listing of User resources.
     *
     * @route GET /resource/admin/users playground.admin.resource.users
     */
    public function index(
        Requests\User\IndexRequest $request
    ): JsonResponse|View|Resources\UserCollection {

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

        $query = User::addSelect(sprintf('%1$s.*', $packageInfo->table()));

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
            return new Resources\UserCollection($paginator)->response($request);
        }

        $currentUser = $request->user();

        $meta = [
            'session_user_id' => $currentUser?->id,
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
     * Display a listing of User permissions.
     *
     * @route GET /resource/admin/users playground.admin.resource.users.permissions
     */
    public function permissions(
        Requests\User\IndexRequest $request
    ): JsonResponse|View|Resources\UserCollection {

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

        $query = User::addSelect(sprintf('%1$s.*', $packageInfo->table()));

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
            return new Resources\UserCollection($paginator)->response($request);
        }

        $currentUser = $request->user();

        $meta = [
            'session_user_id' => $currentUser?->id,
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
        $view = sprintf('%1$s/permissions', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Restore the User resource from the trash.
     *
     * @route PUT /resource/admin/users/restore/{user} playground.admin.resource.users.restore
     */
    public function restore(
        User $user,
        Requests\User\RestoreRequest $request
    ): JsonResponse|RedirectResponse|Resources\User {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $currentUser = $request->user();

        $user->modified_by_id = $currentUser?->id;

        $user->restore();

        if ($request->expectsJson()) {
            return new Resources\User($user)->additional(['meta' => [
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
        ), ['user' => $user->id]));
    }

    /**
     * Display the User resource.
     *
     * @route GET /resource/admin/users/{user} playground.admin.resource.users.show
     */
    public function show(
        User $user,
        Requests\User\ShowRequest $request
    ): JsonResponse|View|Resources\User {

        $packageInfo = $this->packageInfo();

        if ($request->expectsJson()) {
            return new Resources\User($user)->additional(['meta' => [
                'info' => $packageInfo,
            ]])->response($request);
        }

        $currentUser = $request->user();

        $meta = [
            'session_user_id' => $currentUser?->id,
            'id' => $currentUser?->id,
            'timestamp' => Carbon::now()->toJson(),
            'info' => $packageInfo,
        ];

        $data = [
            'data' => $user,
            'meta' => $meta,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s/detail', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Store a newly created API User resource in storage.
     *
     * @route POST /resource/admin/users playground.admin.resource.users.post
     */
    public function store(
        Requests\User\StoreRequest $request
    ): Response|JsonResponse|RedirectResponse|Resources\User {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $currentUser = $request->user();

        $user = new User($validated);

        $user->created_by_id = $currentUser?->id;

        $user->save();

        if ($request->expectsJson()) {
            return new Resources\User($user)->additional(['meta' => [
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
        ), ['user' => $user->id]));
    }

    /**
     * Unlock the User resource in storage.
     *
     * @route DELETE /resource/admin/users/lock/{user} playground.admin.resource.users.unlock
     */
    public function unlock(
        User $user,
        Requests\User\UnlockRequest $request
    ): JsonResponse|RedirectResponse|Resources\User {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $currentUser = $request->user();

        $user->locked = false;

        $user->modified_by_id = $currentUser?->id;

        $user->save();

        if ($request->expectsJson()) {
            return new Resources\User($user)->additional(['meta' => [
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
        ), ['user' => $user->id]));
    }

    /**
     * Update the User resource in storage.
     *
     * @route PATCH /resource/admin/users/{user} playground.admin.resource.users.patch
     */
    public function update(
        User $user,
        Requests\User\UpdateRequest $request
    ): JsonResponse|RedirectResponse|Resources\User {

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $currentUser = $request->user();

        $user->modified_by_id = $currentUser?->id;

        $user->update($validated);

        if ($request->expectsJson()) {
            return new Resources\User($user)->additional(['meta' => [
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
        ), ['user' => $user->id]));
    }
}
