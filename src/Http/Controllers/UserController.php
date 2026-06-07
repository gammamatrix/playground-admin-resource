<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Playground\Admin\Resource\Http\Requests\User\CreateRequest;
use Playground\Admin\Resource\Http\Requests\User\DestroyRequest;
use Playground\Admin\Resource\Http\Requests\User\EditRequest;
use Playground\Admin\Resource\Http\Requests\User\IndexRequest;
use Playground\Admin\Resource\Http\Requests\User\LockRequest;
use Playground\Admin\Resource\Http\Requests\User\RestoreRequest;
use Playground\Admin\Resource\Http\Requests\User\ShowRequest;
use Playground\Admin\Resource\Http\Requests\User\StoreRequest;
use Playground\Admin\Resource\Http\Requests\User\UnlockRequest;
use Playground\Admin\Resource\Http\Requests\User\UpdateRequest;
use Playground\Admin\Resource\Http\Resources\User as UserResource;
use Playground\Admin\Resource\Http\Resources\UserCollection;

/**
 * \Playground\Admin\Resource\Http\Controllers\UserController
 */
class UserController extends Controller
{
    use Concerns\UserProvider;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_label' => 'User',
        'model_label_plural' => 'Users',
        'model_route' => 'playground.admin.resource.users',
        'model_slug' => 'id',
        'model_slug_plural' => 'users',
        'module_label' => 'Admin',
        'module_label_plural' => 'Admin',
        'module_route' => 'playground.admin.resource',
        'module_slug' => 'admin',
        'privilege' => 'playground-admin-resource:user',
        'table' => 'users',
        'view' => 'playground-admin-resource::user',
    ];

    /**
     * CREATE the User resource in storage.
     *
     * @route GET /resource/admin/users/create playground.admin.resource.users.create
     */
    public function create(
        CreateRequest $request
    ): JsonResponse|View {

        $validated = $request->validated();

        $u = $request->user();

        $user = $this->getUserInstance($validated);

        $meta = [
            'session_user_id' => $u?->getAttributeValue('id'),
            'id' => null,
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $user,
            'meta' => $meta,
            '_method' => 'post',
        ];

        if ($request->expectsJson()) {
            return response()->json($data);
        }

        $flash = $user->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
            $data['_return_url'] = $validated['_return_url'];
        }

        if (! $request->session()->has('errors')) {
            session()->flashInput($flash);
        }

        return view($this->getViewPath('user', 'form'), $data);
    }

    /**
     * Edit the User resource in storage.
     *
     * @route GET /resource/admin/users/edit/{id} playground.admin.resource.users.edit
     */
    public function edit(
        string|int $id,
        EditRequest $request
    ): JsonResponse|View {
        $validated = $request->validated();

        $user = $this->findUserOrFail($id);

        $u = $request->user();

        $meta = [
            'session_user_id' => $u?->getAttributeValue('id'),
            'id' => $user->getAttributeValue('id'),
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $user,
            'meta' => $meta,
            '_method' => 'patch',
        ];

        if ($request->expectsJson()) {
            return response()->json($data);
        }

        $flash = $user->toArray();

        if (! empty($validated['_return_url'])) {
            $flash['_return_url'] = $validated['_return_url'];
            $data['_return_url'] = $validated['_return_url'];
        }

        session()->flashInput($flash);

        return view(
            'playground-admin-resource::user/form',
            $data
        );
    }

    /**
     * Remove the User resource from storage.
     *
     * @route DELETE /resource/admin/users/{id} playground.admin.resource.users.destroy
     */
    public function destroy(
        string|int $id,
        DestroyRequest $request
    ): Response|RedirectResponse {
        $validated = $request->validated();

        $user = $this->findUserOrFail(
            $id,
            ! empty(config('playground-admin-resource.users.trashable'))
        );

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

        return redirect(route('playground.admin.resource.users'));
    }

    /**
     * Lock the User resource in storage.
     *
     * @route PUT /resource/admin/users/{id} playground.admin.resource.users.lock
     */
    public function lock(
        string|int $id,
        LockRequest $request
    ): JsonResponse|RedirectResponse|UserResource {
        $validated = $request->validated();

        $user = $this->findUserOrFail($id);

        $u = $request->user();

        $user->setAttribute('locked', true);

        $user->save();

        $meta = [
            'session_user_id' => $u?->getAttributeValue('id'),
            'id' => $user->getAttributeValue('id'),
            'timestamp' => Carbon::now()->toJson(),
            'info' => $this->packageInfo,
        ];
        // dump($request);

        if ($request->expectsJson()) {
            return (new UserResource($user))->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route('playground.admin.resource.users.show', ['id' => $user->getAttributeValue('id')]));
    }

    /**
     * Display a listing of User resources.
     *
     * @route GET /resource/admin/users playground.admin.resource.users
     */
    public function index(
        IndexRequest $request
    ): JsonResponse|View|UserCollection {
        $u = $request->user();

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

        // /**
        //  * @var class-string<Authenticatable>
        //  */
        // $uc = $this->getUserClass();

        $user = $this->getUserInstance();

        // $query = $uc::addSelect(sprintf('%1$s.*', $this->packageInfo['table']));
        $query = $user->query();

        if (is_callable([$query, 'sort'])) {
            $query->sort($validated['sort'] ?? null);
        }

        if (! empty($validated['filter']) && is_array($validated['filter'])) {

            if (is_callable([$query, 'filterTrash'])) {
                $query->filterTrash($validated['filter']['trash'] ?? null);
            }

            if (is_callable([$query, 'filterIds'])) {
                $query->filterIds(
                    $request->getPaginationIds(),
                    $validated
                );
            }

            if (is_callable([$query, 'filterFlags'])) {
                $query->filterFlags(
                    $request->getPaginationFlags(),
                    $validated
                );
            }

            if (is_callable([$query, 'filterDates'])) {
                $query->filterDates(
                    $request->getPaginationDates(),
                    $validated
                );
            }

            if (is_callable([$query, 'filterColumns'])) {
                $query->filterColumns(
                    $request->getPaginationColumns(),
                    $validated
                );
            }
        }

        $perPage = ! empty($validated['perPage']) && is_int($validated['perPage']) ? $validated['perPage'] : null;
        $paginator = $query->paginate($perPage);

        $paginator->appends($validated);

        if ($request->expectsJson()) {
            return (new UserCollection($paginator))->response($request);
        }

        $meta = [
            'session_user_id' => $u?->getAttributeValue('id'),
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
            'playground-admin-resource::user/index',
            $data
        );
    }

    /**
     * Restore the User resource from the trash.
     *
     * @route PUT /resource/admin/users/restore/{user} playground.admin.resource.users.restore
     */
    public function restore(
        string|int $id,
        RestoreRequest $request
    ): JsonResponse|RedirectResponse|UserResource {
        $validated = $request->validated();

        $user = $this->findUserOrFail(
            $id,
            ! empty(config('playground-admin-resource.users.trashable'))
        );

        // $u = $request->user();

        if (is_callable([$user, 'restore'])) {
            $user->restore();
        }

        if ($request->expectsJson()) {
            return (new UserResource($user))->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route('playground.admin.resource.users.show', ['id' => $user->getAttributeValue('id')]));
    }

    /**
     * Display the User resource.
     *
     * @route GET /resource/admin/users/{user} playground.admin.resource.users.show
     */
    public function show(
        string|int $id,
        ShowRequest $request
    ): JsonResponse|View|UserResource {
        $validated = $request->validated();

        $user = $this->findUserOrFail($id);

        $u = $request->user();

        $meta = [
            'session_user_id' => $u?->getAttributeValue('id'),
            'id' => $user->getAttributeValue('id'),
            'timestamp' => Carbon::now()->toJson(),
            'validated' => $validated,
            'info' => $this->packageInfo,
        ];

        if ($request->expectsJson()) {
            return (new UserResource($user))->response($request);
        }

        $meta['input'] = $request->input();
        $meta['validated'] = $request->validated();

        $data = [
            'data' => $user,
            'meta' => $meta,
        ];

        return view(
            'playground-admin-resource::user/detail',
            $data
        );
    }

    /**
     * Store a newly created API User resource in storage.
     *
     * @route POST /resource/admin playground.admin.resource.users.post
     */
    public function store(
        StoreRequest $request
    ): Response|JsonResponse|RedirectResponse|UserResource {
        $validated = $request->validated();

        $user = $this->getUserInstance($validated);

        // $u = $request->user();

        $user->save();

        if ($request->expectsJson()) {
            return (new UserResource($user))
                ->response($request)
                ->setStatusCode(201);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route('playground.admin.resource.users.show', ['id' => $user->getAttributeValue('id')]));
    }

    /**
     * Unlock the User resource in storage.
     *
     * @route DELETE /resource/admin/users/lock/{user} playground.admin.resource.users.unlock
     */
    public function unlock(
        string|int $id,
        UnlockRequest $request
    ): JsonResponse|RedirectResponse|UserResource {
        $validated = $request->validated();

        $user = $this->findUserOrFail($id);

        // $u = $request->user();

        $user->setAttribute('locked', false);

        $user->save();

        if ($request->expectsJson()) {
            return (new UserResource($user))->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route('playground.admin.resource.users.show', ['id' => $user->getAttributeValue('id')]));
    }

    /**
     * Update the User resource in storage.
     *
     * @route PATCH /resource/admin/users/{id} playground.admin.resource.users.patch
     */
    public function update(
        string|int $id,
        UpdateRequest $request
    ): JsonResponse|RedirectResponse|UserResource {
        $validated = $request->validated();

        $user = $this->findUserOrFail($id);

        $user->update($validated);

        if ($request->expectsJson()) {
            return (new UserResource($user))->response($request);
        }

        $returnUrl = $validated['_return_url'] ?? '';

        if ($returnUrl && is_string($returnUrl)) {
            return redirect($returnUrl);
        }

        return redirect(route('playground.admin.resource.users.show', ['id' => $user->getAttributeValue('id')]));
    }
}
