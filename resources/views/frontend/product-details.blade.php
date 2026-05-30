@extends('master')
@section('content')
    <main class="max-w-6xl mx-auto pt-28 px-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-16">
            <!-- IMAGE -->
            <div>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <img src="{{asset('storage/' . $product->image)}}" alt="{{ $product->title }}"
                        class="w-full h-[380px] object-cover transition duration-500 cursor-zoom-in">
                </div>
                <div class="flex gap-3 mt-2 hidden md:block">
                    <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519"
                        class="size-24 object-cover rounded-lg cursor-pointer hover:opacity-80">
                </div>
            </div>

            <!-- DETAILS -->
            <div class="bg-white rounded-2xl shadow-2xl p-6">

                <h1 class="text-2xl text-[#835837] font-bold mb-3">
                   {{ $product->title }}
                </h1>

                <!-- RATING -->
                <div class="flex items-center gap-1 mb-4">
                    ⭐⭐⭐⭐☆
                    <span class="text-md text-[#835837] font-semibold">4.5</span>
                </div>

                <p class="text-[#9B6B4A] leading-relaxed mb-4">
                 {{ $product->description }}
                </p>

                <p class="text-xl text-[#835837] font-bold mb-4">
                    ${{ number_format($product->price, 2) }}
                </p>

                <!-- OPTIONS -->
                <form action="{{ route('frontend.cart.store') }}" method="POST">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="bg-[#F4E7DD] rounded-xl p-4 mb-6">

                        <h3 class="text-lg text-[#835837] font-bold mb-4">
                            Customization Options
                        </h3>

                        <!-- COLOR -->
                        <div class="mb-4">
                            <label class="block text-md text-[#9B6B4A] font-semibold mb-1">
                                Color :
                            </label>

                            <select class="w-full p-2 bg-white border rounded-lg">
                                <option>White</option>
                                <option>Brown</option>
                                <option>Beige</option>
                            </select>
                        </div>

                        <!-- SIZE -->
                        <div class="mb-4">
                            <label class="block text-md text-[#9B6B4A] font-semibold mb-1">
                                Size :
                            </label>

                            <select class="w-full p-2 bg-white border rounded-lg">
                                <option>Small</option>
                                <option>Medium</option>
                                <option>Large</option>
                            </select>
                        </div>

                        <!-- ENGRAVING -->
                        <div>
                            <label class="block text-md text-[#9B6B4A] font-semibold mb-1">
                                Engraving :
                            </label>

                            <input type="text" class="w-full p-2 border rounded-lg"
                                placeholder="Enter Text For Engraving">
                        </div>

                    </div>

                    <!-- QUANTITY -->
                    <div class="mb-6">
                        <x-input-label class="block text-md text-[#9B6B4A] font-bold mb-2">
                            Quantity :
                        </x-input-label>
                        <input type="number" name="quantity" value="1" min="1" class="w-24 p-2 border rounded-lg" />

        
                    </div>

                    <!-- BUTTONS -->
                    <div class="flex items-center gap-3">

                        <button type="submit" class="flex-1 bg-[#875E43] text-white py-2 rounded-lg">
                            🛒 Add To Cart
                        </button>

                        <button class="w-12 h-10 border border-[#875E43] rounded-lg">
                            ❤️
                        </button>

                    </div>

                    <div class="flex items-center gap-1 text-sm text-[#9B6B4A] mt-3">
                        📍 Made In Palestine
                    </div>

            </div>
            </form>

        </div>

        <!-- ARTISAN -->
        <div class="bg-white rounded-2xl shadow-xl mb-10 p-4">

            <h2 class="text-xl text-[#835837] font-bold mb-3">
                About The Artisan
            </h2>

            <div class="flex gap-3">

                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2"
                    class="size-24 rounded-full border-4 border-[#F7EEE9]">

                <div>
                    <h3 class="text-lg text-[#9B6B4A] font-bold">
                        Aisha Handmade Studio
                    </h3>

                    <p class="text-sm text-[#9B6B4A] mt-2">
                        Local artisan specializing in ceramic handmade pottery with 10+ years experience.
                    </p>
                </div>

            </div>
        </div>

        <!-- REVIEWS -->
        <div class="bg-white rounded-2xl shadow-xl p-4">

            <h2 class="text-xl text-[#835837] font-bold mb-4">
                Customer Reviews
            </h2>

            <div class="border-b py-2">
                <div class="flex justify-between">
                    <h3 class="font-semibold text-[#9B6B4A]">John Doe</h3>
                    <span class="text-sm text-[#9B6B4A]">2026-05-10</span>
                </div>

                <p class="text-[#9B6B4A] mt-1">
                    Amazing quality! I love the handmade feel.
                </p>
            </div>

            <div class="border-b py-2">
                <div class="flex justify-between">
                    <h3 class="font-semibold text-[#9B6B4A]">Sara Ali</h3>
                    <span class="text-sm text-[#9B6B4A]">2026-05-08</span>
                </div>

                <p class="text-[#9B6B4A] mt-1">
                    Very beautiful product and fast delivery.
                </p>
            </div>

        </div>

    </main>
@endsection
@push('scripts')
    @vite(['resources/js/product-details.js'])
@endpush
