@extends('dashboard.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row m-2 align-items-center justify-content-between">
                <div class="">
                    <h1>Craftsmen Table </h1>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ URL::current() }}" method="get" class="text-center">

                        <div class="d-flex gap-2 align-items-center col-12">

                            <div>
                                <div class="input-group input-group-sm">
                                    {{-- <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search"> --}}
                                    <x-form.input name="username" placeholder="Search by username" :oldVal="request('username')"
                                        style="width:500px" />
                                    <div >
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class=" ml-4" style="width:200px">
                                <x-form.select name="role"
                                    firstOne="all user" :options="['craftsmen' => 'Craftsmen', 'clint' => 'Clint']" />
                            </div> --}}
                            <div class="ml-4">
                                <button type="submit" class="btn  btn-primary" style="width:150px">
                                    Filter
                                </button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if ($users->isNotEmpty())
                            <h3 class="card-title">Craftsmen number ({{ $users->count() }})</h3>
                            @endif
                            <div class="card-tools">
                                <div>
                                    <a href="{{ route('admin.user.create') }}" class="m-2"><i
                                            class="fas fa-plus me-1"></i>
                                        Add Craftsmen</a>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        {{-- table  --}}
                        @include('dashboard.users.table')
                        {{-- end table --}}
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
            {{ $users->links() }}
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection