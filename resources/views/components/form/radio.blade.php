@props([
     'name', 'value' => '','checked'=>false,'options'
])


@foreach ( $options as $value =>$text)

<div class="form-check">
    <input
        type="radio"

        name="{{ $name }}"

        value="{{ $value }}"

        class="form-check-input"
                    {{-- $user->profile->gender == mail --}}

        @checked(old($name, $checked) == $value)

        {{ $attributes->class([
            'form-check-input',
            'is-invalid' => $errors->has($name)
        ]) }}
    >
    <label class="form-check-label" >{{ $text }}</label>

</div>

@endforeach

