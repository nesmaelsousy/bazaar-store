@extends('master')

@section('content')
    <main class="bg-[#F9F5F1] min-h-screen pt-36 pb-20">
        <section class="max-w-5xl mx-auto px-4">
            <div class="max-w-6xl mx-auto py-10">

                {{-- Header --}}
                <div class="bg-white shadow rounded-2xl p-6 mb-6 flex justify-between items-center">

                    <div>
                        <h1 class="text-2xl font-bold text-[#835837]">
                            Order Details #{{ $order->id }}
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Status:
                            <span
                                class="px-3 py-1 rounded-full text-sm
                    @if ($order->status == 'paid') bg-green-100 text-green-700
                    @elseif($order->status == 'processing') bg-yellow-100 text-yellow-700
                    @else bg-blue-100 text-blue-700 @endif">
                                {{ $order->status }}
                            </span>
                        </p>
                    </div>
                    <a href="{{ route('craftsmen.profile.index') }}">Back </a>

                </div>

                {{-- Customer Info --}}
                <div class="bg-white shadow rounded-2xl p-6 mb-6">

                    <h2 class="text-lg font-bold text-[#835837] mb-4">Customer Information</h2>

                    <div class="grid md:grid-cols-2 gap-4 text-sm">

                        <div>
                            <p class="text-gray-500">Full Name</p>
                            <p class="font-semibold">{{ $order->address->fullname }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Phone</p>
                            <p class="font-semibold">{{ $order->address->phone }}</p>
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
                            <p class="text-gray-500">Address</p>
                            <div class="grid grid-cols-2 gap-3 text-gray-700">

                                @if ($order->address->street)
                                    <div>
                                        <span class="text-gray-400 text-sm">Street</span>
                                        <p class="font-medium">{{ $order->address->street }}</p>
                                    </div>
                                @endif

                                @if ($order->address->district)
                                    <div>
                                        <span class="text-gray-400 text-sm">District</span>
                                        <p class="font-medium">{{ $order->address->district }}</p>
                                    </div>
                                @endif

                                @if ($order->address->BuildNum)
                                    <div>
                                        <span class="text-gray-400 text-sm">Building</span>
                                        <p class="font-medium">{{ $order->address->BuildNum }}</p>
                                    </div>
                                @endif

                                @if ($order->address->apartment)
                                    <div>
                                        <span class="text-gray-400 text-sm">Apartment</span>
                                        <p class="font-medium">{{ $order->address->apartment }}</p>
                                    </div>
                                @endif

                                @if ($order->address->floor)
                                    <div>
                                        <span class="text-gray-400 text-sm">Floor</span>
                                        <p class="font-medium">{{ $order->address->floor }}</p>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>

                </div>

                {{-- Order Items --}}
                <div class="bg-white shadow rounded-2xl p-6 mb-6">

                    <h2 class="text-lg font-bold text-[#835837] mb-4">Order Items</h2>

                    <div class="space-y-4">

                        @foreach ($order->orderItems as $item)
                            <div class="flex items-center justify-between border-b pb-3">

                                <div>
                                    <h3 class="font-semibold text-[#835837]">
                                        {{ $item->product->name }}
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Quantity: {{ $item->quantity }}
                                    </p>
                                </div>

                                <div class="font-bold text-[#835837]">
                                    ${{ $item->price * $item->quantity }}
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

                {{-- Update Status --}}
                <div class="bg-white shadow rounded-2xl p-6">

                    <h2 class="text-lg font-bold text-[#835837] mb-4">Update Order Status</h2>
                    <form method="POST" action="{{ route('craftsmen.orders.update', $order->id) }}">
                        @csrf
                    @method('PUT')
                        <div class="flex items-center gap-3">

                            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">

                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                </option>

                            </select>

                            <button type="submit"
                                class="px-4 py-2 bg-[#835837] text-white rounded-lg hover:bg-[#6b4529] transition">
                                Update Status
                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </section>
    </main>
@endsection
