document.addEventListener('DOMContentLoaded', function () {

    const imgWrapper = document.querySelector('.show-img');
    const input = document.getElementById('image-input');
    const img = imgWrapper.querySelector('img');

    // فتح اختيار الصورة عند الضغط على الصورة
    imgWrapper.addEventListener('click', function () {
        input.click();
    });

    // تغيير الصورة عند الاختيار
    input.addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                img.src = e.target.result; // استبدال الصورة
            };

            reader.readAsDataURL(file);
        }
    });

});