<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Admin\Resource\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Playground\Admin\Models\Setting as SettingModel;
use Playground\Admin\Resource\Http\Requests\FormRequest;

/**
 * \Playground\Admin\Resource\Http\Resources\Setting
 */
class Setting extends JsonResource
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
         * @var ?SettingModel $setting
         */
        $setting = $request->route('setting');

        return [
            'meta' => [
                'id' => $setting?->id,
                'rules' => $request->rules(),
                'session_user_id' => $request->user()?->id,
                'timestamp' => Carbon::now()->toJson(),
                'validated' => $request->validated(),
            ],
        ];
    }
}
