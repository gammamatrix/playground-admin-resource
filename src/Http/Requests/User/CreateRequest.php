<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Requests\User;

use Playground\Admin\Resource\Http\Requests\FormRequest;

/**
 * \Playground\Admin\Resource\Http\Requests\User\CreateRequest
 */
class CreateRequest extends FormRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [
        'user_type' => ['nullable', 'string'],
        'banned_at' => ['nullable', 'string'],
        'suspended_at' => ['nullable', 'string'],
        'gids' => ['integer'],
        'po' => ['integer'],
        'pg' => ['integer'],
        'pw' => ['integer'],
        'status' => ['integer'],
        'rank' => ['integer'],
        'size' => ['integer'],
        'active' => ['boolean'],
        'banned' => ['boolean'],
        'flagged' => ['boolean'],
        'internal' => ['boolean'],
        'locked' => ['boolean'],
        'problem' => ['boolean'],
        'suspended' => ['boolean'],
        'unknown' => ['boolean'],
        'name' => ['string'],
        'email' => ['email'],
        'address' => ['string'],
        'password' => ['string'],
        'phone' => ['string'],
        'locale' => ['string'],
        'timezone' => ['string'],
        'label' => ['string'],
        'title' => ['string'],
        'byline' => ['string'],
        'slug' => ['nullable', 'string'],
        'url' => ['string'],
        'description' => ['string'],
        'introduction' => ['string'],
        'content' => ['nullable', 'string'],
        'summary' => ['nullable', 'string'],
        'icon' => ['string'],
        'image' => ['string'],
        'avatar' => ['string'],
        'ui' => ['nullable', 'array'],
        'abilities' => ['nullable', 'array'],
        'meta' => ['nullable', 'array'],
        'options' => ['nullable', 'array'],
        'sources' => ['nullable', 'array'],
        '_return_url' => ['nullable', 'url'],
    ];

    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES_STANDARD = [
        'name' => ['string'],
        'email' => ['email'],
        '_return_url' => ['nullable', 'url'],
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (config('playground-admin-resource.users.rules') === 'playground') {
            $rules = is_array(static::RULES) ? static::RULES : [];
        } else {
            $rules = is_array(static::RULES_STANDARD) ? static::RULES_STANDARD : [];
        }

        return $rules;
    }
}
