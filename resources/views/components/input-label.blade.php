@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-md font-medium text-[#835837] mb-1']) }}>
    {{ $value ?? $slot }}
</label>
