<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Active</th>
                <th>Role</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($users as $user)
            <tr>
                <td>{{ $loop->iteration  }}</td>
                <td><img class="rounded-circle" src="{{ asset($user->image ? 
                    'storage/' . $user->image:'backend/image/avatar.jpg') }}" width="50"
                        height="50"> {{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    <span
                        class=" p-1 text-center border rounded  {{ $user->status == 'active' ? 'text-success border-success' : 'text-danger border-danger' }}">
                        {{ $user->status }}
                    </span>
                </td>
                <td>{{ $user->role }}</td>
                <td class="d-flex g-2 align-items-center justify-content-start">
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn"><i
                            class="fas fa-pencil-alt text-primary"></i> </a>
                    <form action="{{ route('admin.user.destroy',$user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="border-0 bg-transparent" type="submit"> <i class="fas fa-trash-alt text-danger"></i></button>

                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No users found</td>
            </tr>
            @endforelse




        </tbody>
    </table>

</div>