@extends(
    "playground::layouts.resource.form",
    [
        "withFormInfo" => "playground-admin-resource::user/form-info",
        "withFormStatus" => "playground-admin-resource::user/form-status",
    ]
)

@section("form-tertiary")
    @include("playground-admin-resource::user/form-dates")
@endsection
