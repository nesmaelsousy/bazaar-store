@extends('master')
@section('content')
    <main class="min-h-screen pt-28 pb-10 px-6">
        <div id="artisanContainer" class="max-w-6xl mx-auto">
            <!-- Artisan Info -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-6 justify-between">

                    <!-- Left: Image + Info -->
                    <div class="flex flex-col md:flex-row items-center gap-6 flex-1">

                        <div
                            class="w-28 h-28 bg-[#F7EEE9] flex justify-center items-center rounded-full shadow-md border-4 border-[#F4E7DD] overflow-hidden">

                            @if ($artisan->image)
                                <img src="{{ asset('storage/' . $artisan->image) }}"
                                    class="w-full h-full object-cover rounded-full" />
                            @else
                                <i class="fa-solid fa-user text-5xl text-[#9B6B4A]"></i>
                            @endif

                        </div>

                        <div class="text-center md:text-left">

                            <h1 class="text-2xl font-bold text-[#835837] mb-2">
                                {{ $artisan->name }}
                            </h1>

                            <p class="text-[#9B6B4A] mb-2">
                                <i class="fa-solid fa-location-dot mr-1"></i>
                                {{ $artisan->address ?? 'location' }}
                            </p>

                            <div class="flex items-center justify-center md:justify-start gap-1 mb-2">
                                @if ($artisan->product)
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $artisan->product->rating)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa-regular fa-star"></i>
                                        @endif
                                    @endfor
                                    <span class="text-[#835837] font-semibold ml-1">
                                        {{ $artisan->product->rating ?? '' }}</span>
                                @else
                                     <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">
                                <i class="fa-solid fa-star mr-1"></i>Rating:
                                 {{ number_format($artisan->product->rating ?? 0, 1) }}
                                 /5
                            </span>
                                @endif


                            </div>

                            <p class="text-sm text-[#9B6B4A] mb-3">
                                {{ $artisan->bio }}
                            </p>

                            <div class="text-sm text-[#835837] font-semibold">
                                {{ $artisan->products_count ?? 0 }} Products
                            </div>

                        </div>
                    </div>


                </div>

            </div>

            <!-- Products -->
            <h2 class="text-lg font-semibold mb-4 text-[#9B6B4A]">Products</h2>

            @if ($artisan->products->count())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    @foreach ($artisan->products as $prod)
                        <a href="{{ route('frontend.product.show', $prod->id) }}"
                            class="bg-white rounded-xl shadow hover:shadow-lg transition p-2">

                            <img src="{{ asset('storage/' . $prod->image) }}"
                                class="w-full h-32 object-cover rounded-lg mb-2" />

                            <p class="text-sm text-[#835837] font-semibold truncate">
                                {{ $prod->title }}
                            </p>

                            <p class="text-sm text-[#a05a1c] font-bold">
                                ${{ $prod->price }}
                            </p>
                            <div class="flex items-center gap-1 mt-1">
                                <i class="fa-solid fa-star text-yellow-500"></i>
                                <span class="text-sm text-gray-600">
                                    {{ number_format($prod->rating ?? 0, 1) }}
                                </span>
                            </div>
                        </a>
                    @endforeach

                </div>
            @else
                <div class="flex flex-col items-center justify-center min-h-[500px] gap-4 text-center px-4">
                    <i class="fa-solid fa-inbox text-6xl text-[#c2aa94]"></i>

                    <p class="text-2xl font-semibold text-[#ba9370]">
                        No products found
                    </p>

                    <p class="text-base text-[#a05a1c] max-w-md">
                        This artisan has not added any products yet.
                    </p>
                </div>
            @endif
        </div>





    </main>
@endsection
@push('scripts')
    <script type="module" src="{{ asset('frontend/js/script.js') }}"></script>
    <script type="module" src="{{ asset('frontend/js/artisan-details.js') }}"></script>
@endpush
