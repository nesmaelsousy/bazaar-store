@extends('master')

@section('content')
    <main class="pt-20">
        <section class="px-6 pt-10 pb-14 bg-[#F7EEE9] min-h-screen">
            <div class="max-w-6xl mx-auto">

                <div class="flex flex-col md:flex-row items-start gap-6">

                    <!-- FILTERS -->
                    <form method="GET" class="bg-white w-full md:w-64 p-4 rounded-xl shadow-xl shrink-0">

                        <h3 class="font-bold text-[#835837] text-lg mb-3">Filter By</h3>

                        <!-- Category -->
                        <label class="font-medium text-sm text-[#835837]">Category</label>
                        <select name="category" class="w-full mt-1 mb-3 p-2 border rounded-lg">
                            <option value="all">All</option>
                            <option value="artworks">Artworks</option>
                            <option value="jewelry">Jewelry</option>
                            <option value="rugs">Rugs</option>
                        </select>

                        <!-- Search -->
                        <label class="font-medium text-sm text-[#835837]">Search</label>
                        <input name="search" type="text" class="w-full mt-1 mb-3 p-2 border rounded-lg"
                            placeholder="Search products">

                        <!-- Price -->
                        <label class="font-medium text-sm text-[#835837]">Price Range</label>
                        <div class="flex gap-2 mt-1">
                            <input name="min_price" type="number" class="w-1/2 p-2 border rounded-lg" placeholder="Min">
                            <input name="max_price" type="number" class="w-1/2 p-2 border rounded-lg" placeholder="Max">
                        </div>

                        <!-- Submit -->
                        <button class="w-full mt-4 bg-[#835837] text-white py-2 rounded-lg">
                            Apply
                        </button>

                    </form>

                    <!-- PRODUCTS -->
                    <div class="flex-1">

                        <!-- Header -->
                        <div class="text-center mb-6">
                            <h2 class="text-3xl font-bold text-[#835837]">Browse Products</h2>
                            <p class="text-[#9A7F73]">Discover handmade products</p>
                        </div>

                        <!-- Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                            @forelse($products as $product)
                                <div class="bg-white p-3 rounded-lg shadow hover:shadow-lg transition">

                                    <!-- PRODUCT LINK -->
                                    <a href="{{ route('frontend.product.show', $product->id) }}">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            class="w-full h-44 object-cover rounded-lg">

                                        <h6 class="text-[#5A3E2B] text-base font-bold line-clamp-2 mt-2">
                                            {{ $product->title }}
                                        </h6>
                                    </a>

                                    <!-- PRICE + CART -->
                                    <div class="flex justify-between items-center mt-3">

                                        <p class="text-[#835837] font-bold">
                                            ${{ $product->price }}
                                        </p>

                                        <!-- ADD TO CART FORM -->
                                        <form action="{{ route('frontend.cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            <button type="submit"
                                                class="text-[#875E43] text-xl hover:text-[#a05a1c] transition">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </button>
                                        </form>

                                    </div>

                                </div>
                            @empty
                                <p class="col-span-full text-center text-[#835837]">
                                    No Products Found
                                </p>
                            @endforelse
                        </div>

                    </div>

                </div>

            </div>
        </section>
    </main>
@endsection
