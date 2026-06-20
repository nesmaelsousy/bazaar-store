<section id="productsSection" class="dashboard-section">

    <div class="flex justify-between items-center mb-4 flex-wrap gap-3">
        <h2 class="text-2xl text-[#835837] font-bold">My Products</h2>

        <div class="flex gap-2">
            <input type="text" id="searchProduct" placeholder="Search products..."
                class="px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-[#835837]">

            <a href="{{ route('craftsmen.product.create') }}"
                class="bg-[#835837] text-white px-6 py-3 rounded-xl transition hover:bg-[#9B6B4A] ">
                <i class="fa-solid fa-plus mr-2"></i>Add Product
            </a>
        </div>
    </div>

    <div id="productsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($user->products ?? [] as $product)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition product-card"
                data-product-id="{{ $product->id }}">
                <a href="{{ route('frontend.product.show', $product->id) }}">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('default.png') }}"
                        class="w-full h-48 object-cover">
                </a>

                <div class="p-4">

                    <h3 class="text-lg font-bold text-[#835837]">
                        {{ $product->title }}
                    </h3>

                    <p class="text-[#9B6B4A] text-sm mt-1">
                        {{ $product->description }}
                    </p>

                    <div class="flex justify-between items-center mt-3">

                        <span class="text-[#835837] font-bold text-xl">
                            ${{ $product->price }}
                        </span>

                        <span class="text-sm text-green-600">
                            In Stock: {{ $product->stock_quantity }}
                        </span>

                    </div>

                    <div class="flex gap-2 mt-3">

                        <a href="{{ route('craftsmen.product.edit', $product->id) }}"
                            class="edit-product flex-1 bg-[#F4E7DD] text-[#835837] px-3 py-2 rounded-lg hover:bg-[#E8D5C8] transition text-sm">
                            <i class="fa-solid fa-pen mr-1"></i>Edit
                        </a>
                        <form action="{{ route('craftsmen.product.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="delete-product bg-red-100 text-red-600 px-3 py-2 rounded-lg hover:bg-red-200 transition text-sm">
                                <i class="fa-solid fa-trash mr-1"></i>Delete
                            </button>
                        </form>


                    </div>

                </div>

            </div>



        @empty

            <div class="col-span-full">
                <div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4">

                    <div class="mb-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-40 h-40 text-[#835837] opacity-80"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />

                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6" />
                        </svg>
                    </div>

                    <h2 class="text-3xl md:text-4xl font-bold text-[#835837] mb-3">
                        Your Store is Empty
                    </h2>

                    <p class="text-[#a07359] text-lg max-w-md mx-auto mb-4">
                        Start adding your first product to showcase your store.
                    </p>

                </div>
            </div>
        @endforelse

    </div>


</section>
<style>
    /* تحسينات إضافية */
    #addProductModal {
        backdrop-filter: blur(4px);
    }

    #addProductModal .bg-white {
        animation: modalSlideIn 0.3s ease-out;
        max-height: 90vh;
        overflow-y: auto;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-30px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* تخصيص scrollbar للمودال */
    #addProductModal .bg-white::-webkit-scrollbar {
        width: 6px;
    }

    #addProductModal .bg-white::-webkit-scrollbar-track {
        background: #F4E7DD;
        border-radius: 10px;
    }

    #addProductModal .bg-white::-webkit-scrollbar-thumb {
        background: #9B6B4A;
        border-radius: 10px;
    }

    #addProductModal .bg-white::-webkit-scrollbar-thumb:hover {
        background: #835837;
    }
</style>
