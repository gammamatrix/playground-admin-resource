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
    protected int $status_code_guest_create = 403;

    protected int $status_code_json_guest_create = 403;

    protected int $status_code_guest_destroy = 403;

    protected int $status_code_json_guest_destroy = 403;

    protected int $status_code_json_guest_edit = 403;

    protected int $status_code_guest_edit = 403;

    protected int $status_code_json_guest_index = 403;

    protected int $status_code_guest_index = 403;

    protected int $status_code_json_guest_lock = 403;

    protected int $status_code_guest_lock = 403;

    protected int $status_code_json_guest_restore = 403;

    protected int $status_code_guest_restore = 403;

    protected int $status_code_json_guest_show = 403;

    protected int $status_code_guest_show = 403;

    protected int $status_code_guest_json_store = 403;

    protected int $status_code_guest_store = 403;

    protected int $status_code_guest_json_unlock = 403;

    protected int $status_code_guest_unlock = 403;

    protected int $status_code_guest_json_update = 403;

    protected int $status_code_guest_update = 403;
}
