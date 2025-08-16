<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Requests\User;

use Playground\Admin\Resource\Http\Requests\FormRequest;

/**
 * \Playground\Admin\Resource\Http\Requests\User\RestoreRequest
 */
class RestoreRequest extends FormRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [
        '_return_url' => ['nullable', 'url'],
    ];
}
