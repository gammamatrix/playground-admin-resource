<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Requests\Setting;

use Playground\Admin\Resource\Http\Requests\FormRequest;

/**
 * \Playground\Admin\Resource\Http\Requests\Setting\UnlockRequest
 */
class UnlockRequest extends FormRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [
        '_return_url' => ['nullable', 'url'],
    ];
}
