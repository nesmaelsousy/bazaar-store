@extends('master')
@section('content')
    <main class="max-w-6xl mx-auto pt-28 px-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-16">
            <!-- IMAGE -->
            <div>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <img id="mainImage" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                        class="w-full h-[380px] object-cover transition duration-500 cursor-zoom-in">
                </div>
                @if ($product?->images)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">
                        @foreach ($product->images as $image)
                            <div class="w-200  group" id="imageBox">
                                <img src="{{ Storage::url($image) }}" data-src="{{ Storage::url($image) }}"
                                    class="thumbnail w-full  h-32 md:h-40 rounded border object-cover cursor-pointer hover:opacity-80 transition">
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            <!-- DETAILS -->
            <div class="bg-white rounded-2xl shadow-2xl p-6">

                <h1 class="text-2xl text-[#835837] font-bold mb-3">
                    {{ $product->title }}
                </h1>

                <!-- RATING -->


                <div class="flex text-yellow-400  text-xl">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $product->rating)
                            <i class="fa fa-star"></i>
                        @else
                            <i class="fa-regular fa-star"></i>
                        @endif
                    @endfor
                </div>
                <div class="flex items-center gap-1 mb-4">

                    <span class="text-md text-[#835837] font-semibold">rating: {{ round($product->rating, 1) }}</span>
                </div>

                <p class="text-[#9B6B4A] leading-relaxed mb-4">
                    {{ $product->description }}
                </p>

                <p class="text-xl text-[#835837] font-bold mb-4">
                    ${{ number_format($product->price, 2) }}
                </p>

                <!-- OPTIONS -->
                <form action="{{ route('frontend.cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    @if ($product->is_customizable === 1)
                        <div class="bg-[#F4E7DD] rounded-xl p-4 mb-6">
                            <h3 class="text-lg text-[#835837] font-bold mb-4">
                                Customization Options
                            </h3>
                            @foreach ($product->attributes ?? [] as $attr)
                                <!-- COLOR -->
                                <div class="mb-4">
                                    <label class="block text-md text-[#9B6B4A] font-semibold mb-1">
                                        {{ $attr->name }} :
                                    </label>

                                    <select class="w-full p-2 bg-white border rounded-lg"
                                        name="attributes[{{ $attr->id }}]">
                                        @php
                                            $data = json_decode($attr->pivot->value, true);
                                            $values = explode(',', $data['value']);
                                        @endphp

                                        @foreach ($values as $val)
                                            <option value="{{ trim($val) }}"
                                                {{ old('attribute' . $attr->id) == trim($val) ? 'selected' : '' }}>
                                                {{ trim($val) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach

                            @if ($product->allow_engraving === 1)
                                <!-- ENGRAVING -->
                                <div>
                                    <label class="block text-md text-[#9B6B4A] font-semibold mb-1">
                                        Engraving :
                                    </label>
                                    <textarea name="engraving" id="" rows="5" class="w-full p-2 border rounded-lg">{{ old('engraving', $cart->engraving ?? '') }}</textarea>

                                </div>
                            @endif


                        </div>
                    @endif


                    <!-- QUANTITY -->
                    <div class="mb-6">
                        <x-input-label class="block text-md text-[#9B6B4A] font-bold mb-2">
                            Quantity :
                        </x-input-label>
                        <input type="number" name="quantity" value="1" min="1"
                            class="w-24 p-2 border rounded-lg" />


                    </div>

                    <!-- BUTTONS -->
                    <div class="flex items-center gap-3">

                        <button type="submit" class="flex-1 bg-[#875E43] text-white py-2 rounded-lg">
                            <i class="fa-solid fa-cart-shopping"></i> Add To Cart
                        </button>

                        <div class=" border  border-[#875E43]  rounded-lg">
                            <i
                                class="fa-regular fa-heart text-center p-3 text-[#875E43] 
                                {{ $product->isFavorite() ? 'fa-solid text-red-500' : '' }}"></i>
                        </div>

                    </div>

                    <div class="flex items-center gap-1 text-sm text-[#9B6B4A] mt-3">
                        <i class="fa-solid fa-map-pin"></i> Made In {{ $product->seller->address }}
                    </div>

            </div>
            </form>

        </div>

        <!-- ARTISAN -->
        <div class="bg-white rounded-2xl shadow-xl mb-10 p-4">

            <h2 class="text-xl text-[#835837] font-bold mb-3">
                About The Artisan
            </h2>

            <div class="flex gap-3">

                <div
                    class="w-28 h-28 bg-[#F7EEE9] flex justify-center items-center rounded-full shadow-md border-4 border-[#F4E7DD] overflow-hidden">
                    @if ($product->seller->image)
                        <img src="{{ asset('storage' . $product->seller->image) }}"
                            class="w-32 h-32 object-cover rounded-full border-4 border-[#F7EEE9]" />
                    @else
                        <i class="fa-solid fa-user text-5xl text-[#9B6B4A]"></i>
                    @endif
                </div>

                <div>
                    <h3 class="text-lg text-[#9B6B4A] font-bold">
                        {{ $product->seller->name }}
                    </h3>

                    <p class="text-sm text-[#9B6B4A] mt-2">
                        {{ $product->seller->bio }}
                    </p>
                </div>

            </div>
        </div>

        <!-- REVIEWS -->

        <div class="bg-white rounded-2xl shadow-xl p-4 mb-6">
            @auth
                <div class="bg-[#F7EEE9] rounded-2xl p-6 mb-6 shadow-md">

                    <h3 class="text-lg font-bold text-[#835837] mb-4">
                        Add Your Review
                    </h3>

                    <form method="POST" action="{{ route('frontend.product.review', $product->id) }}" class="space-y-4">
                        @csrf

                        <!-- STARS -->
                        <div class="flex flex-row-reverse justify-end text-xl gap-1">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}"
                                    class="hidden peer">

                                <label for="star{{ $i }}"
                                    class="cursor-pointer text-gray-500 hover:text-yellow-400 peer-checked:text-yellow-400 transition">
                                    <i class="fa fa-star"></i>
                                </label>
                            @endfor
                        </div>

                        <!-- COMMENT -->
                        <textarea name="comment" placeholder="Write your experience..."
                            class="w-full p-3 border border-[#D9BBA0] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#835837] bg-white text-[#835837] resize-none"
                            rows="4"></textarea>

                        <!-- BUTTON -->
                        <button type="submit"
                            class="bg-[#835837] hover:bg-[#6f472f] text-white px-6 py-2 rounded-xl transition shadow-md">
                            Submit Review
                        </button>

                    </form>
                </div>
            @endauth
            <h2 class="text-xl text-[#835837] font-bold mb-5">
                Customer Reviews
            </h2>
            @foreach ($product->reviews as $rev)
                <div class="bg-[#fbfbfb] rounded-xl p-4 mb-4 shadow-sm">

                    <div class="flex justify-between items-start">

                        <!-- USER INFO -->
                        <div class="flex items-center gap-3">

                            <!-- AVATAR -->
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-[#D9BBA0]">

                                @if ($rev->user->image)
                                    <img src="{{ asset('storage/' . $rev->user->image) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('backend/image/avatar.jpg') }}" class="w-full h-full object-cover">
                                @endif

                            </div>

                            <!-- NAME + STARS -->
                            <div>

                                <h3 class="font-semibold text-[#835837]">
                                    {{ $rev->user->name }}
                                </h3>

                                <div class="text-yellow-500 text-sm flex gap-[2px] mt-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rev->rating)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa-regular fa-star"></i>
                                        @endif
                                    @endfor
                                </div>

                            </div>
                        </div>

                        <!-- DATE -->
                        <span class="text-xs text-[#9B6B4A]">
                            {{ $rev->created_at->format('d M Y') }}
                        </span>

                    </div>

                    <!-- COMMENT -->
                    <p class="text-[#9B6B4A] mt-3 ml-14 leading-relaxed">
                        {{ $rev->comment }}
                    </p>

                </div>
            @endforeach


        </div>

    </main>
@endsection
@push('scripts')
    <script src="{{ asset('frontend/js/product-details.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const mainImage = document.getElementById("mainImage");
            const thumbnailsContainer = mainImage.parentElement.nextElementSibling;

            document.querySelectorAll(".thumbnail").forEach(img => {

                img.addEventListener("click", function() {

                    let clickedSrc = this.src;
                    let mainSrc = mainImage.src;

                    // تبديل الصور
                    mainImage.src = clickedSrc;
                    this.src = mainSrc;

                });

            });

        });
    </script>
@endpush
