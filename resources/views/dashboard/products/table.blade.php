<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>title</th>
                <th>Image</th>
                <th>category</th>
                <th>price</th>
                <th>Stock Quantity</th>
                <th>status</th>
                <th>customizable</th>
                <th>change</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td> {{ $product->title }}</td>
                <td><img
                        src="{{ asset($product->image ? 'storage/' . $product->image : 'backend/image/image-placeholder') }}"
                        width="100"></td>
                
                <td>{{ $product->category->name }}</td>

                <td>{{ $product->price }}</td>
                <td>{{ $product->stock_quantity }}</td>

                <td>
                    <span
                        class=" p-1 text-center bproduct rounded  {{ $product->status == 'active' ? 'text-success bproduct-success' : 'text-danger bproduct-danger' }}">
                        {{ $product->status }}
                    </span>
                </td>
                <td>
                    <span class="p-1 text-center bproduct rounded 
        {{ $product->is_customizable ? 'text-success bproduct-success' : 'text-danger bproduct-danger' }}">

                        {{ $product->is_customizable ? 'Enabled' : 'Disabled' }}
                    </span>
                </td>
                <td class="d-flex g-2 align-items-center justify-content-start">
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn"><i
                            class="fas fa-pencil-alt text-primary "></i> </a>
                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bproduct-0 border-0 bg-transparent" type="submit"> <i
                                class="fas fa-trash-alt text-danger"></i></button>

                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No products found</td>
            </tr>
            @endforelse




        </tbody>
    </table>

</div>