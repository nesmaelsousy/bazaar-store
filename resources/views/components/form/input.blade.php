@props(['name', 'label' => null, 'placeholder' => '', 'type' => 'text', 'oldVal' => ''])

<div class="mb-3">
    
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
        value="{{ old($name, $oldVal) }}"
        {{ $attributes->merge([
            'class' => 'form-control',
        ]) }}>

    @error($name)
        <p class="text-[red] mt-1" style="font-size: 0.875rem;">
            {{ $message }}
        </p>
    @enderror

</div>
