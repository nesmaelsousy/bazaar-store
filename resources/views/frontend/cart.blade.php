@extends('master')

@section('content')
    <main class="min-h-screen max-w-6xl mx-auto pt-28 px-6">

        @if ($cart->isNotEmpty())
            <p
                class="inline-flex items-center gap-2 bg-white text-sm text-[#a05a1c]
        border border-[#e5d3c5] rounded-lg my-6 px-3 py-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                You can modify the quantity, color / size, or delete the product.
            </p>
        @endif

        <!-- Cart Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse ($cart as $item)
                <div class="bg-[#FFFDF9] rounded-2xl shadow-xl border border-[#eee] overflow-hidden">

                    <!-- Image -->
                    <div class="bg-white overflow-hidden aspect-square">
                        <a href="{{ route('frontend.product.show', $item->product->id) }}">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->title }}"
                                class="w-full h-full object-cover hover:scale-105 transition duration-300">
                        </a>

                    </div>

                    <!-- Content -->
                    <div class="p-4 space-y-3">

                        <h3 class="font-bold text-[#5A3E2B] text-lg">
                            {{ $item->product->title }}
                        </h3>

                        <!-- UPDATE FORM -->
                        <form action="{{ route('frontend.cart.update', $item->id) }}" class="relative" method="POST">
                            @csrf
                            @method('PUT')

                            @if ($item->product->is_customizable)
                                @foreach ($item->product->attributes ?? [] as $attr)
                                    @php
                                        $rawValue = $attr->pivot->value ?? null;
                                        $values = [];

                                        if ($rawValue) {
                                            $decoded = json_decode($rawValue, true);

                                            if (is_array($decoded) && isset($decoded['value'])) {
                                                $values = explode(',', $decoded['value']);
                                            } else {
                                                $values = explode(',', $rawValue);
                                            }
                                        }

                                        $selected = old('attributes.' . $attr->id, $item->attributes[$attr->id] ?? '');
                                    @endphp
                                    <!-- attrbute -->
                                    <div class="flex items-center gap-2 mb-3">

                                        <span class="text-sm text-[#6B4F3A] font-semibold">
                                            {{ $attr->name }}:
                                        </span>

                                        <select name="attributes[{{ $attr->id }}]"
                                            class="w-full p-2 border-[#e5d3c5] bg-white border rounded-lg">

                                            <option value="">Select {{ $attr->name }}</option>

                                            @foreach ($values as $val)
                                                <option value="{{ trim($val) }}" @selected($selected == trim($val))>
                                                    {{ trim($val) }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>
                                @endforeach




                                <div class="mb-3">
                                    <label class="text-sm text-[#6B4F3A] font-semibold">
                                        Engraving:
                                    </label>
                                    <textarea name="engraving" rows="3" id=""
                                        class="w-full p-2 border border-[#e5d3c5] bg-[#faebe1] rounded-lg">{{ old('engraving', $item->engraving) }}</textarea>

                                </div>
                            @endif
                            <div class="flex justify-between items-center">
                                <!-- Price -->
                                <p class="text-lg text-[#c26a2d] font-bold">
                                    ${{ number_format($item->product->price * $item->quantity, 2) }}
                                </p>


                            </div>


                            <!-- Quantity + Delete -->
                            <div class=" flex items-center justify-between pt-3 relative">

                                <!-- Quantity -->
                                <div class="flex items-center gap-3 bg-[#f1e4db] px-5 py-2 rounded-lg">

                                    <button type="button" onclick="decreaseQty(this)"
                                        class="w-7 h-7 bg-white rounded">-</button>

                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                        class="w-12 text-center border-0 bg-transparent outline-none">

                                    <button type="button" onclick="increaseQty(this)"
                                        class="w-7 h-7 bg-white rounded">+</button>

                                </div>
                                <!-- UPDATE BUTTON -->
                                <button type="submit"
                                    class="w-9 h-9 flex items-center justify-center 
               text-blue-500 rounded-full 
                transition shadow-md ms-20"
                                    title="تحديث">

                                    <i class="fa-solid fa-rotate"></i>
                                </button>


                        </form>

                        <!-- Delete -->
                        <form action="{{ route('frontend.cart.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>

                    </div>
                </div>
        </div>

    @empty

        <div class="col-span-full flex flex-col justify-center items-center text-center mt-20">
            <i class="fa-solid fa-cart-shopping text-6xl text-[#835837] mb-4 opacity-60"></i>

            <h2 class="text-2xl text-[#835837] font-bold mb-2">
                Cart is Empty
            </h2>

            <p class="text-[#9A7F73] mb-8">
                You Haven't Added Any Products Yet
            </p>

            <a href="{{ route('frontend.products.show') }}"
                class="bg-[#835837] text-white px-6 py-2 rounded-lg transition hover:bg-[#a05a1c]">
                Browse Products
            </a>
        </div>
        @endforelse

        </div>

        @if ($count)
            <div class="flex justify-end my-10">
                <div class="flex flex-col gap-4 w-fit">
                    <h3 class="text-xl text-[#a05a1c] font-bold">
                        Total: ${{ number_format($total, 2) }}
                    </h3>

                    <a href="{{ route('frontend.checkout.index') }}"
                        class="bg-[#a05a1c] text-white font-medium px-6 py-3 rounded-lg
                    transition hover:bg-[#c27a3f] text-center">
                        Proceed To Checkout
                    </a>
                </div>
            </div>
        @endif

    </main>
@endsection
@push('scripts')
    <script>
        function increaseQty(btn) {
            let input = btn.parentElement.querySelector('input');
            input.value = parseInt(input.value) + 1;
        }

        function decreaseQty(btn) {
            let input = btn.parentElement.querySelector('input');
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
@endpush
