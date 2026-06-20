<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Requests\User;

use Playground\Http\Requests\UpdateRequest as BaseUpdateRequest;

/**
 * \Playground\Admin\Resource\Http\Requests\User\UpdateRequest
 */
class UpdateRequest extends BaseUpdateRequest
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

    protected string $slug_table = '';

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // $table = config('playground-admin-resource.users.table');

        // if (! empty($table) && is_string($table)) {
        //     $this->slug_table = $table;
        // }

        parent::prepareForValidation();

        if (config('playground-admin-resource.users.rules') !== 'playground') {
            return;
        }

        $input = [];

        $this->filterContentFields($input);
        $this->filterCommonFields($input);
        $this->filterStatus($input);
        $this->filterSystemFields($input);

        if ($this->exists('phone')) {
            $input['phone'] = $this->filterPhone($this->input('phone'));
        }

        if ($this->exists('timezone')) {
            $input['timezone'] = $this->filterHtml($this->input('timezone'));
        }

        if (! empty($input)) {
            $this->merge($input);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        if (config('playground-admin-resource.users.rules') === 'playground') {
            $rules = static::RULES;
        } else {
            $rules = static::RULES_STANDARD;
        }

        return $rules;
    }
}
