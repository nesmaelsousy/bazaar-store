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
                    <h2 class="page-title mb- 0">Add a new order</h2>
                    <p class="page-subtitle mb-0">Fill in the details below to create a new order </p>
                </div>
            </div>

            <hr class="form-divider">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('dashboard.orders._form')
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Toggle buttons
        function pick(el, group, value) {
            const parent = el.closest('.toggle-group');
            parent.querySelectorAll('.toggle-btn').forEach(b => {
                b.classList.remove('active-green', 'active-danger', 'active-brown');
            });

            if (group === 'status') {
                el.classList.add(value === 'active' ? 'active-green' : 'active-danger');
                document.getElementById('statusVal').value = value;
            } else if (group === 'is_customizable') {
                el.classList.add(value == 1 ? 'active-green' : 'active-danger');
                document.getElementById('is_customizableVal').value = value;
            } else {
                el.classList.add('active-brown');
                document.getElementById('roleVal').value = value;
            }
        }
    </script>
@endpush
