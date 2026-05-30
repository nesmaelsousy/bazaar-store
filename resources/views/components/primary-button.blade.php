<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full bg-[#a05a1c] text-white py-2 rounded-md transition hover:bg-[#6b3a12]']) }}>
    {{ $slot }}
</button>
