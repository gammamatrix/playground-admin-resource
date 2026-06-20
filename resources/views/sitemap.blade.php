<?php
$user = \Illuminate\Support\Facades\Auth::user();

$viewSettings = \Playground\Auth\Facades\Can::access($user, [
    "allow" => false,
    "any" => true,
    "privilege" => "playground-admin-resource:settings:viewAny",
    "roles" => ["admin"],
])->allowed();

$viewUsers = \Playground\Auth\Facades\Can::access($user, [
    "allow" => false,
    "any" => true,
    "privilege" => "playground-admin-resource:user:viewAny",
    "roles" => ["admin"],
])->allowed();
if (! $viewSettings && ! $viewUsers) {
    return;
}
?>

<div class="card my-1">
    <div class="card-body">
        <h2>Admin</h2>

        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">System Administration</div>
                    <ul class="list-group list-group-flush">
                        @if ($viewSettings)
                            <a
                                href="{{ route("playground.admin.resource.settings") }}"
                                class="list-group-item list-group-item-action"
                            >
                                Settings
                            </a>
                        @endif

                        @if ($viewUsers)
                            <a
                                href="{{ route("playground.admin.resource.users") }}"
                                class="list-group-item list-group-item-action"
                            >
                                Users
                            </a>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
