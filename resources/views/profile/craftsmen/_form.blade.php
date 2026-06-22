    <input type="text" name="seller_id" class="hidden" value="{{ auth()->id() }}" id="">
    {{-- ================= PRODUCT INFO ================= --}}
    <div class="space-y-6">
        <h3 class="text-sm font-bold uppercase text-[#835837] tracking-wider border-b pb-2">
            Product Info
        </h3>

        <div class="flex flex-col lg:flex-row gap-6">

            {{-- Image --}}
            <div class="w-full lg:w-1/3">
                <div
                    class="w-full h-64 rounded-xl border-2 border-dashed border-gray-200 overflow-hidden cursor-pointer bg-gray-50 flex items-center justify-center show-img">
                    <img src="{{ optional($product)->image ? Storage::url($product->image) : asset('backend/image/image-placeholder.png') }}"
                        class="w-full h-full object-cover">
                </div>

                <input id="image-input" type="file" name="image" class="hidden" accept="image/*">
            </div>

            {{-- Inputs --}}
            <div class="w-full lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <div class="flex items-center gap-1  mb-3">
                        <span class="text-red-600 ">*</span>
                        <label for="">Product Name</label>
                    </div>
                    <x-form.input name="title" placeholder="e.g.Handcrafted Ceramic Vase" type="text"
                        :oldVal="old('title', $product->title)"
                        class="w-full px-3 py-2 rounded-md outline-none  border border-[#e5d3c5] focus:ring-2 focus:ring-[#c8a98d]" />

                </div>
                <div>
                    <div class="flex items-center gap-1  mb-3">
                        <span class="text-red-600 ">*</span>
                        <label for="">Price Product</label>
                    </div>
                    <x-form.input name="price" type="number" placeholder="e.g. 50$"
                        class="w-full px-3 py-2 rounded-md outline-none border border-[#e5d3c5] focus:ring-2 focus:ring-[#c8a98d]"
                        :oldVal="old('price', $product->price)" />


                </div>

                <div>
                    <div class="flex items-center gap-1 mb-3">
                        <span class="text-red-600 ">*</span>
                        <label for="">Category</label>
                    </div>
                    <x-form.select :options="$categories" name="category_id"
                        class="w-full block  px-3 py-2 rounded-md outline-none border border-[#e5d3c5] focus:ring-2 focus:ring-[#c8a98d]"
                        firstOne="Select the product category." :oldVal="$product->category_id" />
                    <p class="text-xs text-gray-500 mt-1">
                        Choose the category that best fits your product.

                    </p>
                </div>

                <div>
                    <div class="flex items-center gap-1 mb-3">
                        <span class="text-red-600 ">*</span>
                        <label for="">Stock Quantity</label>
                    </div>
                    <x-form.input name="stock_quantity" type="number" placeholder=" e.g.150"
                        class="w-full px-3 py-2 rounded-md outline-none border  border-[#e5d3c5] focus:ring-2 focus:ring-[#c8a98d]"
                        :oldVal="old('stock_quantity', $product->stock_quantity)" />
                </div>


                <div class="md:col-span-2">
                    <div class="flex items-center gap-1 mb-3">
                        <span class="text-red-600 ">*</span>
                        <label for="">Description</label>
                    </div>
                    <x-form.textarea name="description"
                        class="w-full px-3 py-2 rounded-md outline-none border border-[#e5d3c5] focus:ring-2 focus:ring-[#c8a98d]"
                        :oldVal="$product->description" />
                    <p class="text-xs text-gray-500 mt-1"> Provide a clear description of the product,
                        including its materials, features, and any customization options available.
                    </p>
                </div>
                {{-- Other Images --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2">Images</label>
                    <input type="file" id="imagesInput" name="images[]" multiple accept="image/*"
                        class="w-full px-3 py-2 rounded-md outline-none border border-[#e5d3c5] focus:ring-2 focus:ring-[#c8a98d] cursor-pointer">
                    <p class="text-xs text-gray-500 mt-1">choose other image</p>

                    {{-- Preview --}}
                    <div id="previewContainer" class="flex gap-2">

                    </div>

                    @if ($product?->images)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">

                            @forelse($product->images as $image)
                                <div class="relative w-200 h-200 group" id="imageBox">
                                    <img src="{{ Storage::url($image) }}"
                                        class="w-200 h-200 rounded border object-cover">

                                    <button type="button" onclick="removeImage(this, '{{ $image }}')"
                                        class="absolute top-1 right-1 bg-red-300 text-white rounded-full w-7 h-7 opacity-0 group-hover:opacity-100 hover:bg-red-600 transition">
                                        <i class="fa-solid fa-xmark text-xs"></i>
                                    </button>
                                </div>
                            @empty
                                <p class="text-gray-500">No additional images</p>
                            @endforelse
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

    {{-- ================= STATUS ================= --}}

    <div class="space-y-6 mt-10">

        <h3 class="text-sm font-bold uppercase text-[#835837] tracking-wider border-b pb-2">
            Status & Settings
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Status --}}
            <div>
                <label class="text-sm font-semibold mb-2 block">Product Status</label>

                <input type="hidden" name="status" id="statusVal"
                    value="{{ old('status', $product->status ?? 'active') }}">
                <div class="toggle-group">
                    <div class="toggle-btn {{ old('status', $product->status ?? 'active') == 'active' ? 'active-green' : '' }}"
                        onclick="pick(this,'status','active')">Active</div>

                    <div class="toggle-btn {{ old('status', $product->status ?? 'active') == 'archived' ? 'active-green' : '' }}"
                        onclick="pick(this,'status','archived')">Archived</div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Default: Active</p>
            </div>

            {{-- Customizable --}}
            <div>
                <label class="text-sm font-semibold mb-2 block">Customizable</label>

                <input type="hidden" name="is_customizable" id="is_customizableVal"
                    value="{{ old('is_customizable', (int) $product->is_customizable ?? 0) }}">
                <div class="toggle-group">
                    {{-- YES --}}
                    <div class="toggle-btn 
        {{ old('is_customizable', (int) ($product->is_customizable ?? 0)) == 1 ? 'active-green' : '' }}"
                        onclick="pick(this,'is_customizable',1)">
                        Enabled
                    </div>
                    {{-- NO --}}
                    <div class="toggle-btn 
                                        {{ old('is_customizable', (int) ($product->is_customizable ?? 0)) == 0 ? 'active-danger' : '' }}"
                        onclick="pick(this,'is_customizable',0)">
                        Disabled
                    </div>
                </div>
            </div>

        </div>
        @include('profile.craftsmen.attributes')

