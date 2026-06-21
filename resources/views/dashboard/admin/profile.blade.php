@extends('dashboard.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid py-4">
            <div class="container">

                <form action="{{ route('admin.profile.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">

                        <div class="card-body text-center">

                            {{-- IMAGE --}}
                            <div class="position-relative d-inline-block show-img">

                                <img id="previewImage"
                                    style="
                            width:120px;
                            height:120px;
                            object-fit:cover;
                            border-radius:50%;
                            border:3px solid #F0E8E0;
                            box-shadow:0 4px 12px rgba(92,61,46,0.15);
                        "
                                    src="{{ asset($admin->image ? 'storage/' . $admin->image : 'backend/image/avatar.jpg') }}"
                                    alt="profile">

                                {{-- delete icon --}}
                                <div id="DeleteImage"
                                    style="
                            position:absolute;
                            top:5px;
                            right:5px;
                            width:26px;
                            height:26px;
                            cursor:pointer;
                        ">
                                    <div
                                        class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center w-100 h-100">
                                        <i class="fas fa-trash" style="font-size:12px;"></i>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-2">
                                <small class="text-muted">Click the image to change it</small>
                                <br>
                                <small class="text-muted">200 × 200 px</small>
                            </div>

                            {{-- hidden input --}}
                            <input type="file" id="image-input" name="image" class="d-none">

                            <h4 class="mt-3">{{ $admin->name }}</h4>

                        </div>

                        <hr>

                        <div class="card-body">

                            <div class="mb-3">
                                <x-form.input label="Full Name" name="name" type="text" :oldVal="old('name', $admin->name)" />
                            </div>

                            <div class="mb-3">
                                <x-form.input label="Email" name="email" type="email" :oldVal="old('email', $admin->email)" disabled />
                            </div>

                            <div class="mb-3">
                                <x-form.input label="Phone" name="phone" :oldVal="old('phone', $admin->phone)" />
                            </div>

                            <div class="mb-3">
                                <x-form.input label="Password" name="password" type="password" />
                            </div>

                            <div class="mb-3">
                                <x-form.input label="Confirm Password" name="password_confirmation" type="password" />
                            </div>

                            <button class="btn btn-primary w-100">
                                Save Changes
                            </button>

                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const wrapper = document.querySelector('.show-img');
            const input = document.getElementById('image-input');
            const img = document.getElementById('previewImage');
            const del = document.getElementById('DeleteImage');

            // open file picker
            if (wrapper && input) {
                wrapper.addEventListener('click', function(e) {
                    if (!e.target.closest('#DeleteImage')) {
                        input.click();
                    }
                });
            }

            // preview image
            if (input && img) {
                input.addEventListener('change', function() {
                    const file = this.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                });
            }

            // delete image
            if (del && img) {
                del.addEventListener('click', function(e) {
                    e.stopPropagation();

                    if (!confirm("Delete image?")) return;

                    fetch('/admin/deleteImage', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                img.src = "/backend/image/avatar.jpg";
                                alert("Deleted successfully");
                            }
                        })
                        .catch(() => alert("Error deleting image"));
                });
            }

        });
    </script>
@endpush
