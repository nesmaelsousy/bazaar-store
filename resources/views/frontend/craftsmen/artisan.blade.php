@extends('master')
@section('content')
    <main class="min-h-screen pt-28 pb-10 px-6">
        <div id="artisanContainer" class="max-w-6xl mx-auto">
            <!-- Artisan Info -->
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
    <div class="flex flex-col md:flex-row items-center gap-6 justify-between">

        <!-- Left: Image + Info -->
        <div class="flex flex-col md:flex-row items-center gap-6 flex-1">

            <div class="w-28 h-28 bg-[#F7EEE9] flex justify-center items-center rounded-full shadow-md border-4 border-[#F4E7DD] overflow-hidden">

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
                    {{ $artisan->address }}
                </p>

                <div class="flex items-center justify-center md:justify-start gap-1 mb-2">
                    ⭐⭐⭐⭐⭐
                    <span class="text-[#835837] font-semibold ml-1">4.5</span>
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
</div>

            <!-- Products -->
            @forelse ($artisan->products as $prod)
                <div class="mb-10">
                    <h2 class="text-xl font-bold text-[#835837] mb-4">Products</h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">

                        <!-- Product Card -->
                        <a href="{{ route('frontend.product.show',$prod->id) }}" class="bg-white rounded-xl shadow hover:shadow-lg transition p-2">
                            {{-- {{ dd($prod->image)  }} --}}
                            <img src="{{ asset('storage/' . $prod->image) }}"
                                class="w-full h-32 object-cover rounded-lg mb-2" />
                            <p class="text-sm text-[#835837] font-semibold truncate">{{ $prod->title }}</p>
                            <p class="text-sm text-[#a05a1c] font-bold">${{ $prod->price }}</p>
                        </a>

                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center min-h-[500px] gap-4 text-center px-4">
                    <i class="fa-solid fa-inbox text-6xl text-[#c2aa94]"></i>

                    <p class="text-2xl font-semibold text-[#ba9370]">
                        No attributes added yet
                    </p>

                    <p class="text-base text-[#a05a1c] max-w-md">
                        Add your first attribute to get started
                    </p>

                </div>
            @endforelse


            <!-- Reviews -->
           {{-- @if --}}

                <div>
                    <h2 class="text-xl font-bold text-[#835837] mb-4">Customer Reviews</h2>

                    <div class="bg-white rounded-xl shadow p-4 mb-3">
                        <div class="flex justify-between mb-2">
                            <h3 class="text-[#835837] font-semibold">User Name</h3>
                            <span class="text-sm text-[#9B6B4A]">Date</span>
                        </div>

                        <div class="flex mb-2">
                            ⭐⭐⭐⭐⭐
                        </div>

                        <p class="text-[#9B6B4A] text-sm">
                       
                        </p>
                    </div>

                    <p class="text-[#9B6B4A]">No Reviews Yet</p>

                </div>
          



        </div>
    </main>
@endsection
@push('scripts')
    <script type="module" src="{{ asset('frontend/js/script.js') }}"></script>
    <script type="module" src="{{ asset('frontend/js/artisan-details.js') }}"></script>
@endpush
