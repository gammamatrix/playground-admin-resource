<fieldset class="mb-3">
    <legend>Status</legend>

    <fieldset>
        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="active" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_active"
                        name="active"
                        value="1"
                        {{ $data->active ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_active">
                        <i class="fa-solid fa-person-running"></i>
                        {{ __("Active") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="planned" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_planned"
                        name="planned"
                        value="1"
                        {{ $data->planned ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_planned">
                        <i class="fa-solid fa-circle-pause text-success"></i>
                        {{ __("Planned") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="published" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_published"
                        name="published"
                        value="1"
                        {{ $data->published ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_published">
                        <i class="fa-solid fa-book"></i>
                        {{ __("Published") }}
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="flagged" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_flagged"
                        name="flagged"
                        value="1"
                        {{ $data->flagged ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_flagged">
                        <i class="fa-solid fa-flag text-warning"></i>
                        {{ __("Flagged") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="pending" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_pending"
                        name="pending"
                        value="1"
                        {{ $data->pending ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_pending">
                        <i class="fa-solid fa-circle-pause text-warning"></i>
                        {{ __("Pending") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="retired" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_retired"
                        name="retired"
                        value="1"
                        {{ $data->retired ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_retired">
                        <i class="fa-solid fa-chair text-success"></i>
                        {{ __("Retired") }}
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="problem" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_problem"
                        name="problem"
                        value="1"
                        {{ $data->problem ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_problem">
                        <i
                            class="fa-solid fa-triangle-exclamation text-danger"
                        ></i>
                        {{ __("Problem") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="locked" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_locked"
                        name="locked"
                        value="1"
                        {{ $data->locked ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_locked">
                        <i class="fa-solid fa-lock text-warning"></i>
                        {{ __("Locked") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="suspended" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_suspended"
                        name="suspended"
                        value="1"
                        {{ $data->suspended ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_suspended">
                        <i class="fa-solid fa-hand text-danger"></i>
                        {{ __("Suspended") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="unknown" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_unknown"
                        name="unknown"
                        value="1"
                        {{ $data->unknown ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_unknown">
                        <i class="fa-solid fa-question text-warning"></i>
                        {{ __("Unknown") }}
                    </label>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend class="text-warning">Access</legend>

        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="only_admin" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_only_admin"
                        name="only_admin"
                        value="1"
                        {{ $data->only_admin ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_only_admin">
                        <i class="fa-solid fa-user-gear"></i>
                        {{ __("Only Admin") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="only_user" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_only_user"
                        name="only_user"
                        value="1"
                        {{ $data->only_user ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_only_user">
                        <i class="fa-solid fa-user"></i>
                        {{ __("Only User") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="only_guest" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_only_guest"
                        name="only_guest"
                        value="1"
                        {{ $data->only_guest ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_only_guest">
                        <i class="fa-solid fa-person-rays"></i>
                        {{ __("Only Guest") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="allow_public" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_allow_public"
                        name="allow_public"
                        value="1"
                        {{ $data->allow_public ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_allow_public">
                        <i class="fa-solid fa-users-line"></i>
                        {{ __("Allow Public") }}
                    </label>
                </div>
            </div>
        </div>
    </fieldset>
</fieldset>
