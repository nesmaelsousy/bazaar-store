@extends('master')
@section('content')
    <main class="pt-20">
        <section class="min-h-screen bg-[#F7EEE9] py-14">
            <div class="max-w-4xl mx-auto px-6">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-[#835837] mb-2">Workshops This Month</h2>
                    <p class="text-[#9A7F73] capitalize">Learn a new skill with the best artisans</p>
                </div>

                @if($workshops->count() > 0)
                    {{-- Workshops Slider --}}
                    <div class="relative bg-white rounded-xl shadow-md overflow-hidden">
                        <div id="slider" class="flex items-start transition-transform duration-500">
                            @foreach ($workshops as $workshop)
                                <div class="min-w-full flex flex-col md:flex-row md:h-[320px]">
                                    <img src="{{ asset('storage/' . $workshop->image) }}"
                                        class="w-full md:w-1/2 h-56 md:h-full object-cover"
                                        alt="{{ $workshop->title }}">

                                    <div class="flex flex-col justify-between md:justify-center h-full p-5">
                                        <h3 class="text-xl font-medium text-[#835837] mb-2">
                                            {{ $workshop->title }}
                                        </h3>

                                        <p class="text-[#9A7F73] text-sm mb-4 line-clamp-2">
                                            {{ $workshop->description }}
                                        </p>

                                        <div class="space-y-1 text-sm">
                                            <p class="font-medium">
                                                <i class="fa-regular fa-calendar text-[#835837] w-5"></i>
                                                Date: {{ \Carbon\Carbon::parse($workshop->date)->format('d M Y') }}
                                            </p>
                                            <p class="font-medium">
                                                <i class="fa-regular fa-clock text-[#835837] w-5"></i>
                                                Duration: {{ $workshop->duration }} Hours
                                            </p>
                                            <p class="font-medium">
                                                <i class="fa-solid fa-tag text-[#835837] w-5"></i>
                                                Price: ${{ $workshop->price }}
                                            </p>
                                            <p class="font-medium">
                                                <i class="fa-regular fa-user text-[#835837] w-5"></i>
                                                Available Slots: 
                                                <span class="{{ $workshop->availableSlots < 5 ? 'text-red-500 font-bold' : 'text-green-600' }}">
                                                    {{ $workshop->availableSlots }}
                                                </span>
                                                @if($workshop->availableSlots < 5 && $workshop->availableSlots > 0)
                                                    <span class="text-xs text-red-500 ml-1">(Hurry up!)</span>
                                                @endif
                                            </p>
                                        </div>

                                        <button type="button"
                                            class="openContact inline-block bg-[#a05a1c] text-white text-center py-2 px-6 mt-4 rounded-lg hover:bg-[#6b3a12] transition duration-300 w-full md:w-auto">
                                            <i class="fa-regular fa-envelope mr-2"></i>
                                            Contact Us Now
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Slider Navigation Buttons --}}
                        <button id="prev"
                            class="hidden md:flex absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 text-[#835837] text-xl shadow-lg w-10 h-10 justify-center items-center rounded-full transition hover:bg-white hover:scale-110">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>

                        <button id="next"
                            class="hidden md:flex absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 text-[#835837] text-xl shadow-lg w-10 h-10 justify-center items-center rounded-full transition hover:bg-white hover:scale-110">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>

                        {{-- Slider Dots Indicator --}}
                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2">
                            @foreach($workshops as $index => $workshop)
                                <button class="slider-dot w-2 h-2 rounded-full transition-all duration-300 
                                    {{ $index === 0 ? 'bg-[#835837] w-6' : 'bg-gray-300 hover:bg-gray-400' }}"
                                    data-index="{{ $index }}">
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Workshop Counter --}}
                    <p class="text-center text-sm text-[#9A7F73] mt-4">
                        Showing {{ $workshops->count() }} workshop{{ $workshops->count() != 1 ? 's' : '' }}
                    </p>

                @else
                    {{-- Empty State - No Workshops --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden py-16 px-6">
                        <div class="text-center max-w-md mx-auto">
                            {{-- Icon --}}
                            <div class="w-24 h-24 bg-[#F7EEE9] rounded-full flex items-center justify-center mx-auto mb-6">
                              <i class="fa-solid fa-calendar-plus text-5xl text-[#c8a98d]"></i>
                            </div>

                            {{-- Title --}}
                            <h3 class="text-2xl font-bold text-[#835837] mb-3">
                                No Workshops Available
                            </h3>

                            {{-- Description --}}
                            <p class="text-[#9A7F73] text-base leading-relaxed mb-6">
                                We don't have any workshops scheduled at the moment. 
                                <br class="hidden sm:block">
                                Please check back later for new and exciting opportunities!
                            </p>

                            {{-- Decorative Line --}}
                            <div class="w-20 h-1 bg-[#c8a98d] mx-auto rounded-full mb-6"></div>

                            {{-- Action Buttons --}}
                            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                <a href="{{ route('frontend.products.show') }}"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-[#835837] text-white rounded-lg hover:bg-[#6b4529] transition duration-300">
                                    <i class="fa-solid fa-store"></i>
                                    Browse Products
                                </a>
                                <a href="{{ route('frontend.categories.index') }}"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-2.5 border-2 border-[#835837] text-[#835837] rounded-lg hover:bg-[#835837] hover:text-white transition duration-300">
                                    <i class="fa-regular fa-compass"></i>
                                    Explore Categories
                                </a>
                            </div>

                            {{-- Additional Info --}}
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <p class="text-sm text-[#9A7F73]">
                                    <i class="fa-regular fa-bell mr-2"></i>
                                    Want to be notified about new workshops?
                                    <button type="button" class="text-[#835837] font-medium hover:underline">
                                        Subscribe to our newsletter
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('frontend.workshop.model')
@endsection

@push('scripts')
    <script type="module" src="{{ asset('frontend/js/script.js') }}"></script>
    <script type="module" src="{{ asset('frontend/js/home-workshops.js') }}"></script>
@endpush