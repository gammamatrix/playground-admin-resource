<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Controllers\Concerns;

use Playground\Models\User;

/**
 * \Playground\Admin\Resource\Http\Controllers\Concerns\UserProvider
 */
trait UserProvider
{
    protected User $providedUser;

    /**
     * @param  array<string, mixed>  $data
     */
    protected function getUserInstance(array $data = []): User
    {
        $user = new User($data);

        if (is_callable([$user, 'getTable'])) {
            $this->setPackageInfoValue('table', $user->getTable());
        }

        return $user;
    }

    protected function findUserOrFail(
        string|int $id,
        bool $withTrash = false
    ): User {
        if ($withTrash && is_callable([User::class, 'withTrashed'])) {
            return User::withTrashed()->findOrFail($id);
        }

        return User::findOrFail($id);
    }
}
