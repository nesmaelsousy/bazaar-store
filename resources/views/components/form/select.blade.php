@props([
    'name',
    'label' => null,
    'type' => 'text',
    'oldVal' => '',
    'options' => [],
    'firstOne' => '',
    'value'=>[],
])
<div>
@if($label)
    <label for="{{ $name }}" class="form-label block">
        {{ $label }}
    </label>
@endif

<select
    name="{{ $name }}"
    id="{{ $name }}"
    {{ $attributes->merge(['class' => 'form-control']) }}
>
    <option value="">{{ $firstOne }}</option>

    @foreach ($options as $value => $label)
        <option value="{{ $value }}"
            {{ old($name, $oldVal) == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
</div>
