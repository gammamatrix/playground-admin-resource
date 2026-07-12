<fieldset class="mb-3">
    <legend>{{ __("Access Control") }}</legend>

    <x-playground::forms.column-select
        column="role"
        label="Role"
        :autocomplete="false"
        :rules="[
            'required' => true,
            'maxlength' => 255,
        ]"
        :records="config('playground-admin-resource.roles.settable')"
    ></x-playground::forms.column-select>

    <fieldset class="mb-3" id="fieldset-status">
        <legend>{{ __("Roles") }}</legend>
        <div class="row">
            @foreach (config("playground-admin-resource.roles.settable") as $role)
                <div class="form-check form-check-inline">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="form-input-{{ $role["id"] }}"
                        name="roles[]"
                        value="{{ $role["id"] }}"
                        {{ in_array($role["id"], $data->roles ?? []) ? "checked" : "" }}
                    />
                    <label
                        class="form-check-label"
                        for="form-input-{{ $role["id"] }}"
                    >
                        <i class="fa-solid fa-chair text-info"></i>
                        {{ __($role["label"]) }}
                    </label>
                </div>
            @endforeach
        </div>
    </fieldset>
</fieldset>
