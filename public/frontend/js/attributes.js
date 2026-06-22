let attributes = {}; // storage

// ================= INITIALIZE ON PAGE LOAD =================
document.addEventListener('DOMContentLoaded', function() {
    // قراءة البيانات الموجودة من الـ table
    const rows = document.querySelectorAll('#attributesTableBody tr[data-attribute-id]');
    
    rows.forEach(row => {
        const id = row.dataset.attributeId;
        const input = row.querySelector('.attribute-value');
        const value = input?.value?.trim() || '';
        
        if (id && value) {
            attributes[id] = { name: getAttributeName(id), value: value };
        }
    });
    
    // تحديث الـ hidden input
    updateHidden();
});

// ================= OPEN MODAL =================
function openAttributeModal() {
    document.getElementById('attributeModal').classList.remove('hidden');
}

// ================= CLOSE MODAL =================
function closeAttributeModal() {
    document.getElementById('attributeModal').classList.add('hidden');
    document.getElementById('attrError').classList.add('hidden');
    document.getElementById('attributeSelect').value = '';
    document.getElementById('attributeValue').value = '';
}

// ================= ADD ATTRIBUTE =================
function addAttribute() {
    const select = document.getElementById('attributeSelect');
    const valueInput = document.getElementById('attributeValue');
    const error = document.getElementById('attrError');

    const id = select.value;
    const name = select.options[select.selectedIndex]?.text || '';
    const value = valueInput.value.trim();

    // Validation
    if (!id) {
        error.innerText = "⚠️ Select an attribute";
        error.classList.remove('hidden');
        return;
    }

    if (!value) {
        error.innerText = "⚠️ Enter a value";
        error.classList.remove('hidden');
        return;
    }

    if (attributes[id]) {
        error.innerText = "⚠️ Attribute already exists";
        error.classList.remove('hidden');
        return;
    }

    error.classList.add('hidden');

    // Store as object so server receives { name, value }
    attributes[id] = { name: name, value: value };

    // Render & Update
    renderTable();
    updateHidden();
    closeAttributeModal();

    valueInput.value = "";
    select.value = "";
}

// ================= RENDER TABLE =================
function renderTable() {
    const tbody = document.getElementById('attributesTableBody');
    tbody.innerHTML = "";

    if (Object.keys(attributes).length === 0) {
        tbody.innerHTML = `
            <tr id="emptyAttributeRow">
                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <i class="fa-solid fa-inbox text-2xl text-gray-300"></i>
                        <p>No attributes added yet</p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    Object.keys(attributes).forEach(id => {
        const row = document.createElement('tr');
        row.className = 'border-b border-[#e5d3c5] hover:bg-[#faf8f6] transition';
        row.id = `attr-row-${id}`;

        row.innerHTML = `
            <td class="px-6 py-4 text-sm text-gray-700">
                <span class="font-semibold attr-name">${getAttributeName(id)}</span>
            </td>
            <td class="px-6 py-4 text-sm">
                <input type="text"
                    class="attribute-value px-3 py-2 border border-[#e5d3c5] rounded-md focus:ring-2 focus:ring-[#c8a98d] outline-none w-full"
                    value="${escapeHtml(attributes[id].value)}"
                        onchange="updateAttr(${id}, this.value)">
            </td>
            <td class="px-6 py-4 text-center">
                <button type="button" onclick="deleteAttr(${id})" class="text-red-600 hover:text-red-800 transition font-semibold text-sm">
                    <i class="fa-solid fa-trash"></i> Remove
                </button>
            </td>
        `;

        tbody.appendChild(row);
    });
}

// ================= GET ATTRIBUTE NAME =================
function getAttributeName(id) {
    const option = document.querySelector(`#attributeSelect option[value="${id}"]`);
    return option ? option.text : 'Unknown';
}

// ================= UPDATE ATTRIBUTE =================
function updateAttr(id, value) {
    const val = value.trim();
    if (attributes[id]) {
        attributes[id].value = val;
    } else {
        attributes[id] = { name: getAttributeName(id), value: val };
    }
    updateHidden();
}

// ================= DELETE ATTRIBUTE =================
function deleteAttr(id) {
    delete attributes[id];
    renderTable();
    updateHidden();
}

// ================= UPDATE HIDDEN INPUT =================
function updateHidden() {
    document.getElementById('productAttributes').value = JSON.stringify(attributes);
}

// ================= ESCAPE HTML (XSS PROTECTION) =================
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ================= CLOSE MODAL ON OUTSIDE CLICK =================
document.addEventListener('click', function(event) {
    const modal = document.getElementById('attributeModal');
    const modalContent = modal?.querySelector('.bg-white');
    if (event.target === modal && modalContent) {
        closeAttributeModal();
    }
});