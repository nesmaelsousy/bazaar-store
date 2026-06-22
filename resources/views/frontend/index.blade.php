@extends('master')
@section('content')
    <main
        class="min-h-screen bg-[#F7EEE9] flex flex-col justify-center items-center px-6 pt-28 md:flex-row md:px-10 md:pt-24">

        <div class="w-full md:w-1/2 flex justify-center mb-6 mt-4 md:mb-0 md:mt-0">
            <img src="{{ asset('frontend/images/General-Images/Home-pic1.jpeg') }}" alt="Home Image"
                class="w-[85%] object-contain rounded-2xl shadow-lg transition duration-300 md:w-[90%]">
        </div>
        <div class="w-full text-center md:w-1/2 md:text-left">
            <h1 class="text-3xl text-[#835837] font-bold mb-4 leading-tight md:text-4xl">Discover the Beauty of Handmade
                Crafts</h1>
            <p class="text-base text-[#9A7F73] font-medium mb-8 capitalize">A platform bringing together the best local
                artisans and their authentic products.</p>
            <a href="{{ route('frontend.categories.index') }}"
                class="bg-[#EB8F42] text-[#5D2A11] text-lg font-bold px-6 py-3 rounded-2xl inline-block transition duration-300 hover:bg-[#5D2A11] hover:text-[#EB8F42]">Discover
                Now</a>
        </div>
    </main>
    <section class="px-6 py-14 bg-[#F7EEE9]">
        <div class="text-center mb-9">
            <h2 class="text-3xl font-bold text-[#835837] mb-2">Featured Products</h2>
            <p class="text-[#9A7F73] capitalize">Carefully selected from the best artisans</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 px-6 md:px-16">
            @forelse ($products as $product)
                <a href="{{ route('frontend.product.show', $product->id) }}">
                    <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 cursor-pointer"
                        data-id="4">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-44 object-cover">
                        <div class="p-3">
                            <h3 class="text-base font-bold text-[#835837] mb-3">{{ $product->title }}</h3>
                            <div class="text-yellow-500 text-sm mb-2">
                                <i class="fa-solid fa-star"></i>
                                <span class="text-[#835837]">4.5</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-[#835837] text-lg">${{ $product->price }}</span>
                                <i class="fa-solid fa-cart-shopping text-xl text-[#835837] cursor-pointer hover:text-[#E6B693] add-to-cart"
                                    data-id="4"></i>
                            </div>
                        </div>
                    </div>
                </a>

            @empty
                <div class="text-center col-span-4 py-12">
                    <div class="text-6xl mb-4 text-[#835837] opacity-50">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#835837] mb-2">No Products Found</h3>
                    <p class="text-[#9A7F73] text-lg">No products available at the moment</p>
                </div>
            @endforelse
        </div>
        @if ($products->total() > 8)
            <div class="text-center mt-10">
                <a href="{{ route('frontend.products.show') }}"
                    class="inline-block border border-[#835837] text-[#835837] px-4 py-2 rounded hover:bg-[#835837] hover:text-white transition">View
                    All Products</a>
            </div>
        @endif
    </section>
    <section class="bg-white py-14">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-[#835837] mb-2">Featured Artisans</h2>
                <p class="text-[#9A7F73] capitalize">Meet the talented creators behind these masterpieces</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 px-6 md:px-16">

                @forelse($users as $user)
                    <a href="{{ route('frontend.artisan.show', $user->id) }}">
                        <div
                            class="bg-[#f3e6dc] rounded-2xl shadow-md overflow-hidden p-4 text-center hover:shadow-xl hover:-translate-y-1 transition duration-300">
                            <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('backend/image/avatar.jpg') }}"
                                class="w-24 h-24 mx-auto rounded-full border-4 border-white mb-4 object-cover">
                            <div class="bg-white p-4 rounded-xl shadow-sm">
                                <h3 class="text-base font-bold text-[#835837] mb-1">{{ $user->name }}</h3>
                                <p class="flex justify-center items-center gap-1 text-sm text-[#835837] mb-2"><i
                                        class="fa-solid fa-location-dot text-[#c8a98d]"></i>{{ $user->address }}</p>
                                <p class="text-xs text-[#9A7F73] mb-5">{{ $user->bio }}</p>
                                <div class="flex justify-between text-sm text-[#835837] font-medium">
                                    <span class="flex items-center gap-1"><i
                                            class="fa-solid fa-star text-yellow-500"></i>{{ $user->product->rating ?? '0' }}
                                    </span>
                                    <span>{{ $user->product->stock_quantity ?? '0' }} Products</span>
                                </div>
                            </div>
                        </div>
                    </a>


                @empty
                    <div class="text-center col-span-4 py-12">
                        <div
                            class="empty-artisans-state inline-block bg-[#f3e6dc] rounded-2xl p-8 shadow-md max-w-md mx-auto">
                            <div class="text-6xl mb-4 text-[#835837] opacity-60">
                                <i class="fa-solid fa-palette"></i>
                            </div>
                            <h3 class="text-xl font-bold text-[#835837] mb-2">Be the First Artisan!</h3>
                            <p class="text-[#9A7F73] mb-4">Join our community of talented creators</p>
                            <a href="{{ route('register') }}"
                                class="inline-block bg-[#EB8F42] text-[#5D2A11] px-4 py-2 rounded-lg text-sm font-medium transition hover:bg-[#5D2A11] hover:text-[#EB8F42]">
                                Join Now
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
            @if ($users->total() > 4)
                <div class="text-center mt-10">
                    <a href="artisans.html"
                        class="inline-block border border-[#835837] text-[#835837] px-4 py-2 rounded hover:bg-[#835837] hover:text-white transition">View
                        All Artisans</a>
                </div>
            @endif
        </div>
    </section>
    <section class="bg-[#F7EEE9] py-14">
        <div class="max-w-4xl mx-auto px-6">

            {{-- Header --}}
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-[#835837] mb-2">
                    Workshops This Month
                </h2>
                <p class="text-[#9A7F73] capitalize">
                    Learn a new skill with the best artisans
                </p>
            </div>

            {{-- Slider --}}
            <div class="relative bg-white rounded-xl shadow-md overflow-hidden">

                <div id="slider" class="flex items-start transition-transform duration-500">

                    @forelse ($workshops as $workshop)
                        <div class="min-w-full flex flex-col md:flex-row md:h-[320px]">

                            {{-- Image --}}
                            <img src="{{ asset('storage/' . $workshop->image) }}"
                                class="w-full md:w-1/2 h-56 md:h-full object-cover">

                            {{-- Content --}}
                            <div class="flex flex-col justify-between md:justify-center h-full p-5">

                                <h3 class="text-xl font-medium text-[#835837] mb-2">
                                    {{ $workshop->title }}
                                </h3>

                                <p class="text-[#9A7F73] mb-4">
                                    {{ $workshop->description }}
                                </p>

                                <p class="text-sm font-medium mb-1">
                                    Date: {{ \Carbon\Carbon::parse($workshop->date)->format('Y-m-d') }}
                                </p>

                                <p class="text-sm font-medium mb-1">
                                    Duration: {{ $workshop->duration }} Hours
                                </p>

                                <p class="text-sm font-medium mb-1">
                                    Price: ${{ $workshop->price }}
                                </p>

                                <p class="text-sm font-medium mb-4">
                                    Available Slots: {{ $workshop->availableSlots }}
                                </p>

                                <button type="button"
                                        class="openContact inline-block bg-[#a05a1c] text-white text-center py-2 px-4 mt-4 rounded-lg hover:bg-[#6b3a12] transition">Contact
                                        Us Now</button>

                            </div>
                        </div>
                        @include('frontend.workshop.model')
                    @empty
                        <div class="p-6 text-center text-[#9A7F73] w-full">
                            No workshops available at the moment.
                        </div>
                    @endforelse

                </div>

                {{-- Buttons --}}
                @if ($workshops->isNotEmpty())
                    <button id="prev"
                        class="hidden md:flex absolute left-2 top-1/2 -translate-y-1/2 bg-white text-[#835837] text-xl shadow-xl w-10 h-10 justify-center items-center rounded-full hover:bg-[#f3e7df] transition">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <button id="next"
                        class="hidden md:flex absolute right-2 top-1/2 -translate-y-1/2 bg-white text-[#835837] text-xl shadow-xl w-10 h-10 justify-center items-center rounded-full hover:bg-[#f3e7df] transition">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                @endif

            </div>
        </div>
    </section>
    <section class="py-12">
        <div class="max-w-5xl mx-auto text-center p-6">
            <h2 class="text-2xl font-bold text-[#835837] mb-5">About Bazaar Store</h2>
            <p class="font-medium text-[#9A7F73] capitalize mb-8 leading-loose">Bazaar store is an online platform
                dedicated
                to supporting local artisans and safeguarding handmade heritage. We believe that each handmade piece tells a
                unique story and contributes to sustaining traditional arts.</p>
            <a href="{{ route('frontend.about') }}"
                class="inline-block border border-[#835837] text-[#835837] px-5 py-2.5 rounded-md transition hover:bg-[#835837] hover:text-white">Learn
                More</a>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="module" src="{{ asset('frontend/js/home-workshops.js') }}"></script>
@endpush
