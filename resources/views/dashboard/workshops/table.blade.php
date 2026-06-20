<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Duration</th>
                <th>Price</th>
                <th>Available Slots</th>
                <th>Date</th>
                <th>Status</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($workshops as $workshop)
            <tr>
                <td>{{ $loop->iteration  }}</td>
                <td> {{ $workshop->title }}</td>
                <td>{{ $workshop->description }}</td>
                <td> <img  src="{{ asset('storage/' . $workshop->image) }}" alt="{{ $workshop->title }}" width="100"> </td>
                <td>{{ $workshop->duration }}</td>
                <td>{{ $workshop->price }}</td>
                <td>{{ $workshop->availableSlots }}</td>
                <td>{{ \Carbon\Carbon::parse($workshop->date)->format('d M Y') }}</td>
                <td>
                    <span
                        class=" p-1 text-center border rounded  {{ $workshop->status == 'active' ? 'text-success border-success' : 'text-danger border-danger' }}">
                        {{ $workshop->status }}
                    </span>
                </td>
                <td class="d-flex g-2 align-items-center justify-content-start">
                    <a href="{{ route('admin.workshop.edit', $workshop->id) }}" class="btn"><i
                            class="fas fa-pencil-alt text-primary"></i> </a>
                    <form action="{{ route('admin.workshop.destroy',$workshop->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="border-0 bg-transparent" type="submit"> <i class="fas fa-trash-alt text-danger"></i></button>

                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">No workshops found</td>
            </tr>
            @endforelse




        </tbody>
    </table>

</div>