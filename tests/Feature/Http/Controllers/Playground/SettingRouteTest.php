<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Tests\Feature\Playground\Admin\Resource\Http\Controllers\Playground;

use Tests\Feature\Playground\Admin\Resource\Http\Controllers\SettingTestCase;

/**
 * \Tests\Feature\Playground\Admin\Resource\Http\Controllers\Playground\SettingRouteTest
 */
class SettingRouteTest extends SettingTestCase
{
    protected int $status_code_guest_create = 302;

    protected int $status_code_json_guest_create = 401;

    protected int $status_code_guest_destroy = 302;

    protected int $status_code_json_guest_destroy = 401;

    protected int $status_code_json_guest_edit = 401;

    protected int $status_code_guest_edit = 302;

    protected int $status_code_json_guest_index = 401;

    protected int $status_code_guest_index = 302;

    protected int $status_code_json_guest_lock = 401;

    protected int $status_code_guest_lock = 302;

    protected int $status_code_json_guest_restore = 401;

    protected int $status_code_guest_restore = 302;

    protected int $status_code_json_guest_show = 401;

    protected int $status_code_guest_show = 302;

    protected int $status_code_guest_json_store = 401;

    protected int $status_code_guest_store = 302;

    protected int $status_code_guest_json_unlock = 401;

    protected int $status_code_guest_unlock = 302;

    protected int $status_code_guest_json_update = 401;

    protected int $status_code_guest_update = 302;
}
