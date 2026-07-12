<fieldset class="mb-3">
    <legend>{{ __("Status") }}</legend>

    <fieldset>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="form-input-rank" class="form-label">
                        {{ __("Rank") }}
                    </label>
                    <input
                        type="number"
                        class="form-control"
                        id="form-input-rank"
                        name="rank"
                        value="{{ old("rank") }}"
                    />
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="form-input-size" class="form-label">
                        {{ __("Size") }}
                    </label>
                    <input
                        type="number"
                        class="form-control"
                        id="form-input-size"
                        name="size"
                        value="{{ old("size") }}"
                    />
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="form-input-status" class="form-label">
                        {{ __("Status") }}
                    </label>
                    <input
                        type="number"
                        class="form-control"
                        id="form-input-status"
                        name="status"
                        value="{{ old("status") }}"
                        min="0"
                    />
                </div>
            </div>
        </div>
    </fieldset>

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
                    <input type="hidden" name="banned" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_banned"
                        name="banned"
                        value="1"
                        {{ $data->banned ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_banned">
                        <i class="fa-solid fa-ban text-warning"></i>
                        {{ __("Banned") }}
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
        </div>

        <div class="row">
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
        <div class="row">
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
                    <input type="hidden" name="internal" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status_internal"
                        name="internal"
                        value="1"
                        {{ $data->internal ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="status_internal">
                        <i class="fa-solid fa-server"></i>
                        {{ __("Internal") }}
                    </label>
                </div>
            </div>
        </div>
    </fieldset>
</fieldset>
