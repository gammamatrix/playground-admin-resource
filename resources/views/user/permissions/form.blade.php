@extends(
    "playground::layouts.resource.form",
    [
        "withFormInfo" => false,
        "withFormStatus" => false,
        "withFormFlags" => true,
        "withFormMatrix" => false,
        "withFormPublishing" => false,
        "withFormLifecycle" => false,
        "withFormStatus" => "playground-admin-resource::user/form-status",
        "withFormLabel" => false,
        //"withFormTitle" => false,
        "withFormParent" => false,
        "withFormContentPermissions" => false,
        "withFormPermissions" => true,
        "withFormPlanning" => false,
        "withFormButtons" => true,
        "withFormContent" => false,
        "withFormDescription" => false,
        "withFormIntroduction" => false,
        "withFormSummary" => false,
        "withBreadcrumbs" => true,
    ]
)

@section("form-tertiary")
    @include("playground-admin-resource::user/form-access-control")
@endsection

@section("form-breadcrumbs-post-index")
    <li class="breadcrumb-item">
        <a href="{{ route("playground.admin.resource.users.permissions") }}">
            {{ __("Permissions") }}
        </a>
    </li>
@endsection

@section("form-breadcrumbs-post-edit")
    <li class="breadcrumb-item">
        <a
            href="{{ route("playground.admin.resource.users.permissions.edit", ["user" => $data->id]) }}"
        >
            {{ __("Edit Permissions") }}
        </a>
    </li>
@endsection
