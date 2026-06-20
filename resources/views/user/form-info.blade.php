<fieldset class="mb-3">
    <legend>Information</legend>

    <x-playground::forms.column
        column="title"
        label="Title"
        :autocomplete="false"
        :rules="[
            'required' => false,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="name"
        label="Name"
        :autocomplete="false"
        :rules="[
            'required' => true,
            'maxlength' => 255,
        ]"
    >
        You should provide a
        <strong>name.</strong>
    </x-playground::forms.column>

    <x-playground::forms.column
        column="email"
        label="email"
        type="Email"
        :autocomplete="false"
        :rules="[
            'required' => true,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="phone"
        label="phone"
        type="phone"
        :autocomplete="false"
        :rules="[
            'required' => false,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="label"
        label="Label"
        :autocomplete="false"
        :rules="[
            'required' => false,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="locale"
        label="Locale"
        :autocomplete="false"
        :rules="[
            'required' => false,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="timezone"
        label="Timezone"
        :autocomplete="false"
        :rules="[
            'required' => false,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    {{--
        <x-playground::forms.column column="slug" label="SLUG" :autocomplete="false" :rules="[
        'required' => !empty($_method) && 'patch' === $_method,
        'maxlength' => 255,
        ]"/>
    --}}

    <x-playground::forms.column
        column="user_type"
        label="User Type"
        :rules="['maxlength' => 255,]"
    />
</fieldset>
