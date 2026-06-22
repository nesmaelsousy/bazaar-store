@extends('master')
@section('content')
    <main class="bg-[#F9F5F1] min-h-screen pt-36 pb-20">
        <section class="max-w-5xl mx-auto px-4">
            <div class="relative mb-8">
                <div class="absolute -top-4 left-0 w-24 h-1 bg-[#835837] rounded-full"></div>
                <h1 class="text-4xl md:text-3xl font-bold text-[#835837] tracking-wide">
                    {{ $user->name }}
                </h1>
                <p class="text-[#9B6B4A] mt-2 text-sm tracking-wide">Manage your account and preferences</p>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="relative">
                        <div
                            class="w-28 h-28 bg-[#F7EEE9] flex justify-center items-center rounded-full shadow-md border-4 border-[#F4E7DD] overflow-hidden">
                            @if (Auth::user()->image)
                                {{-- {{ dd(Auth::user()->image) }} --}}
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" class="w-full h-full ">
                            @else
                                <i class="fa-solid fa-user text-5xl text-[#9B6B4A]"></i>
                            @endif
                        </div>


                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h2 id="artisanName" class="text-2xl text-[#835837] font-bold"> {{ $user->name }}</h2>
                        <p id="artisanEmail" class="text-lg text-[#9B6B4A] mt-1">{{ $user->email }}</p>
                        <p class="text-sm text-[#9B6B4A] mt-1">
                            <i class="fa-solid fa-location-dot mr-1"></i> {{ $user->address }}
                        </p>
                        <div class="flex gap-2 mt-3 justify-center md:justify-start">
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                <i class="fa-solid fa-circle mr-1 text-xs"></i>{{ $user->status }}
                            </span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">
                                <i class="fa-solid fa-star mr-1"></i>Rating: {{ round($avgReview, 2) }}/5
                            </span>
                        </div>
                    </div>
                    <button id="editProfileBtn"
                        class="bg-[#875E43] rounded-xl text-white px-6 py-3 hover:bg-[#9B6B4A] transition">
                        <i class="fa-solid fa-pen mr-1"></i>Edit Profile
                    </button>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-gray-600 text-sm">{{ $user->bio ?? 'updat your bio' }}</p>
                </div>
            </div>

            <!-- Dashboard Tabs -->
            <!-- Dashboard Tabs -->
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                <button data-tab="products"
                    class="dashboard-tab bg-white p-5 text-left rounded-2xl shadow-md transition hover:bg-[#F4E7DD] active-tab">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[#9B6B4A] font-semibold">Products</p>
                            <p class="text-[#835837] text-2xl font-bold">{{ $user->products->count() }}</p>
                        </div>
                        <i class="fa-solid fa-store text-3xl text-[#9B6B4A] opacity-50"></i>
                    </div>
                </button>
                <button data-tab="orders"
                    class="dashboard-tab bg-white p-5 text-left rounded-2xl shadow-md transition hover:bg-[#F4E7DD]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[#9B6B4A] font-semibold">Orders</p>
                            <p class="text-[#835837] text-2xl font-bold">{{ $user->sellerOrders->count() }}</p>
                        </div>
                        <i class="fa-solid fa-truck text-3xl text-[#9B6B4A] opacity-50"></i>
                    </div>
                </button>
                <button data-tab="analytics"
                    class="dashboard-tab bg-white p-5 text-left rounded-2xl shadow-md transition hover:bg-[#F4E7DD]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[#9B6B4A] font-semibold">Analytics</p>
                            <p class="text-[#835837] text-2xl font-bold">${{ $orderTotal }}</p>
                        </div>
                        <i class="fa-solid fa-chart-line text-3xl text-[#9B6B4A] opacity-50"></i>
                    </div>
                </button>
            </div>

            <!-- Products Section -->
            @include('profile.craftsmen.product')

            <!-- Orders Section -->
            @include('profile.craftsmen.order')

            <!-- Analytics Section -->
            <section id="analyticsSection" class="dashboard-section hidden">
                <h2 class="text-2xl text-[#835837] font-bold mb-6 flex items-center gap-3">
                    <span class="w-1 h-8 bg-[#835837] rounded-full"></span>
                    Analytics Overview
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Left Card: Sales Analytics --}}
                    <div
                        class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 space-y-6 border border-[#f3e7df]">

                        {{-- Top Selling Product --}}
                        <div class="group">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-1 h-6 bg-[#835837] rounded-full"></div>
                                <h3 class="text-[#835837] font-semibold text-sm uppercase tracking-wider">Top Selling
                                    Product</h3>
                            </div>

                            <div
                                class="bg-[#faf6f3] rounded-xl p-4 border border-[#f3e7df] hover:border-[#835837] hover:bg-white transition-all duration-200">
                                <p class="text-[#835837] text-lg font-bold">
                                    {{ $topProduct->title ?? 'No Data Available' }}
                                </p>
                                <div class="flex items-center gap-2 mt-2">
                                    <svg class="w-4 h-4 text-[#835837]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm text-gray-600 font-medium">{{ $soldThisMonth }} units sold this
                                        month</p>
                                </div>
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-[#f3e7df]"></div>

                        {{-- Total Sales --}}
                        <div class="group">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-1 h-6 bg-[#835837] rounded-full"></div>
                                <h3 class="text-[#835837] font-semibold text-sm uppercase tracking-wider">Total Sales (All
                                    Time)</h3>
                            </div>

                            <div
                                class="bg-gradient-to-br from-[#faf6f3] to-white rounded-xl p-4 border border-[#f3e7df] hover:border-[#835837] transition-all duration-200">
                                <p class="text-[#835837] text-3xl font-bold">${{ $orderTotal }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    <p class="text-sm font-semibold text-green-600">↑ {{ $percentage }}% from last month
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Card: Store Info --}}
                    <div
                        class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-[#f3e7df] space-y-6">

                        {{-- Store Rating --}}
                        <div class="group">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-1 h-6 bg-[#835837] rounded-full"></div>
                                <h3 class="text-[#835837] font-semibold text-sm uppercase tracking-wider">Store Rating</h3>
                            </div>

                            <div
                                class="bg-gradient-to-br from-[#faf6f3] to-white rounded-xl p-4 border border-[#f3e7df] hover:border-[#835837] transition-all duration-200">
                                <div class="flex items-center gap-3">
                                    {{-- Stars using SVGs instead of FontAwesome --}}
                                    <div class="flex gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $avgReview)
                                                <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-gray-300 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-[#835837] font-bold text-lg">{{ round($avgReview, 1) }}/5</span>
                                    <span class="text-sm text-gray-500">({{ $totalReviews ?? 0 }} reviews)</span>
                                </div>

                                {{-- Rating progress bar --}}
                                <div class="mt-3 w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-yellow-400 h-1.5 rounded-full transition-all duration-500"
                                        style="width: {{ ($avgReview / 5) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-[#f3e7df]"></div>

                        {{-- Store Status --}}
                        <div class="group">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-1 h-6 bg-[#835837] rounded-full"></div>
                                <h3 class="text-[#835837] font-semibold text-sm uppercase tracking-wider">Store Status</h3>
                            </div>

                            <div
                                class="bg-[#faf6f3] rounded-xl p-4 border border-[#f3e7df] hover:border-[#835837] transition-all duration-200">
                                <div class="flex items-center gap-3">
                                    {{-- Status indicator dot --}}
                                    <span class="flex h-3 w-3 relative">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                    </span>
                                    <span
                                        class="px-4 py-1.5 rounded-full text-sm font-medium 
                            @if ($user->status == 'active') bg-green-100 text-green-700
                            @elseif($user->status == 'inactive') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst($user->status) }}
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <!-- Edit Profile Modal -->
    @include('profile.craftsmen.info-craftsmen')


    

    {{-- <style>
        .dashboard-section {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dashboard-tab.active-tab {
            background-color: #F4E7DD;
            border: 2px solid #835837;
        }

        .dashboard-tab {
            transition: all 0.3s ease;
        }

        .dashboard-tab:hover {
            transform: translateY(-2px);
        }

        .message-card {
            transition: all 0.3s ease;
        }

        .message-card:hover {
            transform: translateX(5px);
        }

        #visitsProgress {
            transition: width 0.5s ease-in-out;
        }

        .modal-open {
            overflow: hidden;
        }
    </style> --}}
@endsection

@push('scripts')
    
    <script>
        // Tab switching functionality
        const tabs = document.querySelectorAll('.dashboard-tab');
        const sections = {
            products: document.getElementById('productsSection'),
            orders: document.getElementById('ordersSection'),
            analytics: document.getElementById('analyticsSection')
        };

        function switchTab(tabName) {
            Object.values(sections).forEach(section => {
                if (section) section.classList.add('hidden');
            });

            if (sections[tabName]) {
                sections[tabName].classList.remove('hidden');
            }

            tabs.forEach(tab => {
                if (tab.dataset.tab === tabName) {
                    tab.classList.add('active-tab');
                } else {
                    tab.classList.remove('active-tab');
                }
            });
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabName = tab.dataset.tab;
                if (tabName && sections[tabName]) {
                    switchTab(tabName);
                }
            });
        });



        // Edit profile modal
        const editProfileModal = document.getElementById('editProfileModal');
        const editProfileBtn = document.getElementById('editProfileBtn');

        editProfileBtn.addEventListener('click', () => {
            editProfileModal.classList.remove('hidden');
            editProfileModal.classList.add('flex');
            document.body.classList.add('modal-open');
        });

        document.getElementById('closeModalBtn').addEventListener('click', () => {
            editProfileModal.classList.add('hidden');
            document.body.classList.remove('modal-open');
        });

        document.getElementById('cancelModalBtn').addEventListener('click', () => {
            editProfileModal.classList.add('hidden');
            document.body.classList.remove('modal-open');
        });

        // Search products
        document.getElementById('searchProduct').addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                const title = product.querySelector('h3').innerText.toLowerCase();
                if (title.includes(searchTerm)) {
                    product.style.display = '';
                } else {
                    product.style.display = 'none';
                }
            });
        });

     
     
    </script>
    
@endpush
