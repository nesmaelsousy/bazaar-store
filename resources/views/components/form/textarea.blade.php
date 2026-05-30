@props(['name', 'label' => null, 'placeholder' => '', 'oldVal' => ''])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control"
        rows="5"
        placeholder="{{ $placeholder }}"
    >{{ old($name, $oldVal) }}</textarea>
</div>