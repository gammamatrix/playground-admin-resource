<?php

declare(strict_types=1);
/**
 * Playground
 */

namespace Playground\Admin\Resource\Http\Requests\User;

use Playground\Http\Requests\IndexRequest as BaseIndexRequest;

/**
 * \Playground\Admin\Resource\Http\Requests\User\IndexRequest
 */
class IndexRequest extends BaseIndexRequest
{
    /**
     * @var array<string, mixed>
     */
    protected array $paginationDates = [
        'created_at' => ['column' => 'created_at', 'label' => 'Created At', 'nullable' => true],
        'updated_at' => ['column' => 'updated_at', 'label' => 'Updated At', 'nullable' => true],
        'deleted_at' => ['column' => 'deleted_at', 'label' => 'Deleted At', 'nullable' => true],
        'banned_at' => ['column' => 'banned_at', 'label' => 'Banned At', 'nullable' => true],
        'suspended_at' => ['column' => 'suspended_at', 'label' => 'Suspended At', 'nullable' => true],
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $paginationFlags = [
        'active' => ['column' => 'active', 'label' => 'Active', 'icon' => 'fa-solid fa-person-running'],
        'banned' => ['column' => 'banned', 'label' => 'Banned', 'icon' => 'fa-solid fa-ban text-warning'],
        'flagged' => ['column' => 'flagged', 'label' => 'Flagged', 'icon' => 'fa-solid fa-flag text-warning'],
        'internal' => ['column' => 'internal', 'label' => 'Internal', 'icon' => 'fa-solid fa-server'],
        'locked' => ['column' => 'locked', 'label' => 'Locked', 'icon' => 'fa-solid fa-lock text-warning'],
        'problem' => ['column' => 'problem', 'label' => 'Problem', 'icon' => 'fa-solid fa-triangle-exclamation text-danger'],
        'suspended' => ['column' => 'suspended', 'label' => 'Suspended', 'icon' => 'fa-solid fa-hand text-danger'],
        'unknown' => ['column' => 'unknown', 'label' => 'Unknown', 'icon' => 'fa-solid fa-question text-warning'],
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $paginationIds = [
        'id' => ['column' => 'id', 'label' => 'Id', 'type' => 'uuid', 'nullable' => false],
        'created_by_id' => ['column' => 'created_by_id', 'label' => 'Created By Id', 'type' => 'uuid', 'nullable' => true],
        'modified_by_id' => ['column' => 'modified_by_id', 'label' => 'Modified By Id', 'type' => 'uuid', 'nullable' => true],
        'user_type' => ['column' => 'user_type', 'label' => 'User Type', 'type' => 'string', 'nullable' => true],
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $paginationColumns = [
        'name' => ['column' => 'name', 'label' => 'Name', 'type' => 'string', 'nullable' => false],
        'email' => ['column' => 'email', 'label' => 'Email', 'type' => 'string', 'nullable' => false],
        'locale' => ['column' => 'locale', 'label' => 'locale', 'type' => 'string', 'nullable' => false],
        'timezone' => ['column' => 'timezone', 'label' => 'Timezone', 'type' => 'string', 'nullable' => false],
        'label' => ['column' => 'label', 'label' => 'Label', 'type' => 'string', 'nullable' => false],
        'title' => ['column' => 'title', 'label' => 'Title', 'type' => 'string', 'nullable' => false],
        'byline' => ['column' => 'byline', 'label' => 'Byline', 'type' => 'string', 'nullable' => false],
        'slug' => ['column' => 'slug', 'label' => 'Slug', 'type' => 'string', 'nullable' => true],
        'url' => ['column' => 'url', 'label' => 'Url', 'type' => 'string', 'nullable' => false],
        'description' => ['column' => 'description', 'label' => 'Description', 'type' => 'string', 'nullable' => false],
        'introduction' => ['column' => 'introduction', 'label' => 'Introduction', 'type' => 'string', 'nullable' => false],
        'content' => ['column' => 'content', 'label' => 'Content', 'type' => 'mediumText', 'nullable' => true],
        'summary' => ['column' => 'summary', 'label' => 'Summary', 'type' => 'mediumText', 'nullable' => true],
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $sortable = [
        'id' => ['column' => 'id', 'label' => 'Id', 'type' => 'string'],
        'created_by_id' => ['column' => 'created_by_id', 'label' => 'Created By Id', 'type' => 'string'],
        'modified_by_id' => ['column' => 'modified_by_id', 'label' => 'Modified By Id', 'type' => 'string'],
        'user_type' => ['column' => 'user_type', 'label' => 'User Type', 'type' => 'string'],
        'created_at' => ['column' => 'created_at', 'label' => 'Created At', 'type' => 'string'],
        'updated_at' => ['column' => 'updated_at', 'label' => 'Updated At', 'type' => 'string'],
        'deleted_at' => ['column' => 'deleted_at', 'label' => 'Deleted At', 'type' => 'string'],
        'banned_at' => ['column' => 'banned_at', 'label' => 'Banned At', 'type' => 'string'],
        'suspended_at' => ['column' => 'suspended_at', 'label' => 'Suspended At', 'type' => 'string'],
        'gids' => ['column' => 'gids', 'label' => 'Gids', 'type' => 'integer'],
        'po' => ['column' => 'po', 'label' => 'Po', 'type' => 'integer'],
        'pg' => ['column' => 'pg', 'label' => 'Pg', 'type' => 'integer'],
        'pw' => ['column' => 'pw', 'label' => 'Pw', 'type' => 'integer'],
        'status' => ['column' => 'status', 'label' => 'Status', 'type' => 'integer'],
        'rank' => ['column' => 'rank', 'label' => 'Rank', 'type' => 'integer'],
        'size' => ['column' => 'size', 'label' => 'Size', 'type' => 'integer'],
        'active' => ['column' => 'active', 'label' => 'Active', 'type' => 'boolean'],
        'banned' => ['column' => 'banned', 'label' => 'Banned', 'type' => 'boolean'],
        'flagged' => ['column' => 'flagged', 'label' => 'Flagged', 'type' => 'boolean'],
        'internal' => ['column' => 'internal', 'label' => 'Internal', 'type' => 'boolean'],
        'locked' => ['column' => 'locked', 'label' => 'Locked', 'type' => 'boolean'],
        'problem' => ['column' => 'problem', 'label' => 'Problem', 'type' => 'boolean'],
        'suspended' => ['column' => 'suspended', 'label' => 'Suspended', 'type' => 'boolean'],
        'unknown' => ['column' => 'unknown', 'label' => 'Unknown', 'type' => 'boolean'],
        'label' => ['column' => 'label', 'label' => 'Label', 'type' => 'string'],
        'title' => ['column' => 'title', 'label' => 'Title', 'type' => 'string'],
        'byline' => ['column' => 'byline', 'label' => 'Byline', 'type' => 'string'],
        'slug' => ['column' => 'slug', 'label' => 'Slug', 'type' => 'string'],
        'url' => ['column' => 'url', 'label' => 'Url', 'type' => 'string'],
        'description' => ['column' => 'description', 'label' => 'Description', 'type' => 'string'],
        'introduction' => ['column' => 'introduction', 'label' => 'Introduction', 'type' => 'string'],
        'content' => ['column' => 'content', 'label' => 'Content', 'type' => 'string'],
        'summary' => ['column' => 'summary', 'label' => 'Summary', 'type' => 'string'],
        'icon' => ['column' => 'icon', 'label' => 'Icon', 'type' => 'string'],
        'image' => ['column' => 'image', 'label' => 'Image', 'type' => 'string'],
        'avatar' => ['column' => 'avatar', 'label' => 'Avatar', 'type' => 'string'],
    ];
}
