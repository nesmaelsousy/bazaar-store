@extends('master')
@section('content')
    <main class="pt-20">
        <section class="bg-[#F7EEE9] py-14">
            <div class="max-w-4xl mx-auto px-6">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-[#835837] mb-2">Workshops This Month</h2>
                    <p class="text-[#9A7F73] capitalize">Learn a new skill with the best artisans</p>
                </div>
               <div class="relative bg-white rounded-xl shadow-md overflow-hidden">

    <div id="slider" class="flex items-start transition-transform duration-500">
        @forelse ($workshops as $workshop)
            <div class="min-w-full flex flex-col md:flex-row md:h-[320px]">
                <img src="{{ asset('storage/' . $workshop->image) }}"
                    class="w-full md:w-1/2 h-56 md:h-full object-cover">

                <div class="flex flex-col justify-between md:justify-center h-full p-5">
                    <h3 class="text-xl font-medium text-[#835837] mb-2">
                        {{ $workshop->title }}
                    </h3>

                    <p class="text-[#9A7F73] mb-4">{{ $workshop->description }}</p>
                    <p class="text-sm font-medium mb-1">
                        Date:
                        {{ \Carbon\Carbon::parse($workshop->date)->format('d M Y') }}
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
                </div>
            </div>
        @empty
            <p class="text-[#9A7F73]">No workshops available at the moment.</p>
        @endforelse
    </div>

    <!-- برا السلايدر -->
    <button id="prev"
        class="hidden md:flex absolute left-2 top-1/2 -translate-y-1/2 bg-white text-[#835837] text-xl shadow-xl w-10 h-10 justify-center items-center rounded-full transition hover:bg-[#f3e7df]">
        <i class="fa-solid fa-chevron-left"></i>
    </button>

    <button id="next"
        class="hidden md:flex absolute right-2 top-1/2 -translate-y-1/2 bg-white text-[#835837] text-xl shadow-xl w-10 h-10 justify-center items-center rounded-full transition hover:bg-[#f3e7df]">
        <i class="fa-solid fa-chevron-right"></i>
    </button>

</div>
        </section>
    </main>
@include('frontend.workshop.model')
@endsection
@push('scripts')
    <script type="module" src="{{ asset('frontend/js/script.js') }}"></script>
    <script type="module" src="{{ asset('frontend/js/home-workshops.js') }}"></script>
@endpush
