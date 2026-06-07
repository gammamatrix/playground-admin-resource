<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Playground\Admin\Resource\Http\Requests\FormRequest;

/**
 * \Playground\Admin\Resource\Http\Requests\User\DestroyRequest
 */
class DestroyRequest extends FormRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [
        '_return_url' => ['nullable', 'url'],
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = parent::rules();

        $user = $this->user();

        if ($this->userHasAdminPrivileges($user)) {
            $rules['force'] = ['boolean'];
        }

        return $rules;
    }
}
