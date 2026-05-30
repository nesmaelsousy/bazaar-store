<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazaar Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#ffffff]">
    <header>
        <nav class="bg-white shadow-md fixed top-0 w-full z-50">
            <div class="max-w-5xl mx-auto px-6 py-2 flex justify-between items-center">
                <div class="flex items-center">
                    <img src="{{ asset('frontend/images/General-Images/logo.png') }}" alt="Bazaar-Logo" class="w-auto h-20 object-contain hover:scale-105 transition duration-300">
                </div>
                <ul id="menu-items" class="hidden flex-col gap-4 w-full bg-[#F7EEE9] shadow-md absolute top-24 left-0 px-4 py-4 text-[#875E43] font-medium rounded-2xl overflow-hidden md:flex md:flex-row md:gap-9 md:static md:w-auto md:bg-transparent md:shadow-none md:px-0 md:py-0 md:rounded-none">
                    <li><a href="{{ route('frontend.index') }}" class="block py-2 hover:text-[#E6B693] transition duration-300">Home</a></li>
                    <li><a href="about.html" class="block py-2 hover:text-[#E6B693] transition duration-300">About Us</a></li>
                    <li><a href="categories.html" class="block py-2 hover:text-[#E6B693] transition duration-300">Categories</a></li>
                    <li><a href="artisans.html" class="block py-2 hover:text-[#E6B693] transition duration-300">Artisans</a></li>
                    <li><a href="workshops.html" class="block py-2 hover:text-[#E6B693] transition duration-300">Workshops</a></li>
                    <li><a href="contact.html" class="block py-2 hover:text-[#E6B693] transition duration-300">Contact Us</a></li>
                </ul>
                <div class="flex items-center gap-4">
                    <button id="menu-btn" class="md:hidden text-lg text-[#875E43]"><i id="menu-icon" class="fa-solid fa-bars"></i></button>
                    <a href="favorites.html" class="text-lg text-[#875E43] hover:text-[#E6B693] transition duration-300"><i class="fa-regular fa-heart"></i></a>
                    <a href="{{ route('frontend.cart.index') }}" class="relative text-lg text-[#875E43] hover:text-[#E6B693] transition duration-300 group">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 flex justify-center items-center rounded-full transition-all duration-300 group-hover:-translate-y-1">{{$cartCount}}</span>
                    </a>
                    @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-lg text-[#875E43] hover:text-[#E6B693] transition duration-300">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </button>
                    </form>
                    @endauth
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    <footer class="bg-[#8B5E3C] text-white pt-12 pb-6">
        <div class="max-w-7xl px-8 md:px-14 mx-auto grid grid-cols-1 md:grid-cols-[1.1fr_0.5fr_0.5fr_1.1fr] gap-6">
            <div>
                <img src="{{ asset('frontend/images/General-Images/logo2.png/') }}" alt="Bazaar Logo" class="w-44 mb-2">
                <p class="text-sm text-[#e5d3c5] capitalize leading-relaxed">Platform to support local artisans and showcase their handmade products.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4 border-b-2 border-[#c8a98d] inline-block pb-1">Quick Links</h3>
                <ul class="space-y-2 text-sm text-[#e5d3c5]">
                    <li><a href="{{ route('frontend.index') }}" class="hover:text-white"><i class="fa-solid fa-chevron-right"></i> Home</a></li>
                    <li><a href="categories.html" class="hover:text-white"><i class="fa-solid fa-chevron-right"></i> Categories</a></li>
                    <li><a href="artisans.html" class="hover:text-white"><i class="fa-solid fa-chevron-right"></i> Artisans</a></li>
                    <li><a href="workshops.html" class="hover:text-white"><i class="fa-solid fa-chevron-right"></i> Workshops</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4 border-b-2 border-[#c8a98d] inline-block pb-1">Support</h3>
                <ul class="space-y-2 text-sm text-[#e5d3c5]">
                    <li><a href="about.html" class="hover:text-white"><i class="fa-solid fa-chevron-right"></i> About Us</a></li>
                    <li><a href="contact.html" class="hover:text-white"><i class="fa-solid fa-chevron-right"></i> Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4 border-b-2 border-[#c8a98d] inline-block pb-1">Newsletter</h3>
                <input id="emailInput" type="email" placeholder="Enter Your Email" class="w-full mb-3 px-4 py-2 rounded-md text-black outline-none">
                <button id="subscribeBtn" class="w-full bg-[#e5d3c5] text-[#835837] font-bold px-4 py-2 rounded-md transition hover:bg-white focus:ring-2 focus:ring-[#c8a98d]">Subscribe</button>
                <p id="message" class="text-md mt-2 hidden"></p>
                <div class="flex gap-3 mt-4 text-xl text-[#e5d3c5]">
                    <a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-facebook transition hover:scale-110 hover:text-white"></i></a>
                    <a href="https://web.whatsapp.com" target="_blank"><i class="fa-brands fa-whatsapp transition hover:scale-110 hover:text-white"></i></a>
                    <a href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram transition hover:scale-110 hover:text-white"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-[#c8a98d] mt-10 pt-2 text-center text-sm text-[#e5d3c5]">© 2026 Bazaar Store. All Rights Reserved.</div>
    </footer>
    <div id="toast" class="fixed bottom-5 right-5 bg-[#E6B693] text-white text-lg font-semibold px-4 py-2 rounded-lg shadow-lg opacity-0 transition duration-300">Added To Cart <i class="fa-solid fa-check text-green-500"></i></div>
    @stack('scripts')
</body>

</html>