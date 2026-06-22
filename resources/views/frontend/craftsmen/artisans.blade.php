@extends('master')

@section('content')
    <main class="pt-20">
        <section class="min-h-screen py-14">
            <div class="max-w-7xl mx-auto px-6 text-center">
                @if ($artisans->isNotEmpty())
                    <div class="mb-12">
                        <h2 class="text-3xl text-[#835837] font-bold mb-2">Our Artisans</h2>
                        <p class="text-[#9A7F73] capitalize">
                            Meet the talented artisans who create these unique pieces with their own hands.
                        </p>
                    </div>
                @endif


                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 px-10">
                    @forelse ($artisans as $artisan)
                        <a href="{{ route('frontend.artisan.show', $artisan->id) }}"
                            class="bg-[#EAD8CC] rounded-2xl shadow-md border border-[#e5d3c5] p-4 text-center transition duration-300 cursor-pointer hover:shadow-xl hover:-translate-y-1 hover:scale-[1.02]">

                            <div
                                class=" bg-[#F7EEE9] flex justify-center items-center rounded-full shadow-md border-4 border-[#F4E7DD] overflow-hidden w-24 h-24 mx-auto rounded-full border-4 mb-4 ">

                                @if ($artisan->image)
                                    <img src="{{ asset('storage/' . $artisan->image) }}"
                                        class="w-full h-full object-cover rounded-full" />
                                @else
                                    <i class="fa-solid fa-user text-5xl text-[#9B6B4A]"></i>
                                @endif

                            </div>
                            <div class="bg-white p-4 rounded-xl shadow-sm">

                                <h3 class="text-[#835837] font-bold mb-1">{{ $artisan->name }}</h3>

                                <p class="flex justify-center items-center gap-1 text-sm text-[#835837] mb-2">
                                    <i class="fa-solid fa-location-dot text-[#c8a98d]"></i>
                                    {{ $artisan->address }}
                                </p>

                                <p class="text-xs text-[#9A7F73] mb-5">
                                    {{ $artisan->bio }}
                                </p>

                                <div class="flex justify-between text-sm text-[#835837] font-medium">

                                    <span class="flex items-center gap-1">
                                        <i class="fa-solid fa-star text-yellow-500"></i>
                                        5
                                    </span>

                                    <span>
                                        {{ $artisan->store?->products->count() }} Products
                                    </span>

                                </div>

                            </div>
                        </a>

                    @empty
                        <div class="text-center col-span-4 py-12">
                            <div class="empty-artisans-state inline-block rounded-2xl p-8  max-w-md mx-auto">
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

            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('frontend/js/script.js') }}"></script>
    <script type="module" src="{{ asset('frontend/js/artisans.js') }}"></script>
@endpush
