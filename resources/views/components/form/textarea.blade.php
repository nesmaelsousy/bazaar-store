@props(['name', 'label' => null, 'placeholder' => '', 'oldVal' =>''])

@if ($label)
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
    </label>
@endif

<textarea
    name="{{ $name }}"
    id="{{ $name }}"
    rows="5"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => 'form-control']) }}
>{{ old($name,$oldVal) }}</textarea>