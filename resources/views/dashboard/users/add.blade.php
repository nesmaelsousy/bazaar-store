@extends('dashboard.app')



@section('content')
<div class="content-wrapper">
    <div class="p-5">

        {{-- Header --}}
        <div class="d-flex align-items-center gap-3 mb-1">
            <div class="page-icon mr-3">
                <i class="fas fa-user-plus"></i>
            </div>
            <div>
                <h2 class="page-title mb- 0">Add a new user</h2>
                <p class="page-subtitle mb-0">Fill in the details below to create a new user account</p>
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
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('dashboard.users._form')
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
        } else {
            el.classList.add('active-brown');
            document.getElementById('roleVal').value = value;
        }
    }
</script>
@endpush