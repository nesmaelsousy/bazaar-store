<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name Store</th>
                <th>Image Store</th>
                <th>Store Owner</th>
                <th>Rating</th>
                <th>Phone</th>

                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($stores as $store)
            <tr>
                <td>{{ $loop->iteration  }}</td>
                <td> {{ $store->name }}</td>
                <td> <img class="" src="{{ asset($store->image ? 
                    'storage/' . $store->image:'backend/image/avatar.jpg') }}" style="width: 100px;height: 70px;"
                        ></td>
                <td>{{ $store->user->name }}</td>
                <td>{{ $store->rating }}</td>
                <td>{{ $store->phone }}</td>

                <td>
                    <span
                        class=" p-1 text-center border rounded  {{ $store->status == 'active' ? 'text-success border-success' : 'text-danger border-danger' }}">
                        {{ $store->status }}
                    </span>
                </td>
                <td>{{ $store->role }}</td>
                <td class="d-flex g-2 align-items-center justify-content-start">
                    <a href="{{ route('admin.store.edit', $store->id) }}" class="btn"><i
                            class="fas fa-pencil-alt text-primary"></i> </a>
                    <form action="{{ route('admin.store.destroy',$store->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="border-0 bg-transparent" type="submit"> <i class="fas fa-trash-alt text-danger"></i></button>

                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No stores found</td>
            </tr>
            @endforelse




        </tbody>
    </table>

</div>