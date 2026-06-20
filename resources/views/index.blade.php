@extends("playground::layouts.resource.layout")

@section("title", "Admin")

@section("breadcrumbs")
    <div class="container-fluid mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route("playground.admin.resource") }}">
                        Admin
                    </a>
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-1">
                    <div class="card-header">
                        <h1>Admin</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card m-1">
                                    <div class="card-body">
                                        <h5 class="card-title">Settings</h5>
                                        <h6
                                            class="card-subtitle mb-2 text-muted"
                                        >
                                            Manage settings
                                        </h6>
                                        <p class="card-text"></p>
                                        <a
                                            class="card-link"
                                            href="{{ route("playground.admin.resource.settings") }}"
                                        >
                                            View Settings
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="card m-1">
                                    <div class="card-body">
                                        <h5 class="card-title">Users</h5>
                                        <h6
                                            class="card-subtitle mb-2 text-muted"
                                        >
                                            Manage users
                                        </h6>
                                        <p class="card-text"></p>
                                        <a
                                            class="card-link"
                                            href="{{ route("playground.admin.resource.users") }}"
                                        >
                                            View Users
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
