@extends('master')
@section('content')
    <main class="bg-[#F9F5F1] min-h-screen pt-36 pb-20">

        @if ($errors->any())
            <div class="alert alert-red mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="relative mb-8">
                <div class="absolute -top-4 left-0 w-24 h-1 bg-[#835837] rounded-full"></div>
                <h1 class="text-4xl md:text-3xl font-bold text-[#835837] tracking-wide">
                    {{ $user->name }}'s Profile Overview</h1>
                <p class="text-[#9B6B4A] mt-2 text-sm tracking-wide">Manage your account and preferences</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-[#F4E7DD] overflow-hidden">
                        <div class="bg-[#835837] px-6 py-4">
                            <h2 class="text-white font-medium tracking-wide text-sm">PERSONAL INFO</h2>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-col items-center">
                                <div class="relative">
                                    <div
                                        class="w-40 h-40 bg-[#F7EEE9] flex justify-center items-center rounded-full shadow-md border-4 border-[#F4E7DD] overflow-hidden">
                                        @if (Auth::user()->image)
                                            {{-- {{ dd(Auth::user()->image) }} --}}
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="w-full h-full object-cover ">
                                        @else
                                            <i class="fa-solid fa-user text-5xl text-[#9B6B4A]"></i>
                                        @endif
                                    </div>
                                    <button onclick="document.getElementById('imageInput').click()"
                                        class="absolute bottom-0 right-0 bg-[#875E43] text-white p-1.5 rounded-full text-xs hover:bg-[#9B6B4A] transition shadow-md">
                                        <i class="fa-solid fa-camera"></i>
                                    </button>
                                    <form id="imageForm" action="{{ route('client.profile.update') }}" method="POST"
                                        enctype="multipart/form-data" class="hidden">
                                        @csrf
                                        @method('PATCH')
                                        <input type="file" id="imageInput" name="image" accept="image/*"
                                            onchange="this.form.submit()">
                                    </form>
                                </div>
                                <h2 class="text-xl text-[#835837] font-semibold mt-3 tracking-wide">{{ Auth::user()->name }}
                                </h2>
                                <p class="text-sm text-[#9B6B4A] mt-1">{{ Auth::user()->email }}</p>
                                <div class="flex gap-2 mt-2">
                                    <span
                                        class="text-xs px-2 py-1 rounded-full bg-[#F4E7DD] text-[#835837]">{{ ucfirst(Auth::user()->role) }}</span>
                                    <span
                                        class="text-xs px-2 py-1 rounded-full bg-[#F4E7DD] text-[#835837]">{{ ucfirst(Auth::user()->status) }}</span>
                                </div>
                            </div>

                            <div class="space-y-3 mt-6">
                                <div
                                    class="group hover:bg-[#F9F5F1] transition-all duration-200 border-b border-[#F4E7DD]  p-3 rounded-lg">
                                    <p class="text-xs text-[#9B6B4A] font-semibold tracking-wider uppercase">Username</p>
                                    <h3 class="text-[#835837] font-medium mt-1">{{ Auth::user()->username }}</h3>
                                </div>
                                <div
                                    class="group hover:bg-[#F9F5F1] transition-all duration-200 border-b border-[#F4E7DD] p-3 rounded-lg">
                                    <p class="text-xs text-[#9B6B4A] font-semibold tracking-wider uppercase">Email</p>
                                    <h3 class="text-[#835837] font-medium mt-1">{{ Auth::user()->email }}</h3>

                                </div>
                                <div
                                    class="group hover:bg-[#F9F5F1] transition-all duration-200 border-b border-[#F4E7DD] p-3 rounded-lg">
                                    <p class="text-xs text-[#9B6B4A] font-semibold tracking-wider uppercase">Phone Number
                                    </p>
                                    <h3 class="text-[#835837] font-medium mt-1">{{ Auth::user()->phone ?? 'Not provided' }}
                                    </h3>
                                </div>
                                {{-- <div
                                    class="group hover:bg-[#F9F5F1] transition-all duration-200 border-b border-[#F4E7DD] pb-3">
                                    <p class="text-xs text-[#9B6B4A] font-semibold tracking-wider uppercase">Slug</p>
                                    <h3 class="text-[#835837] font-medium mt-1 text-sm">{{ Auth::user()->slug }}</h3>
                                </div> --}}
                                {{-- <div
                                    class="group hover:bg-[#F9F5F1] transition-all duration-200 border-b border-[#F4E7DD] pb-3">
                                    <p class="text-xs text-[#9B6B4A] font-semibold tracking-wider uppercase">Password</p>
                                    <h3 class="text-[#835837] font-medium mt-1"></h3>
                                </div> --}}
                                <div
                                    class="group hover:bg-[#F9F5F1] transition-all duration-200 border-b border-[#F4E7DD] p-3 rounded-lg">
                                    <p class="text-xs text-[#9B6B4A] font-semibold tracking-wider uppercase">Member Since
                                    </p>
                                    <h3 class="text-[#835837] font-medium mt-1">
                                        {{ Auth::user()->created_at->format('d M Y') }}</h3>
                                </div>
                                <button onclick="openEditModal()"
                                    class="w-full mt-4 bg-[#875E43] text-white py-2.5 rounded-lg hover:bg-[#9B6B4A] transition-all duration-300 flex items-center justify-center gap-2 group">
                                    <i class="fa-solid fa-pen group-hover:rotate-12 transition"></i>
                                    <span class="tracking-wide">Edit Profile</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Priority: Bio & Address first) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- BIO - Priority 1 -->
                    {{-- <div class="bg-white rounded-2xl shadow-lg border border-[#F4E7DD] overflow-hidden">
                         <div class="bg-[#835837] px-6 py-4">
                             <div class="flex justify-between items-center">
                                 <h2 class="text-white font-medium tracking-wide text-sm">
                                     <i class="fa-regular fa-note-sticky mr-2"></i>BIO / ABOUT ME
                                 </h2>
                                 <button onclick="openBioModal()" class="w-8 h-8 rounded-lg bg-white/20 text-white hover:bg-white/30 transition flex items-center justify-center">
                                     <i class="fa-solid fa-pen text-sm"></i>
                                 </button>
                             </div>
                         </div>
                         <div class="p-6">
                             <div class="bg-[#F9F5F1] rounded-xl p-5 border border-[#F4E7DD] min-h-[120px]">
                                 @if (Auth::user()->bio)
                                     <p class="text-[#835837] text-sm leading-relaxed">{{ Auth::user()->bio }}</p>
                                 @else
                                     <p class="text-[#9B6B4A] text-sm italic">No bio available. Click edit to add a bio about yourself.</p>
                                 @endif
                             </div>
                         </div>
                     </div> --}}

                    <!-- ADDRESS - Priority 2 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-[#F4E7DD] overflow-hidden">
                        <div class="bg-[#835837] px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h2 class="text-white font-medium tracking-wide text-sm">
                                    <i class="fa-solid fa-location-dot mr-2"></i>ADDRESS
                                </h2>
                                <div class="flex gap-2">
                                    <button onclick="openAddressModal()"
                                        class="w-8 h-8 rounded-lg bg-white/20 text-white hover:bg-white/30 transition flex items-center justify-center">
                                        <i class="fa-solid fa-pen text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="bg-[#F9F5F1] rounded-xl p-5 border border-[#F4E7DD]">
                                @if (Auth::user()->address)
                                    <div class="flex items-start gap-3">
                                        <i class="fa-solid fa-location-dot text-[#835837] mt-1"></i>
                                        <p class="text-[#835837] text-sm leading-relaxed">{{ Auth::user()->address }}</p>
                                    </div>
                                @else
                                    <p class="text-[#9B6B4A] text-sm italic">No address added yet. Click edit to add your
                                        address.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Orders Table -->
                    @include('profile.client.order')

                    <!-- Favorites -->
                    @include('profile.client.favorites')

                    <!-- Security -->
                    <div class="bg-white rounded-2xl shadow-lg border border-[#F4E7DD] overflow-hidden">
                        <div class="bg-[#835837] px-6 py-4">
                            <h2 class="text-white font-medium tracking-wide text-sm">
                                <i class="fa-solid fa-key mr-2"></i>SECURITY
                            </h2>
                        </div>
                        <div class="p-6 flex justify-between items-center flex-wrap gap-4">
                            <div>
                                <p class="text-[#835837] font-medium">Change Password</p>
                                <p class="text-xs text-[#9B6B4A]">Update your password to keep your account secure</p>
                            </div>
                            <button onclick="openPasswordModal()"
                                class="px-4 py-2 border border-[#875E43] text-[#875E43] rounded-lg hover:bg-[#875E43] hover:text-white transition">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('profile.client.edit')

    {{-- <!-- Edit Profile Modal -->
    <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4"
        onclick="if(event.target===this) closeModal()">
        <div class="bg-white rounded-2xl max-w-lg w-full">
            <div class="bg-[#835837] px-6 py-4 rounded-t-2xl flex justify-between items-center">
                <h3 class="text-white font-medium tracking-wide">EDIT PROFILE</h3>
                <button onclick="closeModal()" class="text-white text-2xl hover:text-gray-200">&times;</button>
            </div>
            <form action="" method="POST" class="p-6">
                @csrf @method('PUT')
                <div class="space-y-3">
                    <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Full
                            Name</label><input type="text" name="name" value="{{ Auth::user()->name }}"
                            class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                    </div>
                    <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Username</label><input
                            type="text" name="username" value="{{ Auth::user()->username }}"
                            class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                    </div>
                    <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Email</label><input
                            type="email" name="email" value="{{ Auth::user()->email }}"
                            class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                    </div>
                    <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Phone</label><input
                            type="text" name="phone" value="{{ Auth::user()->phone }}"
                            class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                    </div>
                    <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Address</label>
                        <textarea name="address" rows="2"
                            class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">{{ Auth::user()->address }}</textarea>
                    </div>
                    <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Bio</label>
                        <textarea name="bio" rows="3"
                            class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">{{ Auth::user()->bio }}</textarea>
                    </div>
                    <div class="flex gap-3 pt-3">
                        <button type="submit"
                            class="flex-1 bg-[#875E43] text-white py-2.5 rounded-lg hover:bg-[#9B6B4A] transition">Save
                            Changes</button>
                        <button type="button" onclick="closeModal()"
                            class="flex-1 border border-[#875E43] text-[#875E43] py-2.5 rounded-lg hover:bg-[#F9F5F1] transition">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}

    <!-- Address Modal -->
    @include('profile.client.address')


    <!-- Password Modal -->
    @include('profile.partials.update-password')

    <script>
        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openAddressModal() {
            document.getElementById('addressModal').classList.remove('hidden');
            document.getElementById('addressModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeAddressModal() {
            document.getElementById('addressModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openPasswordModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
            document.getElementById('passwordModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
@endsection
