function pick(el, group, value) {
    const parent = el.closest('.toggle-group');
    const customFields = document.getElementById('customFields');

    parent.querySelectorAll('.toggle-btn').forEach(b => {
        b.classList.remove('active-green', 'active-danger', 'active-brown');
    });

    if (group === 'status') {
        el.classList.add(value === 'active' ? 'active-green' : 'active-danger');
        document.getElementById('statusVal').value = value;

    } else if (group === 'is_customizable') {
        el.classList.add(value == 1 ? 'active-green' : 'active-danger');
        document.getElementById('is_customizableVal').value = value;

        // إظهار أو إخفاء الحقول بناءً على القيمة
        if (value == 1) {
            customFields.classList.remove('hidden');
        } else {
            customFields.classList.add('hidden');
        }
    } else {
        el.classList.add('active-brown');
        document.getElementById('roleVal').value = value;
        customFields.classList.remove('hidden');
    }
}
