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
                            id="attr-row-{{ $attribute->id }}">
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <span class="font-semibold">{{ $attribute->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <input type="text"
                                    class="attribute-value px-3 py-2 border border-[#e5d3c5] rounded-md focus:ring-2 focus:ring-[#c8a98d] outline-none w-full"
                                    value="{{ $attribute->pivot->value ?? '' }}"
                                    data-attribute-id="{{ $attribute->id }}" placeholder="Enter value">
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
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
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


<script>
  let productAttributes = {};

// تهيئة الخصائص من البيانات الموجودة (للتعديل)
function initializeAttributes() {
    const existingRows = document.querySelectorAll('#attributesTableBody tr:not(#emptyAttributeRow)');
    existingRows.forEach(row => {
        const id = row.dataset.attributeId;
        const name = row.querySelector('.attr-name')?.textContent;
        const value = row.querySelector('.attr-value-input')?.value;
        
        if (id && name && value) {
            productAttributes[id] = { name, value };
        }
    });
    
    // تحديث hidden input
    document.getElementById('productAttributes').value = JSON.stringify(productAttributes);
}

function openAttributeModal() {
    document.getElementById('attributeModal').classList.remove('hidden');
    document.getElementById('attrError').classList.add('hidden');
}

function closeAttributeModal() {
    document.getElementById('attributeModal').classList.add('hidden');
    // تنظيف الحقول
    document.getElementById('attributeSelect').value = '';
    document.getElementById('attributeValue').value = '';
    document.getElementById('attrError').classList.add('hidden');
}

function addAttribute() {
    let select = document.getElementById('attributeSelect');
    let valueInput = document.getElementById('attributeValue');
    let errorEl = document.getElementById('attrError');

    let id = select.value;
    let name = select.options[select.selectedIndex]?.text || '';
    let value = valueInput.value.trim();

    // التحقق من صحة البيانات
    if (!id) {
        errorEl.textContent = '⚠️ Please select an attribute';
        errorEl.classList.remove('hidden');
        return;
    }

    if (!value) {
        errorEl.textContent = '⚠️ Please enter a value';
        errorEl.classList.remove('hidden');
        return;
    }

    // التحقق من عدم التكرار
    if (productAttributes[id]) {
        errorEl.textContent = '⚠️ This attribute is already added';
        errorEl.classList.remove('hidden');
        return;
    }

    // إخفاء الخطأ
    errorEl.classList.add('hidden');

    // تخزين في الـ state
    productAttributes[id] = {
        name: name,
        value: value
    };

    // تحديث hidden input
    document.getElementById('productAttributes').value = JSON.stringify(productAttributes);

    // إضافة للجدول
    addRowToTable(id, name, value);

    // تنظيف الحقول وإغلاق المودال
    valueInput.value = '';
    select.value = '';
    closeAttributeModal();
}

function addRowToTable(id, name, value) {
    let tbody = document.getElementById('attributesTableBody');

    // حذف رسالة "لا يوجد بيانات"
    let empty = document.getElementById('emptyAttributeRow');
    if (empty) empty.remove();

    // التحقق من عدم وجود الصف مسبقاً
    let existingRow = document.getElementById(`attr-row-${id}`);
    if (existingRow) {
        // تحديث القيمة بدلاً من إضافة صف جديد
        existingRow.querySelector('.attr-value-display').textContent = value;
        return;
    }

    let row = document.createElement('tr');
    row.id = `attr-row-${id}`;
    row.className = 'border-b border-[#e5d3c5] hover:bg-[#faf8f6] transition';
    row.dataset.attributeId = id;

    row.innerHTML = `
        <td class="px-6 py-4 text-sm text-gray-700">
            <span class="font-semibold attr-name">${escapeHtml(name)}</span>
        </td>
        <td class="px-6 py-4 text-sm">
            <span class="attr-value-display">${escapeHtml(value)}</span>
            <input type="hidden" class="attr-value-input" value="${escapeHtml(value)}">
        </td>
        <td class="px-6 py-4 text-center">
            <button type="button" onclick="removeAttribute(${id})"
                class="text-red-600 hover:text-red-800 transition font-semibold text-sm">
                <i class="fa-solid fa-trash"></i> Remove
            </button>
        </td>
    `;

    tbody.appendChild(row);
}

function removeAttribute(id) {
    // حذف من الـ state
    delete productAttributes[id];

    // تحديث hidden input
    document.getElementById('productAttributes').value = JSON.stringify(productAttributes);

    // حذف من الجدول
    let row = document.getElementById(`attr-row-${id}`);
    if (row) row.remove();

    // إذا لم يبقى أي صف، أضف رسالة "لا يوجد بيانات"
    let tbody = document.getElementById('attributesTableBody');
    if (tbody.children.length === 0) {
        tbody.innerHTML = `
            <tr id="emptyAttributeRow">
                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <i class="fa-solid fa-inbox text-2xl text-gray-300"></i>
                        <p>No attributes added yet</p>
                        <p class="text-xs text-gray-400">Add your first attribute to get started</p>
                    </div>
                </td>
            </tr>
        `;
    }
}

// دالة مساعدة لتجنب XSS
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// تهيئة عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    // إذا كانت هناك خصائص موجودة (في حالة التعديل)
    const existingAttributes = document.querySelectorAll('#attributesTableBody tr:not(#emptyAttributeRow)');
    if (existingAttributes.length > 0) {
        existingAttributes.forEach(row => {
            const id = row.dataset.attributeId;
            const name = row.querySelector('.attr-name')?.textContent;
            const value = row.querySelector('.attr-value-input')?.value;
            
            if (id && name && value) {
                productAttributes[id] = { name, value };
            }
        });
        
        // تحديث hidden input
        document.getElementById('productAttributes').value = JSON.stringify(productAttributes);
    }
});

// إغلاق المودال عند الضغط خارجها
document.addEventListener('click', function(event) {
    const modal = document.getElementById('attributeModal');
    const modalContent = modal?.querySelector('.bg-white');
    if (event.target === modal && modalContent) {
        closeAttributeModal();
    }
});
</script>
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
