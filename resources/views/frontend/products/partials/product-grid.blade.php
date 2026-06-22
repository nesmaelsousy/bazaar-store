<div class="grid grid-cols-1 product-grid sm:grid-cols-2 md:grid-cols-3 gap-4">
    @forelse($products as $product)
        <div class="product-card product-item relative bg-white p-2 rounded-lg shadow-md hover:shadow-lg transition"
            data-price="{{ $product->price }}" data-category="{{ $product->category_id }}"
            data-seller="{{ $product->seller_id }}" data-city="{{ $product->user->city ?? '' }}"
            data-name="{{ strtolower($product->title) }}" data-id="{{ $product->id }}">

            {{-- Badges --}}
            <div class="absolute top-3 left-3 z-10 flex flex-col gap-1">
                @if ($product->created_at > now()->subDays(7))
                    <span class="bg-[#9B6B4A] text-white text-xs font-bold px-2 py-1 rounded-full">NEW</span>
                @endif

            </div>

            {{-- Favorite Button --}}
            <form action="{{ route('frontend.favorites.toggle', $product->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="favorite-btn absolute top-3 right-3 z-10 w-9 h-9 bg-white rounded-full flex justify-center items-center transition duration-200 hover:scale-105 shadow-md">
                    <i
                        class="fa-regular fa-heart text-[#875E43] 
                        {{ $product->isFavorite() ? 'fa-solid text-red-500' : '' }}">
                    </i>
                </button>
            </form>

            {{-- Product Link --}}
            <a href="{{ route('frontend.product.show', $product->id) }}" class="block relative group">
                <img src="{{ asset('storage/' . $product->image) }}" loading="lazy" alt="{{ $product->name }}"
                    class="w-full h-44 object-cover rounded-lg">

                {{-- Hover overlay with description --}}
                <div
                    class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center p-4">
                    <p class="text-white text-sm text-center line-clamp-4">
                        {{ $product->description ?? 'No description available' }}
                    </p>
                </div>
            </a>

            <div>
                {{-- Product Name --}}
                <h3 class="text-sm font-medium text-gray-800 mt-2 line-clamp-2 min-h-[40px]">
                    {{ $product->title }}
                </h3>

                {{-- Rating --}}
                <div class="flex items-center gap-1 mt-1">
                    <div class="flex text-yellow-400 text-sm">
                        @for ($i = 1; $i <= 5; $i++)
                            <i
                                class="fa-solid fa-star {{ $i <= $product->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                    <span class="text-xs text-gray-500">({{ $product->reviews_count ?? 0 }})</span>
                </div>

                {{-- Price + Stock + Cart --}}
                <div class="flex justify-between items-center mt-2">
                    <div>
                        @if ($product->discount)
                            <p class="text-[#835837] font-semibold">
                                ${{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                <span class="text-xs text-gray-400 line-through ml-1">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </p>
                        @else
                            <p class="text-[#835837] font-semibold">
                                ${{ number_format($product->price, 2) }}
                            </p>
                        @endif

                        @if ($product->stock_quantity > 0)
                            <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full inline-block mt-1">
                                <i class="fa-solid fa-check-circle"></i> In Stock
                            </span>
                        @else
                            <span class="text-xs text-red-600 bg-red-50 px-2 py-0.5 rounded-full inline-block mt-1">
                                <i class="fa-solid fa-times-circle"></i> Out of Stock
                            </span>
                        @endif
                    </div>

                    @if ($product->stock_quantity > 0)
                        <div class="flex items-center gap-2">

                            <a href="{{ route('frontend.product.show', $product->id) }}"
                                class="add-to-cart text-xl text-[#875E43] hover:text-[#E6B693] transition">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
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
