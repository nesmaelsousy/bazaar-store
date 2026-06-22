{{-- ================= ATTRIBUTES SECTION ================= --}}
<div id="customFields" class="hidden ">
    <div class="space-y-6 mt-10">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-bold uppercase text-[#835837] tracking-wider border-b pb-2 flex-1">
                Product Attributes
            </h3>
            <button type="button" onclick="openAttributeModal()"
                class="px-4 py-2 bg-[#a05a1c] text-white rounded-md hover:bg-[#835837] transition text-sm font-semibold flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Add Attribute
            </button>
        </div>

        {{-- Attributes Table --}}
        <div class="overflow-x-auto bg-white rounded-lg border border-[#e5d3c5]">
            <table class="w-full">
                <thead>
                    <tr class="bg-[#f8f4f0] border-b border-[#e5d3c5]">
                        <th class="px-6 py-3 text-left text-sm font-semibold text-[#835837]">Attribute Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-[#835837]">Value</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-[#835837]">Actions</th>
                    </tr>
                </thead>

                <tbody id="attributesTableBody">
                    @forelse($product->attributes ?? [] as $attribute)
                        <tr class="border-b border-[#e5d3c5] hover:bg-[#faf8f6] transition"
                            id="attr-row-{{ $attribute->id }}" data-attribute-id="{{ $attribute->id }}">
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <span class="font-semibold attr-name">{{ $attribute->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @php
                                    $pivotValue = json_decode($attribute->pivot->value, true);
                                @endphp
                                <input type="text"
                                    class="attribute-value px-3 py-2 border border-[#e5d3c5] rounded-md focus:ring-2 focus:ring-[#c8a98d] outline-none w-full"
                                    value="{{ $pivotValue['value'] ?? '' }}"
                                    data-attribute-id="{{ $attribute->id }}" placeholder="Enter value"
                                    onchange="updateAttribute({{ $attribute->id }}, this.value)">
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button type="button" onclick="removeAttribute({{ $attribute->id }})"
                                    class="text-red-600 hover:text-red-800 transition font-semibold text-sm">
                                    <i class="fa-solid fa-trash"></i> Remove
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyAttributeRow">
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fa-solid fa-inbox text-2xl text-gray-300"></i>
                                    <p>No attributes added yet</p>
                                    <p class="text-xs text-gray-400">Add your first attribute to get started</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Hidden input for storing attribute data --}}
        <input type="hidden" id="productAttributes" name="product_attributes">
    </div>
    <div class="mt-4">
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="allow_engraving" value="1" @checked(old('allow_engraving', $product->allow_engraving ?? 0)) class="w-5 h-5">

            <span class="text-[#835837] font-medium">
                Allow engraving on this product
            </span>
        </label>
    </div>

    {{-- MODAL: Add Attribute --}}
    <div id="attributeModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6 space-y-4">
            <div class="flex justify-between items-center">
                <h4 class="text-lg font-bold text-[#835837]">Add Attribute</h4>
                <button type="button" onclick="closeAttributeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="space-y-4">
                {{-- Select Attribute --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Enter Attribute</label>

                    <select id="attributeSelect" name="name"
                        class="w-full px-3 py-2 border border-[#e5d3c5] rounded-md focus:ring-2 focus:ring-[#c8a98d] outline-none">
                        <option value="">Choose an attribute...</option>
                        @foreach ($attributes ?? [] as $attr)
                            <option value="{{ $attr->id }}" data-description="{{ $attr->description }}">
                                {{ $attr->name }}
                            </option>
                        @endforeach
                    </select>
                    <p id="attrDesc" class="text-xs text-gray-500 mt-2"></p>
                </div>

                {{-- Attribute Value --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Value</label>
                    <input type="text" id="attributeValue" placeholder="e.g., Red, Large, Cotton"
                        class="w-full px-3 py-2 border border-[#e5d3c5] rounded-md focus:ring-2 focus:ring-[#c8a98d] outline-none">
                </div>

                {{-- Error Message --}}
                <p id="attrError" class="text-sm text-red-600 hidden"></p>
            </div>

            <div class="flex gap-3 pt-4 border-t border-[#e5d3c5]">
                <button type="button" onclick="closeAttributeModal()"
                    class="flex-1 px-4 py-2 border border-[#e5d3c5] text-[#835837] rounded-md hover:bg-[#f8f4f0] transition font-semibold">
                    Cancel
                </button>
                <button type="button" onclick="addAttribute()"
                    class="flex-1 px-4 py-2 bg-[#a05a1c] text-white rounded-md hover:bg-[#835837] transition font-semibold">
                    Add Attribute
                </button>
            </div>
        </div>
    </div>
</div>



<style>
    #attributeModal {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
