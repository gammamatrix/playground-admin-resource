<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Controllers\Concerns;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use ValueError;

/**
 * \Playground\Admin\Resource\Http\Controllers\Concerns\UserProvider
 */
trait UserProvider
{
    protected Authenticatable $providedUser;

    /**
     * @return class-string<Model&Authenticatable>
     */
    protected function getUserClass(): string
    {
        /**
         * @var class-string<Model&Authenticatable>
         */
        $uc = config('auth.providers.users.model', '\\App\\Models\\User');

        if (! is_string($uc) || ! $uc || ! class_exists($uc)) {
            throw new ValueError(__('playground-admin-resource::admin.users.provider.invalid', [
                'user-class' => is_string($uc) ? $uc : gettype($uc),
            ]));
        }

        return $uc;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return Model&Authenticatable
     */
    protected function getUserInstance(array $data = []): Model
    {
        $uc = $this->getUserClass();

        $user = new $uc($data);

        if (is_callable([$user, 'getTable'])) {
            $this->setPackageInfoValue('table', $user->getTable());
        }

        return $user;
    }

    protected function findUserOrFail(
        string|int $id,
        bool $withTrash = false
    ): Model {
        $uc = $this->getUserClass();

        if ($withTrash && is_callable([$uc, 'withTrashed'])) {
            return $uc::withTrashed()->findOrFail($id);
        }

        return $uc::findOrFail($id);
    }
}
