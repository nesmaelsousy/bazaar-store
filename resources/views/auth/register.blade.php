<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="signupForm" class="space-y-4 ">
        @csrf
        <p class="statusMessage hidden mb-4 text-center font-medium"></p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="text-left">
                <label class="block text-md font-medium text-[#835837] mb-1">Full Name <span class="text-red-500">*</span></label>
                <x-text-input type="text" name="name" placeholder="Full Name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
              
            </div>
            <div class="text-left">
                <label class="block text-md font-medium text-[#835837] mb-1">User Name <span class="text-red-500">*</span></label>
                <x-text-input type="text" name="username" placeholder="User Name" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="text-left">
                <label class="block text-md font-medium text-[#835837] mb-1">Email <span class="text-red-500">*</span></label>
                <x-text-input type="email" name="email" placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="text-left">
                <label class="block text-md font-medium text-[#835837] mb-1">Phone Number <span class="text-red-500">*</span></label>
                <x-text-input type="text" name="phone" placeholder="Phone Number" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="password-wrapper relative text-left">
                <label class="block text-md font-medium text-[#835837] mb-1">Password <span class="text-red-500">*</span></label>
                <x-text-input type="password" name="password" placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <i class="fa-solid fa-eye togglePassword hidden absolute right-3 top-10 cursor-pointer text-[#835837]"></i>
              
            </div>
            <div class="password-wrapper relative text-left">
                <label class="block text-md font-medium text-[#835837] mb-1">Confirm Password <span class="text-red-500">*</span></label>
                <x-text-input type="password" name="password_confirmation" placeholder="Confirm Password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                <i class="fa-solid fa-eye togglePassword hidden absolute right-3 top-10 cursor-pointer text-[#835837]"></i>
              
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="text-left">
                <label class="block text-md font-medium text-[#835837] mb-1">Address <span class="text-red-500">*</span></label>
                <x-text-input type="text" name="address" placeholder="Address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
            <div class="text-left">
                <label class="block text-md font-medium text-[#835837] mb-1">User Type <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="role" class="appearance-none w-full px-3 py-2 text-[#835837] border border-[#e5d3c5] rounded-lg outline-none cursor-pointer focus:ring-2 focus:ring-[#c8a98d]" required>
                        <option value="" disabled selected>Select....</option>
                        <option value="craftsmen">Artisan</option>
                        <option value="client">Customer</option>
                    </select>
                    <x-input-error :messages="$errors->get('userType')" class="mt-2" />
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none"><i class="fa-solid fa-chevron-down text-[#835837] text-sm"></i></div>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-[#a05a1c] text-white py-2 rounded-md transition hover:bg-[#6b3a12]">Sign Up</button>
    </form>
</x-guest-layout>