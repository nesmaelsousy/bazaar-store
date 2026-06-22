@extends('dashboard.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid py-4">
            <div class="container">


                <div class="card">
                    <div class="card-body">

                        <h3 class="mb-4">Settings</h3>

                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- ================= GENERAL ================= --}}
                            <h5>General Settings</h5>

                            <div class="mb-3">
                                <label>Site Name</label>
                                <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Site Email</label>
                                <input type="email" name="site_email" value="{{ $settings['site_email'] ?? '' }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="site_phone" value="{{ $settings['site_phone'] ?? '' }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control">{{ $settings['address'] ?? '' }}</textarea>
                            </div>

                            {{-- Logo --}}
                            <div class="mb-3">
                                <label>Logo</label>
                                <input type="file" name="logo" class="form-control">

                                @if (!empty($settings['logo']))
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings['logo']) }}" width="100">
                                    </div>
                                @endif
                            </div>

                            {{-- Maintenance --}}
                            <div class="mb-3">
                                <label>
                                    <input type="checkbox" name="maintenance_mode" value="1"
                                        {{ !empty($settings['maintenance_mode']) ? 'checked' : '' }}>
                                    Maintenance Mode
                                </label>
                            </div>

                            <hr>

                            {{-- ================= SOCIAL MEDIA ================= --}}
                            <h5>Social Media</h5>

                            <div class="mb-3">
                                <label>Facebook</label>
                                <input type="url" name="facebook" value="{{ $settings['facebook'] ?? '' }}"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Instagram</label>
                                <input type="url" name="instagram" value="{{ $settings['instagram'] ?? '' }}"
                                    class="form-control">
                            </div>

                           

                            <div class="mb-3">
                                <label>WhatsApp</label>
                                <input type="url" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}"
                                    class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Save Settings
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
