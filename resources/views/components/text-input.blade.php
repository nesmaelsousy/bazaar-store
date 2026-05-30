@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-3 py-2 border border-[#e5d3c5] rounded-lg outline-none focus:ring-2 focus:ring-[#c8a98d]']) }}>
