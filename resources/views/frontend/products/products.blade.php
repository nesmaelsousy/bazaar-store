@extends('master')
{{-- @push('css')
    <style>
        /* إخفاء السهم الأصلي للمتصفح */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        /* لإزالة السهم في Internet Explorer */
        select::-ms-expand {
            display: none;
        }
    </style>
@endpush --}}
@section('content')
    <main class="pt-20">
        <section class="px-6 pt-10 pb-14 bg-[#F7EEE9] min-h-screen">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row items-start gap-6">
                    <form action="{{ URL::current() }}" method="get">
                        <div class="bg-white w-full md:w-64 p-4 rounded-xl shadow-xl shrink-0">

                            <h3 class="font-bold text-[#835837] text-lg mb-2">Filter By</h3>

                            <label class="font-medium text-sm text-[#835837] ml-1">Category:</label>
                            <div class="relative">
                                <select id="categoryFilter" name="categories_name"
                                    class="appearance-none w-full mt-1 mb-2 p-2 text-sm text-[#835837] border outline-none rounded-lg focus:ring-1 focus:ring-[#c8a98d]">
                                    <option value="all">All</option>

                                    @foreach ($categories as $value => $category)
                                        <option value="{{ $value }}"> {{ $category }}</option>
                                    @endforeach
                                </select>

                            </div>


                            <label class="font-medium text-sm text-[#835837] ml-1">Artisan:</label>
                            <div class="relative">
                                <select id="artisanFilter" name="seller_name"
                                    class="appearance-none w-full mt-1 mb-2 p-2 text-sm text-[#835837] border outline-none rounded-lg focus:ring-1 focus:ring-[#c8a98d]">
                                    <option value="">All</option>
                                    @foreach ($sellers as $value => $seller)
                                        <option value="{{ $value }}">{{ $seller }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <label class="font-medium text-sm text-[#835837] ml-1">City:</label>
                            <div class="relative">
                                <select id="cityFilter" name="address"
                                    class="appearance-none w-full mt-1 mb-2 p-2 text-sm text-[#835837] border outline-none rounded-lg focus:ring-1 focus:ring-[#c8a98d]">
                                    <option value="">All</option>
                                    @foreach ($addresses as $value => $address)
                                        <option value="{{ $value }}">{{ $address }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <label class="font-medium text-sm text-[#835837] ml-1">Price Range: $0 - $1000</label>
                            <div class="flex gap-2 mt-1">
                                <input id="minPrice" type="number" name="minPrice" placeholder="From"
                                    class="w-1/2 p-1 text-sm text-[#835837] border outline-none rounded-lg focus:ring-1 focus:ring-[#c8a98d]"
                                    value="{{ old('minPrice', request('minPrice')) }}" min="0" max="1000">
                                <input id="maxPrice" type="number" name="maxPrice" placeholder="To"
                                    class="w-1/2 p-1 text-sm text-[#835837] border outline-none rounded-lg focus:ring-1 focus:ring-[#c8a98d]"
                                    value="{{ old('maxPrice', request('maxPrice')) }}" min="0" max="1000">
                            </div>
                            <button type="submit">Filtet</button>
                        </div>

                    </form>


                    <div class="flex-1 flex flex-col">
                        <div class="text-center mb-6 w-full max-w-2xl mx-auto md:translate-x-[-110px]">
                            <h2 class="text-3xl font-bold text-[#835837] mb-2">Browse Products</h2>
                            <p class="text-[#9A7F73] capitalize">Discover our unique collection of handmade products.</p>
                        </div>

                        <div class="flex items-center mb-6 w-full max-w-3xl mx-auto">
                            <div class="flex-1"></div>
                            <div class="relative w-full max-w-md">
                                <form action="{{ URL::current() }}" method="get">
                                    <input id="searchInput" type="text" placeholder="Product Search"
                                        class="w-full pl-9 p-2 border outline-none rounded-lg focus:ring-2 focus:ring-[#c8a98d]">
                                    <i
                                        class="fa-solid fa-magnifying-glass absolute top-1/2 left-3 -translate-y-1/2 text-[#9A7F73]"></i>
                            </div>
                            <div class="flex flex-1 justify-end items-center gap-3 ml-4">
                                <span id="countText" class="text-sm text-[#9A7F73] whitespace-nowrap"></span>
                                <div class="relative">
                                    <select id="sortSelect"
                                        class="appearance-none pl-3 pr-8 py-2 text-sm text-[#835837] border outline-none rounded-lg focus:ring-1 focus:ring-[#c8a98d]">
                                        <option value="newest">Newest</option>
                                        <option value="low-high">Price From Low to High</option>
                                        <option value="high-low">Price From High to Low</option>
                                    </select>

                                </div>
                                </form>
                            </div>
                        </div>

                        @include('frontend.products.partials.product-grid', ['products' => $products])
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
@push('scripts')
    <script src="{{ asset('frontend/js/products.js') }}"></script>
@endpush
