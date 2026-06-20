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
                    <h2 class="text-2xl font-bold text-[#835837]">Edet a {{ $product->title }}</h2>
                    <p class="text-sm text-gray-500">Update product data</p>
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

                <form action="{{ route('craftsmen.product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')
                    @include('profile.craftsmen._form')
                    {{-- ================= ACTIONS ================= --}}
                    <hr class="border-gray-200 mt-10">

                    <div class="flex items-center gap-3 mt-6">

                        <button type="submit"
                            class="px-6 py-2 rounded-lg bg-[#835837] text-white font-semibold hover:bg-[#6d472f] transition">
                            Update
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

    <script>
        // متغير لتتبع الصور المحذوفة
        let removedImages = [];

        // حذف الصورة من الواجهة والإضافة للقائمة المحذوفة
        function removeImage(button, imagePath) {
            // أضفها للقائمة
            if (!removedImages.includes(imagePath)) {
                removedImages.push(imagePath);
            }
            // أحذفها من الواجهة
            button.closest('.relative').remove();
        }

        // قبل إرسال الفورم، أضف الصور المحذوفة
        document.querySelector('form').addEventListener('submit', function(e) {
            if (removedImages.length > 0) {
                // أضف hidden input يحتوي على الصور المحذوفة كـ JSON
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'removed_images';
                input.value = JSON.stringify(removedImages);
                this.appendChild(input);
            }
        });
    </script>
@endpush