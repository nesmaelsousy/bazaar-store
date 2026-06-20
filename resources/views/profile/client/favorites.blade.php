<!-- Favorites -->
<div class="bg-white rounded-2xl shadow-lg border border-[#F4E7DD] overflow-hidden">
    <div class="bg-[#835837] px-6 py-4">
        <div class="flex justify-between items-center">
            <h2 class="text-white font-medium tracking-wide text-sm">
                <i class="fa-regular fa-heart mr-2"></i>SAVED ITEMS
            </h2>
            <a href="{{ route('frontend.favorites.index') }}"
                class="text-[#F4E7DD] hover:text-white text-sm transition">View All
                →</a>
        </div>
    </div>
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
        @forelse (auth()->user()->favorites as $favorite)
            <div class="border border-[#F4E7DD] rounded-xl p-3 flex items-center gap-3 bg-[#F9F5F1]">
                <div class="w-12 h-12 bg-[#F4E7DD] rounded-lg flex items-center justify-center">
                   <img src="{{ asset('storage/' . $favorite->product->image) }}" alt="{{ $favorite->product->title }}" class="w-10 h-10 object-cover rounded-lg">
                </div>

                <div>
                    <p class="text-[#835837] font-semibold text-sm">
                        {{ $favorite->product->title }}
                    </p>
                    <p class="text-[#9B6B4A] text-xs">
                        ${{ number_format($favorite->product->price, 2) }}
                    </p>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500">No favorites yet</p>
        @endforelse
      
    </div>
</div>
