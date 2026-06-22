@extends('master')
@section('content')
    <main class="pt-20">
        <section class="bg-[#F7EEE9] py-16 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-[#835837] mb-4">Contact Us</h1>
            <p class="font-semibold text-[#9A7F73] capitalize">We’re here to help you. Get in touch with us anytime.</p>
        </section>
        <section class="py-14">
            <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10">
                <div class="bg-white rounded-2xl shadow-2xl p-8">
                    <h2 class="text-2xl font-bold text-[#835837] mb-5">Get In Touch</h2>
                    <div class="font-medium text-left mb-5">
                        <p class="text-[#835837] mb-1"><i class="fa-solid fa-phone mr-1"></i> Direct Communication:</p>
                        @if (setting('site_phone'))
                            <p class="text-[#9A7F73] text-sm ml-6 capitalize">Contact the support team by
                                phone:<br>{{ setting('site_phone') }}</p>
                        @endif

                    </div>
                    <div class="font-medium text-left mb-5">
                        <p class="text-[#835837] mb-1"><i class="fa-solid fa-envelope mr-1"></i> Email:</p>
                        @if (setting('site_email'))
                            <p class="text-[#9A7F73] text-sm ml-6 capitalize">Send us your inquiry:<br>

                                {{ setting('site_email') }}
                            </p>
                        @endif
                    </div>
                    <div class="font-medium text-left mb-5">
                        <p class="text-[#835837] mb-1"><i class="fa-solid fa-at mr-1"></i> Social Media:</p>

                        <div class="flex gap-3 text-xl ml-6">
                            @if (setting('facebook'))
                                <a href="{{ setting('facebook') }}" target="_blank"><i
                                        class="fa-brands fa-facebook text-blue-600 hover:scale-110 transition"></i></a>
                            @endif
                            @if (setting('whatsapp'))
                                <a href="{{ setting('whatsapp') }}" target="_blank"><i
                                        class="fa-brands fa-whatsapp text-green-600 hover:scale-110 transition"></i></a>
                            @endif
                            @if (setting('instagram'))
                                <a href=""{{ setting('instagram') }} target="_blank"><i
                                        class="fa-brands fa-instagram text-pink-600 hover:scale-110 transition"></i></a>
                            @endif
                        </div>
                    </div>
                    <p class="font-medium text-sm text-[#835837] text-center capitalize mt-6">We’ll be happy to respond to
                        you as soon as possible!</p>
                </div>
                <div class="bg-[#F7EEE9] rounded-2xl shadow-2xl p-8">
                    <h2 class="text-2xl font-bold text-[#835837] mb-5">Send Message</h2>
                    <form id="contactForm" class="space-y-4" action="{{ route('frontend.contact.send') }}" method="POST">
                        @csrf
                        <input id="name" name="fullname" type="text" placeholder="Your Name"
                            class="w-full px-3 py-2 rounded-md outline-none border border-[#e5d3c5] focus:ring-2 focus:ring-[#c8a98d]">
                        <input id="email" type="email" name="email" placeholder="Your Email"
                            class="w-full px-3 py-2 rounded-md outline-none border border-[#e5d3c5] focus:ring-2 focus:ring-[#c8a98d]">
                        <textarea id="messageInput" name="message" rows="4" placeholder="Your Message"
                            class="w-full px-3 py-2 rounded-md outline-none border border-[#e5d3c5] focus:ring-2 focus:ring-[#c8a98d]"></textarea>
                        <button type="submit"
                            class="w-full bg-[#a05a1c] text-white px-4 py-2 rounded-md hover:bg-[#6b3a12] transition">Send
                            Message</button>
                        <p id="formMessage" class="text-sm mt-2 hidden"></p>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script type="module" src="{{ asset('frontend/js/script.js') }}"></script>
    {{-- <script type="module" src="{{ asset('frontend/js/contact.js') }}"></script>    --}}
@endpush
