<?php

/**
 * Playground
 */
declare(strict_types=1);

namespace Playground\Admin\Resource\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Playground\Admin\Resource\Http\Requests\FormRequest;

/**
 * \Playground\Admin\Resource\Http\Resources\User
 */
class User extends JsonResource
{
    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  Request&FormRequest  $request
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        /**
         * @var ?Model $user
         */
        $user = $request->route('user');

        return [
            'meta' => [
                'id' => $user?->getAttributeValue('id'),
                'rules' => $request->rules(),
                'session_user_id' => $request->user()?->getAttributeValue('id'),
                'timestamp' => Carbon::now()->toJson(),
                'validated' => $request->validated(),
            ],
        ];
    }
}
