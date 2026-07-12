<?php
$packageInfo =
    ! empty($meta) && is_array($meta) && ! empty($meta["info"])
        ? $meta["info"]
        : null;
if (! ($packageInfo instanceof \Playground\PackageInfo)) {
    throw new RuntimeException(
        "Expecting package info for resources/views/user/permissions.blade.php",
        500,
    );
}

$sort = empty($sort) || ! is_array($sort) ? [] : $sort;

$filters = empty($filters) || ! is_array($filters) ? [] : $filters;

$validated = empty($validated) || ! is_array($validated) ? [] : $validated;

$columnsViewable = [
    "name" => [
        "label" => "Name",
    ],
    "email" => [
        "label" => "Email",
    ],
    "user_type" => [
        "hide-sm" => false,
        "label" => "User Type",
    ],
    "parent_id" => [
        "hide-sm" => true,
        "label" => "Parent id",
    ],
    "role" => [
        "hide-sm" => false,
        "label" => "Role",
    ],
    "roles" => [
        "hide-sm" => false,
        "label" => "Roles",
        "action" => "implode",
    ],
    "abilities" => [
        "hide-sm" => false,
        "label" => "abilities",
        "action" => "implode",
    ],
    "permissions" => [
        "hide-sm" => false,
        "label" => "Permissions",
        "action" => "implode",
    ],
    "privileges" => [
        "hide-sm" => false,
        "label" => "Privileges",
        "action" => "implode",
    ],
    "icon" => [
        "hide-sm" => true,
        "label" => "Icon",
    ],
    "image" => [
        "hide-sm" => true,
        "label" => "Image",
    ],
    "avatar" => [
        "hide-sm" => true,
        "label" => "Avatar",
    ],
    "active" => [
        "hide-sm" => true,
        "flag" => true,
        "label" => "Active",
        "onTrueClass" => "fa-solid fa-person-running",
    ],
    "banned" => [
        "hide-sm" => true,
        "flag" => true,
        "label" => "Banned",
        "onTrueClass" => "fa-solid fa-ban text-warning",
    ],
    "flagged" => [
        "hide-sm" => true,
        "flag" => true,
        "label" => "Flagged",
        "onTrueClass" => "fa-solid fa-flag",
    ],
    "internal" => [
        "hide-sm" => true,
        "flag" => true,
        "label" => "Internal",
        "onTrueClass" => "fa-solid fa-server",
    ],
    "locked" => [
        "hide-sm" => true,
        "flag" => true,
        "label" => "Locked",
        "onTrueClass" => "fa-solid fa-lock text-warning",
    ],
    "problem" => [
        "hide-sm" => true,
        "flag" => true,
        "label" => "Problem",
        "onTrueClass" => "fa-solid fa-triangle-exclamation text-danger",
    ],
    "retired" => [
        "hide-sm" => true,
        "flag" => true,
        "label" => "Retired",
        "onTrueClass" => "fa-solid fa-chair text-success",
    ],
    "suspended" => [
        "hide-sm" => true,
        "flag" => true,
        "label" => "Suspended",
        "onTrueClass" => "fa-solid fa-hand text-danger",
    ],
    "unknown" => [
        "hide-sm" => true,
        "flag" => true,
        "label" => "Unknown",
        "onTrueClass" => "fa-solid fa-question text-warning",
    ],
    "created_at" => [
        "hide-sm" => true,
        "label" => "Created at",
    ],
    "updated_at" => [
        "hide-sm" => true,
        "label" => "Updated at",
    ],
    "banned_at" => [
        "hide-sm" => true,
        "label" => "Banned at",
    ],
    "suspended_at" => [
        "hide-sm" => true,
        "label" => "Suspended at",
    ],
    "gids" => [
        "hide-sm" => true,
        "label" => "Gids",
        "onTrueClass" => "",
    ],
    "po" => [
        "hide-sm" => true,
        "label" => "Po",
        "onTrueClass" => "",
    ],
    "pg" => [
        "hide-sm" => true,
        "label" => "Pg",
        "onTrueClass" => "",
    ],
    "pw" => [
        "hide-sm" => true,
        "label" => "Pw",
        "onTrueClass" => "",
    ],
    "status" => [
        "hide-sm" => true,
        "label" => "Status",
    ],
    "rank" => [
        "hide-sm" => true,
        "label" => "Rank",
    ],
];

$columnsMobile = ["name", "email", "role"];

$columnsStandard = [
    "name",
    "email",
    "user_type",
    "role",
    "roles",
    "abilities",
    "permissions",
    "privileges",
    "icon",
    "active",
    "banned",
    "flagged",
    "internal",
    "locked",
    "problem",
    // "retired", TODO as retired
    "suspended",
    "unknown",
    "created_at",
    "updated_at",
];

$viewableColumns =
    ! empty($validated["columns"]) &&
    is_string($validated["columns"]) &&
    in_array($validated["columns"], ["all", "standard", "mobile"])
        ? $validated["columns"]
        : "standard";

if ($viewableColumns === "all") {
    $columns = $columnsViewable;
} elseif ($viewableColumns === "mobile") {
    $columns = Illuminate\Support\Arr::only($columnsViewable, $columnsMobile);
} else {
    $columns = Illuminate\Support\Arr::only($columnsViewable, $columnsStandard);
}

?>

@extends(
    "playground::layouts.resource.index",
    [
        "withTableColumns" => $columns,
        "routeEdit" => sprintf(
            '%1$s.permissions.edit',
            $packageInfo->model_route(),
        ),
    ]
)
