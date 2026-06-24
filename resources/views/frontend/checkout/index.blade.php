@extends('master')

@section('content')
    <main class="py-10 pt-36 pb-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

            <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Delivery Information -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-md p-8">
                    <h2 class="text-2xl font-bold text-[#5A3E2B] mb-6">
                        Delivery Information
                    </h2>
                    @if ($errors->has('stock'))
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                            {{ $errors->first('stock') }}
                        </div>
                    @endif
                    <form action="{{ route('frontend.checkout.store') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 font-medium text-[#5A3E2B]">Full Name <span
                                        class="text-[red]">*</span></label>
                                <x-form.input name="fullname" type="text" ype="text" placeholder="e.g. Tareq Sameh"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#a05a1c] outline-none transition" />

                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-[#5A3E2B]">Phone Number <span
                                        class="text-[red]">*</span></label>
                                <x-form.input name="phone" type="text" placeholder="+970 123456789"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#a05a1c] outline-none transition" />

                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-[#5A3E2B]">Email <span
                                        class="text-[red]">*</span></label>
                                <x-form.input name="email" type="email" placeholder="example@gmail.com"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#a05a1c] outline-none transition" />

                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-[#5A3E2B]">Country <span
                                        class="text-[red]">*</span></label>
                                <x-form.input name="country" type="text" placeholder="Palestine"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#a05a1c] outline-none transition" />

                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-[#5A3E2B]">City <span
                                        class="text-[red]">*</span></label>
                                <x-form.input name="city" type="text" placeholder="Gaza City"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#a05a1c] outline-none transition" />

                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-[#5A3E2B]">District <span
                                        class="text-[red]">*</span></label>
                                <x-form.input name="district" type="text" placeholder="Al-Rimal"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#a05a1c] outline-none transition" />

                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-[#5A3E2B]">Street <span
                                        class="text-[red]">*</span></label>
                                <x-form.input name="street" type="text" placeholder="Omar Al-Mukhtar St."
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#a05a1c] outline-none transition" />

                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-[#5A3E2B]">Building Number <span
                                        class="text-[red]">*</span></label>
                                <x-form.input name="BuildNum" type="text" placeholder="Building 15"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#a05a1c] outline-none transition" />

                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-[#5A3E2B]">Floor
                                    <span class="text-[#91775e]">(optional)</span></label>
                                <x-form.input name="floor" type="text" placeholder="3rd Floor"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#a05a1c] outline-none transition" />

                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-[#5A3E2B]">Apartment
                                    <span class="text-[#91775e]">(optional)</span>
                                </label>
                                <x-form.input name="apartment" type="text" placeholder="Apt 5"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#a05a1c] outline-none transition" />

                            </div>

                        </div>

                        <button type="submit"
                            class="mt-8 bg-[#a05a1c] hover:bg-[#8b4e18] text-white px-8 py-3 rounded-lg font-semibold transition shadow-sm">
                            Confirm Address
                        </button>
                    </form>

                </div>


                <!-- Order Summary -->
                <div class="bg-white rounded-2xl shadow-md p-6 h-fit sticky top-6">

                    <h2 class="text-2xl font-bold text-[#5A3E2B] mb-6">
                        Order Summary
                    </h2>

                    @foreach ($carts as $item)
                        <div class="flex justify-between items-center py-4 border-b border-gray-100">

                            <div>
                                <h4 class="font-semibold text-[#5A3E2B]">
                                    {{ $item->product->title }}
                                </h4>

                                <p class="text-sm text-gray-500">
                                    Qty: {{ $item->quantity }} × ${{ number_format($item->product->price) }}
                                </p>
                            </div>

                            <div class="font-bold text-[#a05a1c]">
                                ${{ number_format($item->product->price * $item->quantity) }}
                            </div>

                        </div>
                    @endforeach

                    <div class="pt-5 mt-5 border-t border-gray-200">
                        <div class="flex justify-between text-lg font-bold">
                            <span class="text-[#5A3E2B]">Total</span>
                            <span class="text-[#a05a1c]"> {{ $cart->total() }}
                                $<span id="totalPrice"></span>
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <a href="{{ route('frontend.cart.index') }}" id="CancelPurchase"
                            class="mt-6 text-center w-full ms-3 bg-[#fbefe9] text-[#8b4e18]  hover:bg-[#8b4e18] hover:text-[#fbefe9] py-3 rounded-lg font-semibold transition shadow-sm">
                            Back to cart
                        </a>
                        <a href="{{ route('frontend.index') }}" id="CancelPurchase"
                            class="mt-6 text-center w-full ms-3 bg-[#fbefe9] text-[#8b4e18]  hover:bg-[#8b4e18] hover:text-[#fbefe9] py-3 rounded-lg font-semibold transition shadow-sm">
                            Cancel Purchase
                        </a>

                    </div>


                </div>



            </section>
        </div>
    </main>
@endsection
