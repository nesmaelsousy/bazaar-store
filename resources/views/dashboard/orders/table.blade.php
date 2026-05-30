<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>order number</th>
                <th>user</th>
                <th>store</th>
                <th>total price</th>
                <th>status</th>
                <th>order type</th>
                <th>change</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td> {{ $order->order_number }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->store->name }}</td>
                <td>{{ $order->total_price }}</td>
                <td>
                    <span
                        class=" p-1 text-center border rounded ">
                        {{ $order->status }}
                    </span>
                </td>
                <td>
                    <span class="p-1 text-center border rounded 
        {{ $order->order_type == 'custom' ? 'text-success border-success' : 'text-danger border-danger' }}">

                        {{ $order->order_type }}
                    </span>
                </td>
                <td class="d-flex g-2 align-items-center justify-content-start">
                    <a href="{{ route('admin.order.edit', $order->id) }}" class="btn"><i
                            class="fas fa-pencil-alt text-primary"></i> </a>
                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="border-0 bg-transparent" type="submit"> <i
                                class="fas fa-trash-alt text-danger"></i></button>

                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No orders found</td>
            </tr>
            @endforelse




        </tbody>
    </table>

</div>