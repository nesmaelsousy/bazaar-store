@extends('master')
@section('content')
    <main class="bg-[#F9F5F1] min-h-screen pt-36 pb-20">
        <div class="max-w-6xl mx-auto px-4 py-6">
            {{-- Header --}}
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-[#835837]/10 text-[#835837]">
                    <i class="fas fa-box text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-[#835837]">Add a new product</h2>
                    <p class="text-sm text-gray-500">Fill in the details below to create a new product</p>
                </div>
            </div>
            <hr class="border-gray-200 mb-6">

            {{-- Errors --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
                    <ul class="list-disc pl-5 text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <form action="{{ route('craftsmen.product.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf
                @include('profile.craftsmen._form')
                    {{-- ================= ACTIONS ================= --}}
                    <hr class="border-gray-200 mt-10">

                    <div class="flex items-center gap-3 mt-6">

                        <button type="submit"
                            class="px-6 py-2 rounded-lg bg-[#835837] text-white font-semibold hover:bg-[#6d472f] transition">
                            Save
                        </button>

                        <a href="{{ route('craftsmen.profile.index') }}"
                            class="px-6 py-2 rounded-lg border border-[#835837] text-[#835837] hover:bg-[#f7eee9] transition">
                            Cancel
                        </a>

                    </div>

                </form>
            </div>
        </div>
    </main>


@endsection
@push('css')
    <style>
        .toggle-group {
            display: flex;
            gap: 8px;
        }

        .toggle-btn {
            flex: 1;
            padding: 0.5rem;
            border-radius: 8px;
            border: 1px solid #e2cdc2;
            background: #fdf7f4;
            color: #9e7b6b;
            font-size: 0.83rem;
            font-weight: 500;
            cursor: pointer;
            text-align: center;
            transition: all 0.15s;
            product-select: none;
        }

        .toggle-btn.active-green {
            background: #eaf7f0;
            border-color: #3ecf8e;
            color: #1f9e65;
        }

        .toggle-btn.active-danger {
            background: #fff8ec;
            border-color: #f00505;
            color: #b91a1a;
        }

        .toggle-btn.active-brown {
            background: #f3e6dc;
            border-color: #A0522D;
            color: #A0522D;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('frontend/js/image.js') }}"></script>
    <script src="{{ asset('frontend/js/status.js') }}"></script>
    {{-- // الصور الفرعية
    <script>
        const imagesInput = document.getElementById('imagesInput');
        const preview = document.getElementById('preview');
        let allImages = [];

        imagesInput.addEventListener('change', function(e) {
            // إضافة الصور الجديدة
            Array.from(this.files).forEach((file) => {
                if (!allImages.some(img => img.name === file.name && img.size === file.size)) {
                    allImages.push(file);
                }
            });

            renderAllImages();
            imagesInput.value = ''; // تفريغ الـ input
        });

        function renderAllImages() {
            preview.innerHTML = '';

            allImages.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(event) {
                    const imageDiv = document.createElement('div');
                    imageDiv.className =
                        'relative group rounded-lg overflow-hidden border border-gray-200 hover:shadow-md transition';
                    imageDiv.innerHTML = `
                    <img src="${event.target.result}" alt="Preview ${index + 1}" 
                        class="w-full h-32 object-cover">
                    <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition"
                        onclick="removeImage(${index})">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;
                    preview.appendChild(imageDiv);
                };

                reader.readAsDataURL(file);
            });
        }

        function removeImage(index) {
            allImages.splice(index, 1);
            renderAllImages();
        }

        // قبل الإرسال - حط الصور في FormData
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            // حط كل الصور
            allImages.forEach(image => {
                formData.append('images[]', image);
            });
            // أرسل الفورم
            fetch(this.action, {
                    method: this.method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '{{ route('craftsmen.profile.index') }}';
                    }
                });
        });
    </script> --}}

@endpush
