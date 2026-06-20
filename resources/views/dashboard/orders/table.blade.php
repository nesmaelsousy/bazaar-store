@php
    $statusClasses = [
        'pending' => 'text-warning  border-warning',
        'processing' => 'text-dark border-dark',
        'delivering' => 'text-info  border-info',
        'completed' => 'text-success border-success',
        'cancelled' => 'text-danger border-danger',
        'refuned' => 'text-secondary border-secondary',
    ];
@endphp
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order number</th>
                <th>Client</th>
                <th>Craftsmen</th>
                <th>Total price</th>
                <th>Order type</th>
                <th>Order status</th>
                <th>Payment status</th>
                <th>Payment method</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> {{ $order->number }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->seller->name }}</td>
                    <td>{{ $order->total_price }}</td>

                    <td>
                        <span
                            class="p-1 text-center border rounded 
        {{ $order->order_type == 'custom' ? 'text-success border-success' : 'text-danger border-danger' }}">

                            {{ $order->order_type }}
                        </span>
                    </td>
                    <td>
                        <span class="p-1 text-center border rounded  {{ $statusClasses[$order->status] ?? 'bg-secondary' }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>
                        <span class="p-1 text-center border rounded  {{ $statusClasses[$order->payment_status] ?? 'bg-secondary' }}">
                            {{ $order->payment_status }}
                        </span>
                    </td>
                    <td>
                        <span class="p-1 text-center border rounded">
                            {{ $order->payment_method }}
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
                    <td colspan="10" class="text-center">No orders found</td>
                </tr>
            @endforelse




        </tbody>
    </table>

</div>
