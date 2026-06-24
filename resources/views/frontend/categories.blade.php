@extends('master')
@section('content')
    <main class="pt-20">
        <section class="min-h-screen px-6 py-14 bg-[#F7EEE9]">
            <div class="max-w-5xl mx-auto">
                @if ($categories->isNotEmpty())
                    <div class="mb-9 text-center">

                        <h2 class="text-3xl font-bold text-[#835837] mb-2">Browse Categories</h2>
                        <p class="text-[#9A7F73] capitalize">Discover our unique collection of handmade products.</p>
                    </div>
                    <div class="flex justify-center items-center gap-4 mb-6 flex-wrap">
                        <div class="relative w-full md:w-1/2">
                            <form action="{{ URL::current() }}" method="GET">
                                <input id="searchInput" type="text" name="name" placeholder="Search For Category"
                                    class="w-full pl-9 p-2 border outline-none rounded-lg focus:ring-2 focus:ring-[#c8a98d]">
                                <i
                                    class="fa-solid fa-magnifying-glass absolute top-1/2 left-3 -translate-y-1/2 text-[#9A7F73]"></i>
                            </form>
                        </div>
                        <span id="countText" class="text-sm text-[#9A7F73]"></span>
                    </div>
                @endif

                <div id="categoriesContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse ($categories as $category)
                        <a href="{{ route('frontend.categories.products', $category->id) }}"
                            data-name="{{ $category->name }}"
                            class="category block bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                            {{-- {{ dd($category->image) }} --}}
                            <img src="{{ asset('storage/' . $category->image) }}" class="w-full h-44 object-cover">
                            <div class="p-3">
                                <h3 class="font-bold text-[#835837] mb-1">{{ $category->name }}</h3>
                                <p class="text-xs text-[#9A7F73] mb-2">{{ $category->description }}</p>
                                {{-- <div class="text-yellow-500 text-sm mb-2">
                                 <i class="fa-solid fa-star"></i>
                                 <span class="text-[#835837]">4.7</span>
                             </div> --}}
                                <span class="font-bold text-[#835837]">Starts From:
                                    {{ number_format($maxPrice, 2) }}</span>
                            </div>
                        </a>
                        {{-- <a href="products.html?category={{ $category->id }}" data-name="{{ $category->name }}"
                            class="category block bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                            <img src="{{ $category->image }}" class="w-full h-44 object-cover">
                            <div class="p-3">
                                <h3 class="font-bold text-[#835837] mb-1">{{ $category->name }}</h3>
                                <p class="text-xs text-[#9A7F73] mb-2">{{ $category->description }}</p>
                            </div>
                        </a>` --}}
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center min-h-64 text-center">
                            <div class="text-6xl mb-4 text-[#835837] opacity-50">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>

                            <h3 class="text-2xl font-bold text-[#835837] mb-2">
                                No Categories Found
                            </h3>

                            <p class="text-[#9A7F73] text-lg">
                                No categories available at the moment
                            </p>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script src="{{ asset('frontend/js/categories.js') }}"></script>
@endpush
