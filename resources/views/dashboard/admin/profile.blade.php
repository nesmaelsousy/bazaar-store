@extends('dashboard.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid w-75">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="header-card text-center py-4">
                            <div class="image mb-3">
                                <div class="text-center">
                                    <div class="position-relative d-inline-block">
                                        <label for="avatar" class="cursor-pointer">
                                            <img name="avatar" style="object-fit:cover;"
                                                src="{{ asset(optional($admin->image) ? 'storage/' . $admin->image : 'backend/image/logo.png') }}"
                                                class="rounded-circle border border-3 border-white shadow" width="120"
                                                height="120" alt="صورة البروفايل">
                                        </label>

                                        <!-- أيقونة الحذف - موقع ثابت بالنسبة للصورة -->
                                        <div id="DeleteImage" class="position-absolute" data-bs-toggle="modal"
                                            data-bs-target="#deleteAvatarModal"
                                            style="top: 5px; right: 5px; width: 26px; height: 26px;">
                                            <div class="bg-white text-danger rounded-circle shadow-sm d-flex align-items-center justify-content-center w-100 h-100"
                                                style="cursor: pointer; border: 1px solid #fdfeff;">
                                                <i class="bi bi-trash3" style="font-size: 12px;"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <small class="text-muted">انقر على الصورة لتغييرها</small>
                                    </div>
                                </div>

                                <div class="d-none">
                                    <x-form.input type='file' accept=".jpg,.png,.svg,.jpeg" name="avatar"
                                        :oldimage="$admin->image" />
                                </div>


                            </div>
                            <div class="Name">
                                <h4 class="mb-0">{{ $admin->name }}</h4>
                            </div>
                        </div>

                        <hr style="color: #cdcdcd">
                        <div class="card-body">
                            <div class="mb-3">
                                <x-form.input label="الاسم بالكامل " name="name" type="text" :oldVal="old('name', $admin->name)" />

                            </div>

                            <div class="mb-3">
                                <x-form.input label="البريد الإلكتروني" name="email" type="email" :oldVal="old('email', $admin->email)"
                                    disable='true' disabled />

                            </div>

                            <!-- رقم الجوال -->
                            <x-form.input label="رقم الجوال" name="phone" :oldVal="old('phone', $admin->phone)" />

                            <!-- كلمة المرور -->
                            <x-form.input label="كلمة المرور" name="password" type="password" value="password" />

                            <!-- تأكيد كلمة المرور -->
                            <x-form.input label="تأكيد كلمة المرور" name="password_confirmation" type="password"
                                value="password" />


                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    حفظ التغيرات
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>


@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#avatar').on('change', function() {
                let file = this.files[0];
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-avatar').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);

            });
        });


        let del_img = document.querySelector('#DeleteImage');

        del_img.onclick = () => {
            let avatar = document.querySelector('img[name="avatar"]');
            if (avatar.src.includes('backend/image/logo.png')) {
                Swal.fire("لا يوجد صورة لحذفها!");
                return; // توقف عن تنفيذ الكود
            }

            Swal.fire({
                title: "هل انت متأكد ؟",
                text: "لن تتمكن من التراجع عن هذا !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "نعم احذفها !"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get('/admin/deleteImage')
                        .done((res) => {
                            document.querySelector('img[name="avatar"]')
                                .src =
                                "{{ asset('admin_assets_rtl/images/avatars/avatar-removebg-preview.png') }}";
                            Swal.fire({
                                title: "حذفت!",
                                text: "تم الحذف بنجاح .",
                                icon: "success"
                            });
                        })
                        .fail((err) => {
                            alert(err.responseText);
                        });

                }
            });
        }
    </script>
@endpush



