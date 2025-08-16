<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Admin\Resource\Http\Requests\Setting;

use Tests\Unit\Playground\Admin\Resource\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Admin\Resource\Http\Requests\Setting\CreateRequestTest
 */
class CreateRequestTest extends RequestTestCase
{
    protected string $requestClass = \Playground\Admin\Resource\Http\Requests\Setting\CreateRequest::class;
}
