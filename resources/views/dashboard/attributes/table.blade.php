<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>name</th>
                <th>change</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($attributes as $attribute)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td> {{ $attribute->name }}</td>
                <td class="d-flex g-2 align-items-center justify-content-center">
                    <a href="{{ route('admin.attribute.edit', $attribute->id) }}" class="btn"><i
                            class="fas fa-pencil-alt text-primary "></i> </a>
                    <form action="{{ route('admin.attribute.destroy', $attribute->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="battribute-0 border-0 bg-transparent" type="submit"> <i
                                class="fas fa-trash-alt text-danger"></i></button>

                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">No attributes found</td>
            </tr>
            @endforelse




        </tbody>
    </table>

</div>