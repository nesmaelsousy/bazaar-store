@extends('master')

@section('content')
    <main class="pt-24 mb-20">
        <div class="relative w-full h-[350px] md:h-[500px]">
            <img src="{{ asset('frontend/images/General-Images/Payment Background.webp') }}"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
        <div id="paymentBox" class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-2xl -mt-[200px] relative z-10">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-[#a05a1c] text-xl font-bold tracking-wide flex items-center gap-2"><i
                        class="fa-solid fa-credit-card"></i> Payment Methods</h2>
                <div class="flex items-center gap-2 text-4xl">
                    <i class="fa-brands fa-cc-visa text-[#1a1f71]"></i>
                    <i class="fa-brands fa-cc-mastercard text-[#eb001b]"></i>
                </div>
            </div>
            <div id="payment-message" class="alert alert-danger hidden"></div>
            <form action="" method="post" id="payment-form">
                <div id="payment-element"> </div>

                {{-- <div>
                        <label class="block text-md font-medium text-[#5A3E2B] mb-2">Card Number</label>
                        <input id="cardNumber" maxlength="19" placeholder="1234 5678 9012 3456"
                            class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                        <p class="hidden error text-red-600 text-sm"></p>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-md font-medium text-[#5A3E2B] mb-2">Expiry Date</label>
                            <input id="expDate" maxlength="5" placeholder="MM/YY"
                                class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                            <p class="hidden error text-red-600 text-sm"></p>
                        </div>
                        <div>
                            <label class="block text-md font-medium text-[#5A3E2B] mb-2">CVV/CVC</label>
                            <input id="cvv" maxlength="4" placeholder="123"
                                class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                            <p class="hidden error text-red-600 text-sm"></p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-md font-medium text-[#5A3E2B] mb-2">Name on Card</label>
                        <input id="nameOnCard" placeholder="Enter Your Card Name"
                            class="w-full p-3 border border-[#e5d3c5] rounded-lg outline-none focus:ring-1 focus:ring-[#5A3E2B]">
                        <p class="hidden error text-red-600 text-sm"></p>
                    </div> --}}
                <button type="submit" id="submit"
                    class="w-full bg-[#a05a1c] text-white font-medium px-4 py-2 mt-5 rounded-lg transition hover:bg-[#c27a3f]">
                    <span id="button-text">Pay now</span>
                    <span id="spinner" class="hidden">Processing..</span>
                </button>


            </form>



        </div>
        <div id="successBox"
            class="hidden max-w-3xl mx-auto text-center bg-white p-10 rounded-xl shadow-2xl transition-all duration-500 -mt-[200px] relative z-10">
            <i class="fa-solid fa-circle-check text-green-500 text-5xl mb-3"></i>
            <h2 class="text-[#a05a1c] text-2xl font-bold tracking-wide mb-2">Payment Successful</h2>
            <p class="text-[#5A3E2B] font-medium mb-3">Your order has been placed successfully</p>
            <p class="text-[#a05a1c] font-bold">Order ID: #<span id="orderId"></span></p>
            <p class="text-[#5A3E2B] font-bold">Total: $<span id="totalPrice">0</span></p>
            <div class="flex justify-center gap-3 mt-6">
                <a href="index.html" class="bg-[#a05a1c] text-white px-4 py-2 rounded-lg hover:bg-[#c27a3f]">Back To
                    Home</a>
                <a href="categories.html" class="border border-[#a05a1c] text-[#a05a1c] px-4 py-2 rounded-lg">Continue
                    Shopping</a>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/dahlia/stripe.js"></script>

    <script>
        // This is your test publishable API key.
        const stripe = Stripe("{{ config('services.stripe.publishable_key') }}");

        // The items the customer wants to buy
        // const items = [{
        //     id: "xl-tshirt",
        //     amount: 1000
        // }];

        let elements;

        initialize();

        document
            .querySelector("#payment-form")
            .addEventListener("submit", handleSubmit);

        // Fetches a payment intent and captures the client secret
       async function initialize() {

    const response = await fetch("{{ route('frontend.stripe.paymentIntent.create', $order->id) }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        }
    });

    const text = await response.text();
    console.log("RAW RESPONSE:", text);

    const data = JSON.parse(text);

    const clientSecret = data.clientSecret;

    elements = stripe.elements({
        clientSecret
    });

    const paymentElement = elements.create("payment");
    paymentElement.mount("#payment-element");
}
        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    // Make sure to change this to your payment completion page
                    return_url: "{{ route('frontend.stripe.return', $order->id) }}",
                },
            });

            // This point will only be reached if there is an immediate error when
            // confirming the payment. Otherwise, your customer will be redirected to
            // your `return_url`. For some payment methods like iDEAL, your customer will
            // be redirected to an intermediate site first to authorize the payment, then
            // redirected to the `return_url`.
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);
        }

        // ------- UI helpers -------

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageContainer.textContent = "";
            }, 4000);
        }

        // Show a spinner on payment submission
        function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        }
    </script>
@endpush
