<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Tests\Feature\Playground\Admin\Resource\Http\Controllers\Playground;

use Tests\Feature\Playground\Admin\Resource\Http\Controllers\UserTestCase;

/**
 * \Tests\Feature\Playground\Admin\Resource\Http\Controllers\Playground\UserRouteTest
 */
class UserRouteTest extends UserTestCase
{
    protected int $status_code_guest_create = 403;

    protected int $status_code_json_guest_create = 403;

    protected int $status_code_guest_destroy = 403;

    protected int $status_code_json_guest_destroy = 403;

    protected int $status_code_json_user_destroy = 401;

    protected int $status_code_user_destroy = 401;

    protected int $status_code_json_guest_edit = 403;

    protected int $status_code_guest_edit = 403;

    protected int $status_code_json_guest_index = 403;

    protected int $status_code_guest_index = 403;

    protected int $status_code_json_guest_lock = 403;

    protected int $status_code_guest_lock = 403;

    protected int $status_code_json_user_lock = 401;

    protected int $status_code_user_lock = 401;

    protected int $status_code_json_guest_restore = 403;

    protected int $status_code_guest_restore = 403;

    protected int $status_code_json_user_restore = 401;

    protected int $status_code_user_restore = 401;

    protected int $status_code_json_guest_show = 403;

    protected int $status_code_guest_show = 403;

    protected int $status_code_guest_json_store = 403;

    protected int $status_code_guest_store = 403;

    protected int $status_code_guest_json_unlock = 403;

    protected int $status_code_guest_unlock = 403;

    protected int $status_code_guest_json_update = 403;

    protected int $status_code_guest_update = 403;

    protected int $status_code_user_json_unlock = 401;

    protected int $status_code_user_unlock = 401;

    protected string $create_info_parameter = 'email';

    protected string $create_info_invalid_value = '123456789';

    protected string $create_form_parameter = 'email';

    protected string $create_form_invalid_value = '123456789';

    protected string $edit_info_parameter = 'email';

    protected string $edit_info_invalid_value = '123456789';

    protected string $edit_form_parameter = 'email';

    protected string $edit_form_invalid_value = '123456789';

    protected string $store_json_parameter = 'email';

    /**
     * @var array<int, string>
     */
    protected array $store_json_without_payload_errors = [
        'email',
    ];

    protected string $store_parameter = 'email';

    /**
     * @var array<int, string>
     */
    protected array $store_without_payload_errors = [
        'email',
    ];

    protected string $update_json_parameter = 'email';

    /**
     * @var array<int, string>
     */
    protected array $json_update_without_payload_errors = [
        'email',
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $json_update_payload = [
        'email' => 'different@example.biz',
    ];

    protected string $update_parameter = 'email';

    /**
     * @var array<int, string>
     */
    protected array $update_without_payload_errors = [
        'email',
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $update_payload = [
        'email' => 'different@example.org',
    ];
}
