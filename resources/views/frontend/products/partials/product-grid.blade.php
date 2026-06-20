<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    @forelse($products as $product)
        <div class="product-card relative bg-white p-2 rounded-lg shadow-md hover:shadow-lg transition"
            data-id="{{ $product->id }}">
            
            {{-- Favorite Button --}}
            <form action="{{ route('frontend.favorites.toggle', $product->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="favorite-btn absolute top-3 right-3 z-10 w-9 h-9 bg-white rounded-full flex justify-center items-center transition duration-200 hover:scale-105">
                    <i class="fa-regular fa-heart text-[#875E43] 
                        {{ $product->isFavorite() ? 'fa-solid text-red-500' : '' }}">
                    </i>
                </button>
            </form>

            {{-- Product Link --}}
            <a href="{{ route('frontend.product.show', $product->id) }}" class="block">
                <img src="{{ asset('storage/' . $product->image) }}" 
                     class="w-full h-44 object-cover rounded-lg">
            </a>

            <div>
                {{-- Price + Cart --}}
                <div class="flex justify-between items-center mt-3">
                    <p class="text-[#835837] font-semibold">
                        ${{ number_format($product->price, 2) }}
                    </p>
                    <form action="{{ route('frontend.cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="add-to-cart text-xl text-[#875E43] hover:text-[#E6B693]">
                            <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        {{-- Empty State - Full width centering --}}
        <div class="col-span-1 sm:col-span-2 md:col-span-3 flex justify-center items-center min-h-[400px]">
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-[#835837] mb-3">
                    No Products Found
                </h2>
                <p class="text-[#a07359] text-lg max-w-md mx-auto">
                    We couldn't find any products matching your criteria.
                </p>
                <div class="mt-8">
                    <a href="{{ route('frontend.categories.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-2 bg-[#835837] text-white rounded-full hover:bg-[#6b4529] transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Go Back
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>