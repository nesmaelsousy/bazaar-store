<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bazaar Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    

    @vite(['resources/css/app.css'])
    @stack('css')

</head>

<body class="bg-[#ffffff]">
    <header>
        <nav class="bg-white shadow-md fixed top-0 w-full z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 py-2 flex justify-between items-center">
                <div class="flex items-center shrink-0">
                    <img src="{{ asset('frontend/images/General-Images/logo.png') }}" alt="Bazaar-Logo"
                        class="w-auto h-16 md:h-20 object-contain hover:scale-105 transition duration-300">
                </div>

                <ul id="menu-items"
                    class="hidden flex-col gap-4 w-full bg-[#F7EEE9] shadow-md absolute top-20 left-0 px-6 py-5 text-[#875E43] font-medium rounded-2xl overflow-hidden md:flex md:flex-row md:gap-8 md:static md:w-auto md:bg-transparent md:shadow-none md:px-0 md:py-0 md:rounded-none">
                    <li><a href="{{ route('frontend.index') }}"
                            class="block py-2 whitespace-nowrap hover:text-[#E6B693] transition duration-300">Home</a>
                    </li>
                    <li><a href="{{ route('frontend.about') }}"
                            class="block py-2 whitespace-nowrap hover:text-[#E6B693] transition duration-300">About
                            Us</a></li>
                    <li><a href="{{ route('frontend.categories.index') }}"
                            class="block py-2 whitespace-nowrap hover:text-[#E6B693] transition duration-300">Categories</a>
                    </li>
                    <li><a href="{{ route('frontend.artisans') }}"
                            class="block py-2 whitespace-nowrap hover:text-[#E6B693] transition duration-300">Artisans</a>
                    </li>
                    <li><a href="{{ route('frontend.workshops') }}"
                            class="block py-2 whitespace-nowrap hover:text-[#E6B693] transition duration-300">Workshops</a>
                    </li>
                    <li><a href="{{ route('frontend.contact') }}"
                            class="block py-2 whitespace-nowrap hover:text-[#E6B693] transition duration-300">Contact
                            Us</a></li>
                </ul>

                <div class="flex items-center gap-3 md:gap-5 shrink-0">
                    <button id="menu-btn" class="md:hidden text-xl text-[#875E43]">
                        <i id="menu-icon" class="fa-solid fa-bars"></i></button>

                    @include('components.notification-bell-blade')


                    <a href="{{ route('frontend.cart.index') }}"
                        class="relative text-xl text-[#875E43] hover:text-[#E6B693] transition duration-300 group {{ request()->routeIs('login') ? 'hidden' : '' }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span id="cart-count"
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 flex justify-center items-center rounded-full transition-all duration-300 group-hover:-translate-y-1">
                            {{ $count }}</span>
                    </a>



                    @auth


                        <div class="relative group">
                            <button id="userMenuBtn"
                                class="flex items-center gap-2 px-2 md:px-3 py-1.5 rounded-full hover:bg-[#F7EEE9] transition duration-300">
                                <div class="w-8 h-8 md:w-9 md:h-9 rounded-full overflow-hidden border-2 border-[#EB8F42]">
                                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('backend/image/avatar.jpg') }}"
                                        alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                </div>
                                <span
                                    class="text-sm font-medium text-[#835837] hidden md:inline-block max-w-[100px] lg:max-w-[150px] truncate">{{ Auth::user()->name }}</span>
                                <i
                                    class="fa-solid fa-chevron-down text-xs text-[#835837] hidden md:inline-block transition-transform duration-300 group-hover:rotate-180"></i>
                            </button>

                            <div
                                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="px-4 py-3 border-b border-[#f3e6dc]">
                                    <p class="text-sm font-medium text-[#835837] truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-[#9A7F73] truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <a href="{{ auth()->user()->role === 'craftsmen' ? route('craftsmen.profile.index') : route('client.profile.edit') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-[#835837] hover:bg-[#F7EEE9] transition">
                                    <i class="fa-regular fa-user w-4"></i>
                                    <span>My Profile</span>
                                </a>
                                <a href="{{ route('frontend.orders.index') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-[#835837] hover:bg-[#F7EEE9] transition">
                                    <i class="fa-regular fa-rectangle-list w-4"></i>
                                    <span>My Orders</span>
                                </a>
                                <a href="{{ route('frontend.favorites.index') }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-[#835837] hover:bg-[#F7EEE9] transition">
                                    <i class="fa-regular fa-heart w-4"></i>
                                    <span>My Favorites</span>
                                </a>
                                <hr class="my-1 border-[#f3e6dc]">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-[#F7EEE9] transition">
                                        <i class="fa-solid fa-arrow-right-to-bracket w-4"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-[#5D2A11] bg-white px-5 md:px-6 py-2 rounded-full inline-flex items-center justify-center font-medium transition duration-300 hover:bg-[#EB8F42] hover:text-white {{ request()->routeIs('login') ? 'hidden' : '' }}">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    <footer class="bg-[#8B5E3C] text-white pt-12 pb-6">
        <div class="max-w-7xl px-8 md:px-14 mx-auto grid grid-cols-1 md:grid-cols-[1.1fr_0.5fr_0.5fr_1.1fr] gap-6">
            <div>
                <img src="{{ asset('frontend/images/General-Images/logo2.png/') }}" alt="Bazaar Logo"
                    class="w-44 mb-2">
                <p class="text-sm text-[#e5d3c5] capitalize leading-relaxed">Platform to support local artisans and
                    showcase their handmade products.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4 border-b-2 border-[#c8a98d] inline-block pb-1">Quick Links</h3>
                <ul class="space-y-2 text-sm text-[#e5d3c5]">
                    <li><a href="{{ route('frontend.index') }}" class="hover:text-white"><i
                                class="fa-solid fa-chevron-right"></i> Home</a></li>
                    <li><a href="{{ route('frontend.categories.index') }}" class="hover:text-white"><i
                                class="fa-solid fa-chevron-right"></i>
                            Categories</a></li>
                    <li><a href="{{ route('frontend.artisans') }}" class="hover:text-white"><i
                                class="fa-solid fa-chevron-right"></i>
                            Artisans</a></li>
                    <li><a href="{{ route('frontend.workshops') }}" class="hover:text-white"><i
                                class="fa-solid fa-chevron-right"></i>
                            Workshops</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4 border-b-2 border-[#c8a98d] inline-block pb-1">Support</h3>
                <ul class="space-y-2 text-sm text-[#e5d3c5]">
                    <li><a href="{{ route('frontend.about') }}" class="hover:text-white"><i
                                class="fa-solid fa-chevron-right"></i> About
                            Us</a></li>
                    <li><a href="{{ route('frontend.contact') }}" class="hover:text-white"><i class="fa-solid fa-chevron-right"></i>
                            Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4 border-b-2 border-[#c8a98d] inline-block pb-1">Newsletter</h3>
                <input id="emailInput" type="email" placeholder="Enter Your Email"
                    class="w-full mb-3 px-4 py-2 rounded-md text-black outline-none">
                <button id="subscribeBtn"
                    class="w-full bg-[#e5d3c5] text-[#835837] font-bold px-4 py-2 rounded-md transition hover:bg-white focus:ring-2 focus:ring-[#c8a98d]">Subscribe</button>
                <p id="message" class="text-md mt-2 hidden"></p>
                <div class="flex gap-3 mt-4 text-xl text-[#e5d3c5]">

                    @if (setting('facebook'))
                        <a href="{{ setting('facebook') }}" target="_blank">
                            <i class="fa-brands fa-facebook transition hover:scale-110 hover:text-white"></i>
                        </a>
                    @endif



                    @if (setting('instagram'))
                        <a href="{{ setting('instagram') }}" target="_blank">
                            <i class="fa-brands fa-instagram transition hover:scale-110 hover:text-white"></i>
                        </a>
                    @endif





                    @if (setting('whatsapp'))
                        <a href="{{ setting('whatsapp') }}" target="_blank">
                            <i class="fa-brands fa-whatsapp transition hover:scale-110 hover:text-white"></i>
                        </a>
                    @endif

                </div>

            </div>
        </div>
        <div class="border-t border-[#c8a98d] mt-10 pt-2 text-center text-sm text-[#e5d3c5]">© 2026 Bazaar Store. All
            Rights Reserved.</div>
    </footer>
    <div id="toast"
        class="fixed bottom-5 right-5 bg-[#E6B693] text-white text-lg font-semibold px-4 py-2 rounded-lg shadow-lg opacity-0 transition duration-300">
        Added To Cart <i class="fa-solid fa-check text-green-500"></i></div>

    <script src="{{ asset('frontend/js/script.js') }}"></script>
    <script src="{{ asset('frontend/js/auth.js') }}"></script>
    <script src="{{ asset('frontend/js/home-workshops.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')

</body>

</html>
