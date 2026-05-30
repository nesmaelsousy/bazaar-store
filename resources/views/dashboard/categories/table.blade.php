<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Image</th>
                <th>Category Name</th>
                <th>Status</th>
                <th>Parent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($categories as $category)
            <tr>
                <td>{{ $loop->iteration  }}</td>

                <td><img class="rounded-circle" src="{{ asset($category->image ? 
                    'storage/' . $category->image:'backend/image/avatar.jpg') }}" width="50"
                        height="50"> </td>
                <td>{{ $category->name }}</td>
                <td>
                    <span
                        class=" p-1 text-center border rounded  {{ $category->status == 'active' ? 'text-success border-success' : 'text-danger border-danger' }}">
                        {{ $category->status }}
                    </span>
                </td>
               <td>{{ $category->parent->name ?? 'Primary Category' }}</td>
                <td class="d-flex g-2 align-items-center justify-content-start">
                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn"><i
                            class="fas fa-pencil-alt text-primary"></i> </a>
                    <form action="{{ route('admin.category.destroy',$category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="border-0 bg-transparent" type="submit"> <i class="fas fa-trash-alt text-danger"></i></button>

                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No categories found</td>
            </tr>
            @endforelse




        </tbody>
    </table>

</div>