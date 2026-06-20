@extends('master')

@section('content')
    <main class="min-h-screen pt-28 pb-10 px-6">
        <div class="max-w-6xl mx-auto">


            {{-- Header --}}
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <div class="flex justify-between items-center">

                    <div>
                        <h1 class="text-3xl font-bold text-[#835837]">
                            Order #{{ $order->number }}
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Placed {{ $order->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <span class="px-4 py-2 rounded-full text-sm font-semibold
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
            </div>

            {{-- Order Items --}}
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

                <h2 class="text-xl font-bold text-[#835837] mb-5">
                    Order Items
                </h2>

                <div class="space-y-4">

                    @foreach ($order->orderItems as $item)
                        <div class="flex items-center gap-4 border-b pb-4">

                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                class="w-24 h-24 rounded-xl object-cover">

                            <div class="flex-1">

                                <h3 class="font-semibold text-lg text-[#835837]">
                                    {{ $item->product->title }}
                                </h3>

                                <p class="text-gray-500">
                                    Quantity: {{ $item->quantity }}
                                </p>

                                <p class="text-gray-500">
                                    Unit Price: ${{ number_format($item->price, 2) }}
                                </p>

                            </div>

                            <div class="text-xl font-bold text-[#835837]">
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

            {{-- Shipping Info --}}
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-5">

                <h2 class="text-xl font-bold text-[#835837] mb-4">
                    Shipping Information
                </h2>

                <div class="grid md:grid-cols-2 gap-4">

                    <div>
                        <p class="text-gray-500">Full Name</p>
                        <p class="font-semibold">{{ $order->address->fullname }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Phone</p>
                        <p class="font-semibold">{{ $order->address->phone }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Email</p>
                        <p class="font-semibold">{{ $order->address->email }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">City</p>
                        <p class="font-semibold">{{ $order->address->city }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Country</p>
                        <p class="font-semibold">{{ $order->address->country }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Street</p>
                        <p class="font-semibold">{{ $order->address->street }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Building Number</p>
                        <p class="font-semibold">{{ $order->address->BuildNum }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">District</p>
                        <p class="font-semibold">{{ $order->address->district }}</p>
                    </div>

                    @if ($order->address->apartment)
                        <div>
                            <p class="text-gray-500">Apartment</p>
                            <p class="font-semibold">{{ $order->address->apartment }}</p>
                        </div>
                    @endif

                    @if ($order->address->floor)
                        <div>
                            <p class="text-gray-500">Floor</p>
                            <p class="font-semibold">{{ $order->address->floor }}</p>
                        </div>
                    @endif

                </div>
            </div>

            {{-- Summary --}}
            <div class="bg-white rounded-2xl shadow-lg p-6">

                <h2 class="text-xl font-bold text-[#835837] mb-4">
                    Order Summary
                </h2>

                <div class="space-y-3">

                    <div class="flex justify-between">
                        <span>Items Total</span>
                        <span>
                            ${{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity), 2) }}
                        </span>
                    </div>

                    <div class="border-t pt-3 flex justify-between text-xl font-bold text-[#835837]">
                        <span>Total</span>
                        <span>
                            ${{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity), 2) }}
                        </span>
                    </div>

                </div>

            </div>

        </div>
    </main>
@endsection
