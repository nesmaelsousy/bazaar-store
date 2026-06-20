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
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
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
                            <p class="text-[#835837] text-2xl font-bold">
                                {{ $user->sellerOrders->count() }}</p>
                        </div>
                        <i class="fa-solid fa-truck text-3xl text-[#9B6B4A] opacity-50"></i>
                    </div>
                </button>
                <button data-tab="messages"
                    class="dashboard-tab bg-white p-5 text-left rounded-2xl shadow-md transition hover:bg-[#F4E7DD]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[#9B6B4A] font-semibold">Messages</p>
                            <p class="text-[#835837] text-2xl font-bold">23</p>
                        </div>
                        <i class="fa-solid fa-envelope text-3xl text-[#9B6B4A] opacity-50"></i>
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


            <!-- Messages Section -->
            <section id="messagesSection" class="dashboard-section hidden">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl text-[#835837] font-bold">Messages</h2>
                    <div class="flex gap-2">
                        <button id="markAllRead"
                            class="text-[#9B6B4A] hover:text-[#835837] transition text-sm px-3 py-1 rounded-lg">
                            <i class="fa-regular fa-circle-check mr-1"></i>Mark all read
                        </button>
                    </div>
                </div>
                <div id="messagesContainer" class="space-y-4">
                    <div
                        class="message-card bg-[#FFF8F0] rounded-2xl shadow-md p-5 hover:shadow-lg transition border-l-4 border-[#835837]">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-bold text-[#835837] text-lg">Sarah Johnson</h3>
                                    <span class="px-2 py-0.5 bg-red-100 text-red-600 rounded-full text-xs">New</span>
                                </div>
                                <p class="text-sm text-[#9B6B4A]">sarah.j@email.com</p>
                            </div>
                            <span class="text-xs text-gray-500">2 hours ago</span>
                        </div>
                        <p class="mt-3 text-gray-700">Hi! I love your ceramic vase collection. Do you offer custom colors?
                        </p>
                        <div class="mt-3 flex gap-2">
                            <button
                                class="reply-msg bg-[#835837] text-white px-4 py-1 rounded-lg text-sm hover:bg-[#9B6B4A] transition"
                                data-msg-id="1" data-msg-name="Sarah Johnson">
                                <i class="fa-solid fa-reply mr-1"></i>Reply
                            </button>
                            <button
                                class="mark-read text-gray-600 px-4 py-1 rounded-lg text-sm hover:bg-gray-100 transition"
                                data-msg-id="1">
                                <i class="fa-regular fa-circle-check mr-1"></i>Mark as read
                            </button>
                        </div>
                    </div>

                    <div class="message-card bg-white rounded-2xl shadow-md p-5 hover:shadow-lg transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="font-bold text-[#835837] text-lg">David Martinez</h3>
                                <p class="text-sm text-[#9B6B4A]">david.m@email.com</p>
                            </div>
                            <span class="text-xs text-gray-500">Yesterday</span>
                        </div>
                        <p class="mt-3 text-gray-700">I received my clay mugs yesterday. They're absolutely beautiful!
                            Thank you for the fast shipping.</p>
                        <div class="mt-3 flex gap-2">
                            <button
                                class="reply-msg bg-[#835837] text-white px-4 py-1 rounded-lg text-sm hover:bg-[#9B6B4A] transition"
                                data-msg-id="2" data-msg-name="David Martinez">
                                <i class="fa-solid fa-reply mr-1"></i>Reply
                            </button>
                            <button
                                class="mark-read text-gray-600 px-4 py-1 rounded-lg text-sm hover:bg-gray-100 transition"
                                data-msg-id="2" disabled>
                                <i class="fa-regular fa-circle-check mr-1"></i>Read
                            </button>
                        </div>
                    </div>

                    <div
                        class="message-card bg-[#FFF8F0] rounded-2xl shadow-md p-5 hover:shadow-lg transition border-l-4 border-[#835837]">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-bold text-[#835837] text-lg">Lisa Anderson</h3>
                                    <span class="px-2 py-0.5 bg-red-100 text-red-600 rounded-full text-xs">New</span>
                                </div>
                                <p class="text-sm text-[#9B6B4A]">lisa.a@email.com</p>
                            </div>
                            <span class="text-xs text-gray-500">3 days ago</span>
                        </div>
                        <p class="mt-3 text-gray-700">Question about bulk ordering - I'm interested in purchasing 20 tea
                            sets for my restaurant. Is that possible?</p>
                        <div class="mt-3 flex gap-2">
                            <button
                                class="reply-msg bg-[#835837] text-white px-4 py-1 rounded-lg text-sm hover:bg-[#9B6B4A] transition"
                                data-msg-id="3" data-msg-name="Lisa Anderson">
                                <i class="fa-solid fa-reply mr-1"></i>Reply
                            </button>
                            <button
                                class="mark-read text-gray-600 px-4 py-1 rounded-lg text-sm hover:bg-gray-100 transition"
                                data-msg-id="3">
                                <i class="fa-regular fa-circle-check mr-1"></i>Mark as read
                            </button>
                        </div>
                    </div>
                </div>
            </section>

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


    <!-- Reply Message Modal -->
    <div id="replyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl w-full max-w-md mx-4 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-[#835837]">Reply to <span id="replyToName"></span></h3>
                <button id="closeReplyModalBtn" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <form id="replyForm">
                <div class="mb-4">
                    <label class="block text-[#835837] mb-2">Your Reply</label>
                    <textarea id="replyMessage" rows="4" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#835837]"
                        placeholder="Type your reply here..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-[#835837] text-white py-2 rounded-xl hover:bg-[#9B6B4A] transition">Send
                        Reply</button>
                    <button type="button" id="cancelReplyModalBtn"
                        class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-xl hover:bg-gray-300 transition">Cancel</button>
                </div>
            </form>
        </div>
    </div>

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
    <script src="{{ asset('frontend/js/artisan-dashboard.js') }}"></script>
    <script>
        // Tab switching functionality
        const tabs = document.querySelectorAll('.dashboard-tab');
        const sections = {
            products: document.getElementById('productsSection'),
            orders: document.getElementById('ordersSection'),
            messages: document.getElementById('messagesSection'),
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

        // Animate visits progress bar
        setTimeout(() => {
            const visitsProgress = document.getElementById('visitsProgress');
            if (visitsProgress) {
                visitsProgress.style.width = '84.7%';
            }
        }, 100);

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

        // document.getElementById('profileForm').addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     document.getElementById('artisanName').innerText = document.getElementById('profileName').value;
        //     document.querySelector('#artisanEmail').innerText = document.getElementById('profileEmail').value;
        //     document.querySelector('#artisanPhone').innerHTML = '<i class="fa-solid fa-phone mr-1"></i>' + document
        //         .getElementById('profilePhone').value;
        //     document.querySelector('.text-gray-600.text-sm').innerText = document.getElementById('profileBio')
        //         .value;
        //     editProfileModal.classList.add('hidden');
        //     document.body.classList.remove('modal-open');
        //     alert('Profile updated successfully!');
        // });

        // Reply modal
        const replyModal = document.getElementById('replyModal');
        let currentReplyName = '';

        document.querySelectorAll('.reply-msg').forEach(btn => {
            btn.addEventListener('click', () => {
                currentReplyName = btn.dataset.msgName;
                document.getElementById('replyToName').innerText = currentReplyName;
                replyModal.classList.remove('hidden');
                replyModal.classList.add('flex');
                document.body.classList.add('modal-open');
            });
        });

        document.getElementById('closeReplyModalBtn').addEventListener('click', () => {
            replyModal.classList.add('hidden');
            document.body.classList.remove('modal-open');
        });

        document.getElementById('cancelReplyModalBtn').addEventListener('click', () => {
            replyModal.classList.add('hidden');
            document.body.classList.remove('modal-open');
        });

        document.getElementById('replyForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const reply = document.getElementById('replyMessage').value;
            alert(`Reply sent to ${currentReplyName}!\n\nYour message: ${reply}`);
            replyModal.classList.add('hidden');
            document.body.classList.remove('modal-open');
            document.getElementById('replyMessage').value = '';
        });

        // Mark as read
        document.querySelectorAll('.mark-read').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!this.disabled) {
                    const messageCard = this.closest('.message-card');
                    messageCard.classList.remove('bg-[#FFF8F0]');
                    messageCard.classList.add('bg-white');
                    messageCard.style.borderLeftColor = 'transparent';
                    const newBadge = messageCard.querySelector('.bg-red-100');
                    if (newBadge) newBadge.remove();
                    this.disabled = true;
                    this.innerHTML = '<i class="fa-regular fa-circle-check mr-1"></i>Read';
                    alert('Message marked as read');
                }
            });
        });

        // Mark all read
        document.getElementById('markAllRead').addEventListener('click', () => {
            document.querySelectorAll('.mark-read').forEach(btn => {
                if (!btn.disabled) {
                    const messageCard = btn.closest('.message-card');
                    messageCard.classList.remove('bg-[#FFF8F0]');
                    messageCard.classList.add('bg-white');
                    messageCard.style.borderLeftColor = 'transparent';
                    const newBadge = messageCard.querySelector('.bg-red-100');
                    if (newBadge) newBadge.remove();
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fa-regular fa-circle-check mr-1"></i>Read';
                }
            });
            alert('All messages marked as read');
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

        // // Add product button
        // document.addEventListener('DOMContentLoaded', function() {

        //     const openBtn = document.getElementById('addProductBtn');
        //     const modal = document.getElementById('addProductModal');
        //     const closeBtn = document.getElementById('closeModalBtnProduct');
        //     const cancelBtn = document.getElementById('cancelModalBtn');

        //     // open modal
        //     openBtn.addEventListener('click', () => {
        //         modal.classList.remove('hidden');
        //         modal.classList.add('flex');
        //     });

        //     // close modal (X button)
        //     closeBtn.addEventListener('click', () => {
        //         modal.classList.add('hidden');
        //         modal.classList.remove('flex');
        //     });

        //     // cancel button
        //     cancelBtn.addEventListener('click', () => {
        //         modal.classList.add('hidden');
        //         modal.classList.remove('flex');
        //     });

        //     // click outside modal
        //     modal.addEventListener('click', (e) => {
        //         if (e.target === modal) {
        //             modal.classList.add('hidden');
        //             modal.classList.remove('flex');
        //         }
        //     });

        // });


        // Edit product
        // document.querySelectorAll('.edit-product').forEach(btn => {
        //     btn.addEventListener('click', (e) => {
        //         const productCard = e.target.closest('.product-card');
        //         const productName = productCard.querySelector('h3').innerText;
        //         // alert(`Edit product: ${productName}`);
        //     });
        // });

        // Delete product
        document.querySelectorAll('.delete-product').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (confirm('Are you sure you want to delete this product?')) {
                    const productCard = e.target.closest('.product-card');
                    productCard.style.opacity = '0';
                    setTimeout(() => {
                        productCard.remove();
                    }, 300);
                }
            });
        });
        const openBtn = document.getElementById("openEditModal");
        const modal = document.getElementById("editModal");
        const closeBtn = document.getElementById("closeEditModal");

        openBtn.addEventListener("click", function(e) {
            e.preventDefault();
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        });

        closeBtn.addEventListener("click", function() {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        });
    </script>
@endpush
