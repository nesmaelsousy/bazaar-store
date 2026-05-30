@extends('master')

@section('content')
    <main class="min-h-screen max-w-6xl mx-auto pt-28 px-6">

        @if ($cart->getCart()->isNotEmpty())
            <p
                class="inline-flex items-center gap-2 bg-white text-sm text-[#a05a1c]
        border border-[#e5d3c5] rounded-lg my-6 px-3 py-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                You can modify the quantity, color / size, or delete the product.
            </p>
        @endif

        <!-- Cart Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse ($cart->getCart() as $item)
                <div class="bg-[#FFFDF9] rounded-2xl shadow-xl border border-[#eee] overflow-hidden">

                    <!-- Image -->
                    <div class="bg-white overflow-hidden aspect-square">
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->title }}"
                            class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    </div>

                    <!-- Content -->
                    <div class="p-4 space-y-3">

                        <h3 class="font-bold text-[#5A3E2B] text-lg">
                            {{ $item->product->title }}
                        </h3>

                        <!-- UPDATE FORM -->
                        <form action="{{ route('frontend.cart.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @if ($item->product->is_customizable)
                                <!-- Color -->
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-[#6B4F3A] font-semibold">
                                        Color:
                                    </span>

                                    <select name="color"
                                        class="w-[110px] px-2 py-1 text-sm border border-[#e5d3c5]
                                    rounded-lg bg-white text-[#6B4F3A] outline-none">

                                        @foreach ($item->product->colors ?? [] as $color)
                                            <option value="{{ $color }}"
                                                {{ $item->color == $color ? 'selected' : '' }}>
                                                {{ $color }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Size -->
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-[#6B4F3A] font-semibold">
                                        Size:
                                    </span>

                                    <select name="size"
                                        class="w-[110px] px-2 py-1 text-sm border border-[#e5d3c5]
                                    rounded-lg bg-white text-[#6B4F3A] outline-none">

                                        @foreach ($item->product->sizes ?? [] as $size)
                                            <option value="{{ $size }}"
                                                {{ $item->size == $size ? 'selected' : '' }}>
                                                {{ $size }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Engraving -->
                                <p
                                    class="text-sm text-[#7A4E2D] bg-[#f3d6c3]
                            px-2 py-1 rounded-md inline-block">
                                    Engraving: {{ $item->engraving ?: 'None' }}
                                </p>
                            @endif

                            <!-- Price -->
                            <p class="text-lg text-[#c26a2d] font-bold">
                                ${{ number_format($item->product->price * $item->quantity, 2) }}
                            </p>

                            <!-- Quantity + Delete -->
                            <div class="flex items-center justify-between pt-2">

                                <!-- Quantity -->
                                <div class="flex items-center gap-3 bg-[#f1e4db] px-3 py-2 rounded-lg">

                                    <!-- Minus -->
                                    <button type="submit" name="quantity" value="{{ max(1, $item->quantity - 1) }}"
                                        class="w-7 h-7 bg-white rounded hover:bg-gray-100">
                                        -
                                    </button>

                                    <span class="font-medium">
                                        {{ $item->quantity }}
                                    </span>

                                    <!-- Plus -->
                                    <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}"
                                        class="w-7 h-7 bg-white rounded hover:bg-gray-100">
                                        +
                                    </button>

                                </div>
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

        @if ($cart->getCart()->count())
            <div class="flex justify-end my-10">
                <div class="flex flex-col gap-4 w-fit">
                    <h3 class="text-xl text-[#a05a1c] font-bold">
                        Total: ${{ number_format($cart->total(), 2) }}
                    </h3>

                    <a href="{{ route('login', ['redirect' => route('frontend.checkout.index')]) }}"
                        class="bg-[#a05a1c] text-white font-medium px-6 py-3 rounded-lg
                    transition hover:bg-[#c27a3f] text-center">
                        Proceed To Checkout
                    </a>
                </div>
            </div>
        @endif

    </main>
@endsection
