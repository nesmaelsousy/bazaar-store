@extends('master')

@section('content')

    <main class="min-h-screen bg-[#F7EEE9] pt-28 px-6">
        <div class="max-w-4xl mx-auto">

            @if ($favorites->count() == 0)
                <div class="max-w-4xl mx-auto">
                    <div id="favoritesHeader" class="mt-20 mb-8 text-center">
                        <i class="fa-solid fa-heart text-6xl text-[#835837] mb-3 opacity-60"></i>
                        <p class="text-xl text-[#835837] font-bold mb-2">No Favorite Products Yet</p>
                        <p class="text-sm text-[#9A7F73] mb-8">Start Saving Products You Love</p>
                        <a href="{{ route('frontend.categories.index') }}"
                            class="bg-[#835837] text-white px-6 py-2 rounded-lg transition hover:bg-[#a05a1c]">Browse
                            Products</a>
                    </div>
                    <div id="favoritesContainer" class="flex flex-col gap-4"></div>
                </div>
            @else
                <div class="flex flex-col gap-4 mt-10">

                    @foreach ($favorites as $favorite)
                        <div class="flex justify-between items-center bg-white rounded-xl shadow-md px-3 py-2">

                            <a href="{{ route('frontend.product.show', $favorite->product->id) }}"
                                class="flex flex-1 items-center gap-3">

                                <img src="{{ asset('storage/' . $favorite->product->image) }}"
                                    class="w-24 h-24 object-cover rounded-lg">

                                <div>
                                    <h3 class="text-xl font-bold">
                                        {{ $favorite->product->title }}
                                    </h3>

                                    <p class="text-[#9B6B4A] font-semibold">
                                        ${{ $favorite->product->price }}
                                    </p>
                                </div>

                            </a>

                            <form method="POST" action="{{ route('frontend.favorites.toggle', $favorite->product->id) }}">
                                @csrf
                                <button class="text-red-500 text-xl">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    @endforeach

                </div>
            @endif

        </div>
    </main>

@endsection
