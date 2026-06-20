@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <div class="p-5">
            {{-- Header --}}
            <div class="d-flex align-items-center gap-3 mb-1">
                <div class="page-icon mr-3">
                  <i class="fas fa-box"></i>
                </div>
                <div>
                    <h2 class="page-title mb- 0">Add a new product</h2>
                    <p class="page-subtitle mb-0">Fill in the details below to create a new product </p>
                </div>
            </div>

            <hr class="form-divider">
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
            {{-- Form --}}
            <form action="{{ route('admin.product.index') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('dashboard.products._form')
            </form>
        </div>
    </div>
@endsection

@push('js')
   <script src="{{ asset('frontend/js/status.js') }}"></script>
@endpush
