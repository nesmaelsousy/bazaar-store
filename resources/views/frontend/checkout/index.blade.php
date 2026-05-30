@extends('master')
@section('content')
    <main class="min-h-screen py-10 pt-28">
        <section class="max-w-4xl mx-auto grid md:grid-cols-2 gap-6 px-4">
            <div id="formContainer" class="bg-white border border-[#f1e2d3] rounded-xl shadow-md p-6">
                <h2 class="text-[#a05a1c] text-xl font-bold tracking-wide mb-4">Delivery Information</h2>
                <form id="checkoutForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-[#5A3E2B] mb-1">Full Name*</label>
                        <input type="text" id="name" placeholder="e.g. Tareq Sameh"
                            class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                        <p class="error hidden text-sm mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#5A3E2B] mb-1">Phone Number*</label>
                        <div
                            class="flex items-center border border-[#e5d3c5] rounded-lg overflow-hidden focus-within:ring-1 focus-within:ring-[#5A3E2B]">
                            <select id="countryCode"
                                class="bg-transparent p-1 outline-none border-r text-sm font-medium text-gray-700">
                                <option value="+20">EG +20</option>
                                <option value="+970">PS +970</option>
                                <option value="+966">SA +966</option>
                            </select>
                            <input type="tel" id="phone" placeholder="123456789"
                                class="flex-1 p-3 text-sm outline-none">
                        </div>
                        <p class="error hidden text-sm mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#5A3E2B] mb-1">Email*</label>
                        <input type="email" id="email" placeholder="example@gmail.com"
                            class="email-field w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                        <p class="error hidden text-sm mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#5A3E2B] mb-1">Country*</label>
                        <input type="text" id="country" placeholder="e.g. Palestine"
                            class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                        <p class="error hidden text-sm mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#5A3E2B] mb-1">City*</label>
                        <input type="text" id="city" placeholder="e.g. Gaza City"
                            class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                        <p class="error hidden text-sm mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#5A3E2B] mb-1">District*</label>
                        <input type="text" id="district" placeholder="e.g. Al-Rimal"
                            class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                        <p class="error hidden text-sm mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#5A3E2B] mb-1">Street*</label>
                        <input type="text" id="street" placeholder="e.g. Omar Al-Mukhtar St."
                            class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                        <p class="error hidden text-sm mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#5A3E2B] mb-1">Building Number*</label>
                        <input type="text" id="building" placeholder="e.g. Building 15"
                            class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                        <p class="error hidden text-sm mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#5A3E2B] mb-1">Floor (Optional)</label>
                        <input type="text" id="floor" placeholder="e.g. 3rd Floor"
                            class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#5A3E2B] mb-1">Apartment (Optional)</label>
                        <input type="text" id="apartment" placeholder="e.g. Apt 5"
                            class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                    </div>
                    <button type="submit"
                        class="col-span-2 mx-auto block bg-[#a05a1c] text-white font-medium px-6 py-2 mt-5 rounded-lg transition hover:bg-[#c27a3f]">Confirm
                        Address</button>
                </form>
            </div>
            <div id="deliveryBox" class="hidden"></div>
            <div class="bg-white border border-[#f1e2d3] p-6 rounded-xl shadow-md h-fit">
                <h2 class="text-[#a05a1c] text-xl font-bold tracking-wide mb-4">Order Summary</h2>
                <div id="orderItems" class="text-[#5A3E2B] space-y-3">

                    @foreach ($cart as $item)
                        <div class="flex justify-between items-center border-b border-[#f1e2d3] py-2">

                            <!-- Product Name -->
                            <div class="flex flex-col">
                                <span class="font-semibold">
                                    {{ $item->product->title }}
                                </span>

                                <span class="text-sm text-gray-500">
                                    Qty: {{ $item->quantity }} × ${{ number_format($item->product->price) }}
                                </span>
                            </div>

                            <!-- Subtotal -->
                            <div class="font-bold text-[#a05a1c]">
                                ${{ number_format($item->product->price * $item->quantity) }}
                            </div>

                        </div>
                    @endforeach
                    <div id="orderItems" class="text-[#5A3E2B]"></div>
                    <div class="text-[#a05a1c] font-bold pt-4 mt-4 border-t border-[#f1e2d3]">Total: $<span
                            id="totalPrice">{{ number_format($total) }}</span></div>
                    <div class="mt-4">
                        <button id="goToPayment"
                            class="hidden w-full bg-[#a05a1c] text-white font-medium px-4 py-2 rounded-lg transition hover:bg-[#c27a3f]">Continue
                            to Payment</button>
                    </div>

                </div>


        </section>
    </main>
@endsection
@push('scripts')
    <script type="module" src="{{ asset('frontend/js/checkout.js') }}"></script>
@endpush
