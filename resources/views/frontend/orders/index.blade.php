@extends('master')
@section('content')
    <main class="min-h-screen pt-28 pb-10 px-6">
        <div id="artisanContainer" class="max-w-6xl mx-auto">
            <div class="max-w-6xl mx-auto space-y-5">

                <h2 class="text-3xl font-bold text-[#835837] mb-6">
                    My Orders
                </h2>

                @forelse($orders as $order)
                    <div class="bg-white rounded-2xl shadow-lg p-5 border border-[#F4E7DD]">

                        <div class="flex justify-between items-start mb-4">

                            <div>
                                <h3 class="font-bold text-[#835837] text-lg">
                                    Order #{{ $order->number }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $order->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <span
                                class="px-4 py-2 rounded-full text-sm font-semibold
                    @class([
                        'bg-yellow-100 text-yellow-700' => $order->status == 'pending',
                        'bg-orange-100 text-orange-700' => $order->status == 'processing',
                        'bg-purple-100 text-purple-700' => $order->status == 'delivering',
                        'bg-green-100 text-green-700' => $order->status == 'completed',
                        'bg-red-100 text-red-700' => $order->status == 'cancelled',
                    ])">
                                {{ ucfirst($order->status) }}
                            </span>

                        </div>

                        <div class="space-y-3">

                            @foreach ($order->orderItems as $item)
                                <div class="flex items-center gap-4 border-b pb-3">

                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                        class="w-20 h-20 rounded-xl object-cover">

                                    <div class="flex-1">

                                        <h4 class="font-semibold text-[#835837]">
                                            {{ $item->product->title }}
                                        </h4>

                                        <p class="text-sm text-gray-500">
                                            Qty: {{ $item->quantity }}
                                        </p>

                                    </div>

                                    <div class="font-bold text-[#835837]">
                                        ${{ number_format($item->price * $item->quantity, 2) }}
                                    </div>

                                </div>
                            @endforeach

                        </div>

                        <div class="flex justify-between items-center mt-5">

                            <div class="font-bold text-xl text-[#835837]">
                                Total:
                                ${{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity), 2) }}
                            </div>

                            <a href="{{ route('frontend.orders.show',$order->id) }}"
                                class="bg-[#835837] text-white px-5 py-2 rounded-xl hover:bg-[#6b4529] transition">
                                View Details
                            </a>

                        </div>

                    </div>

                @empty

                    <div class="bg-white rounded-2xl shadow-lg p-16 text-center">

                        <i class="fa-solid fa-box-open text-6xl text-[#d4b7a5] mb-4"></i>

                        <h3 class="text-2xl font-bold text-[#835837]">
                            No Orders Yet
                        </h3>

                        <p class="text-gray-500 mt-2">
                            You haven't placed any orders yet.
                        </p>

                    </div>
                @endforelse

            </div>
        </div>
    </main>
@endsection
