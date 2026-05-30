@extends('master')
@section('content')
<main class="min-h-screen bg-[#F7EEE9] flex flex-col justify-center items-center px-6 pt-28 md:flex-row md:px-10 md:pt-24">

    <div class="w-full md:w-1/2 flex justify-center mb-6 mt-4 md:mb-0 md:mt-0">
        <img src="{{ asset('frontend/images/General-Images/Home-pic1.jpeg') }}" alt="Home Image" class="w-[85%] object-contain rounded-2xl shadow-lg transition duration-300 md:w-[90%]">
    </div>
    <div class="w-full text-center md:w-1/2 md:text-left">
        <h1 class="text-3xl text-[#835837] font-bold mb-4 leading-tight md:text-4xl">Discover the Beauty of Handmade Crafts</h1>
        <p class="text-base text-[#9A7F73] font-medium mb-8 capitalize">A platform bringing together the best local artisans and their authentic products.</p>
        <a href="categories.html" class="bg-[#EB8F42] text-[#5D2A11] text-lg font-bold px-6 py-3 rounded-2xl inline-block transition duration-300 hover:bg-[#5D2A11] hover:text-[#EB8F42]">Discover Now</a>
    </div>
</main>
<section class="px-6 py-14 bg-[#F7EEE9]">
    <div class="text-center mb-9">
        <h2 class="text-3xl font-bold text-[#835837] mb-2">Featured Products</h2>
        <p class="text-[#9A7F73] capitalize">Carefully selected from the best artisans</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 px-6 md:px-16">
        @forelse ($products as $product)
        <a href="{{ route('frontend.product.show',$product->id) }}">
               <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 cursor-pointer" data-id="4">
            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-44 object-cover">
            <div class="p-3">
                <h3 class="text-base font-bold text-[#835837] mb-3">{{ $product->title }}</h3>
                <div class="text-yellow-500 text-sm mb-2">
                    <i class="fa-solid fa-star"></i>
                    <span class="text-[#835837]">4.5</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-[#835837] text-lg">${{ $product->price }}</span>
                    <i class="fa-solid fa-cart-shopping text-xl text-[#835837] cursor-pointer hover:text-[#E6B693] add-to-cart" data-id="4"></i>
                </div>
            </div>
        </div>
        </a>
     
        @empty
        <div class="text-center col-span-4">
            <p class="text-xl text-[#835837]">No products found</p>
        </div>
        @endforelse
    </div>
    @if($products->total() > 8)
    <div class="text-center mt-10">
        <a href="{{ route('frontend.products.show') }}" class="inline-block border border-[#835837] text-[#835837] px-4 py-2 rounded hover:bg-[#835837] hover:text-white transition">View All Products</a>
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
                <div class="bg-[#f3e6dc] rounded-2xl shadow-md overflow-hidden p-4 text-center hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <img src="{{ $user->image ? asset('storage/' . $user->image) : 
                    asset('backend/image/avatar.jpg') }}" class="w-24 h-24 mx-auto rounded-full border-4 border-white mb-4 object-cover">
                    <div class="bg-white p-4 rounded-xl shadow-sm">
                        <h3 class="text-base font-bold text-[#835837] mb-1">{{ $user->name }}</h3>
                        <p class="flex justify-center items-center gap-1 text-sm text-[#835837] mb-2"><i class="fa-solid fa-location-dot text-[#c8a98d]"></i>{{ $user->country }}</p>
                        <p class="text-xs text-[#9A7F73] mb-5">{{ $user->description }}</p>
                        <div class="flex justify-between text-sm text-[#835837] font-medium">
                            <span class="flex items-center gap-1"><i class="fa-solid fa-star text-yellow-500"></i>4.8</span>
                            <span>444 Products</span>
                        </div>
                    </div>
                </div>

            @empty
            <div class="text-center col-span-4">
                <p class="text-xl text-[#835837]">No artisans found</p>
            </div>
            @endforelse
        </div>
        @if ($users->total() > 4)
        <div class="text-center mt-10">
            <a href="artisans.html" class="inline-block border border-[#835837] text-[#835837] px-4 py-2 rounded hover:bg-[#835837] hover:text-white transition">View All Artisans</a>
        </div>
        @endif
    </div>
</section>
<section class="bg-[#F7EEE9] py-14">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-[#835837] mb-2">Workshops This Month</h2>
            <p class="text-[#9A7F73] capitalize">Learn a new skill with the best artisans</p>
        </div>
        <div class="relative bg-white rounded-xl shadow-md overflow-hidden">
            <div id="slider" class="flex items-start transition-transform duration-500">
                <div class="min-w-full flex flex-col md:flex-row md:h-[320px]">
                    <img src="{{ asset('frontend/images/Cat3/cat3-pic1.jpeg') }}" class="w-full md:w-1/2 h-56 md:h-full object-cover">
                    <div class="flex flex-col justify-between md:justify-center h-full p-5">
                        <h3 class="text-xl font-medium text-[#835837] mb-2">Traditional Rug Weaving Workshop</h3>
                        <p class="text-[#9A7F73] mb-4">Learn the basics of mastering traditional Moroccan rug weaving.</p>
                        <p class="text-sm font-medium mb-1">Date: 2026-8-15</p>
                        <p class="text-sm font-medium mb-1">Duration: 4 Hours</p>
                        <p class="text-sm font-medium mb-1">Price: $120</p>
                        <p class="text-sm font-medium mb-4">Available Slots: 8</p>
                        <a href="auth.html" class="inline-block bg-[#a05a1c] text-white py-2 px-4 mt-4 rounded-lg hover:bg-[#6b3a12] transition text-center">Sign Up Now</a>
                    </div>
                </div>
                <div class="min-w-full flex flex-col md:flex-row md:h-[320px]">
                    <img src="{{ asset('frontend/images/Cat5/cat5-pic1.jpeg') }}" class="w-full md:w-1/2 h-56 md:h-full object-cover">
                    <div class="flex flex-col justify-between md:justify-center h-full p-5">
                        <h3 class="text-xl font-medium text-[#835837] mb-2">Handmade Pottery Workshop</h3>
                        <p class="text-[#9A7F73] mb-4">Learn the basics of shaping and designing clay pottery by hand.</p>
                        <p class="text-sm font-medium mb-1">Date: 2026-8-20</p>
                        <p class="text-sm font-medium mb-1">Duration: 3 Hours</p>
                        <p class="text-sm font-medium mb-1">Price: $90</p>
                        <p class="text-sm font-medium mb-4">Available Slots: 10</p>
                        <a href="auth.html" class="inline-block bg-[#a05a1c] text-white py-2 px-4 mt-4 rounded-lg hover:bg-[#6b3a12] transition text-center">Sign Up Now</a>
                    </div>
                </div>
                <div class="min-w-full flex flex-col md:flex-row md:h-[320px]">
                    <img src="{{ asset('frontend/images/Cat2/cat2-pic1.jpeg') }}" class="w-full md:w-1/2 h-56 md:h-full object-cover">
                    <div class="p-6 flex flex-col justify-between md:justify-center h-full p-5">
                        <h3 class="text-xl font-medium text-[#835837] mb-2">Handmade Jewelry Workshop</h3>
                        <p class="text-[#9A7F73] mb-4">Create your own unique jewelry pieces using natural stones and silver.</p>
                        <p class="text-sm font-medium mb-1">Date: 2026-8-24</p>
                        <p class="text-sm font-medium mb-1">Duration: 2.5 Hours</p>
                        <p class="text-sm font-medium mb-1">Price: $75</p>
                        <p class="text-sm font-medium mb-4">Available Slots: 12</p>
                        <a href="auth.html" class="inline-block bg-[#a05a1c] text-white py-2 px-4 mt-4 rounded-lg hover:bg-[#6b3a12] transition text-center">Sign Up Now</a>
                    </div>
                </div>
            </div>
            <button id="prev" class="hidden md:flex absolute left-2 top-1/2 -translate-y-1/2 bg-white text-[#835837] text-xl shadow-xl w-10 h-10 justify-center items-center rounded-full transition hover:bg-[#f3e7df]"><i class="fa-solid fa-chevron-left"></i></button>
            <button id="next" class="hidden md:flex absolute right-2 top-1/2 -translate-y-1/2 bg-white text-[#835837] text-xl shadow-xl w-10 h-10 justify-center items-center rounded-full transition hover:bg-[#f3e7df]"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>
</section>
<section class="py-12">
    <div class="max-w-5xl mx-auto text-center p-6">
        <h2 class="text-2xl font-bold text-[#835837] mb-5">About Bazaar Store</h2>
        <p class="font-medium text-[#9A7F73] capitalize mb-8 leading-loose">Bazaar store is an online platform dedicated to supporting local artisans and safeguarding handmade heritage. We believe that each handmade piece tells a unique story and contributes to sustaining traditional arts.</p>
        <a href="about.html" class="inline-block border border-[#835837] text-[#835837] px-5 py-2.5 rounded-md transition hover:bg-[#835837] hover:text-white">Learn More</a>
    </div>
</section>
@endsection