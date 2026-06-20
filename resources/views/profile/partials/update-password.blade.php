<div id="passwordModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4"
    onclick="if(event.target===this) closePasswordModal()">
    <div class="bg-white rounded-2xl max-w-md w-full">
        <div class="bg-[#835837] px-6 py-4 rounded-t-2xl flex justify-between items-center">
            <h3 class="text-white font-medium tracking-wide">CHANGE PASSWORD</h3>
            <button onclick="closePasswordModal()" class="text-white text-2xl hover:text-gray-200">&times;</button>
        </div>
        <form action="{{ route('password.update') }}" method="POST" class="p-6">
            @csrf @method('PUT')
            <div class="space-y-3">
                <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Current
                        Password</label><input type="password" name="current_password" required
                        class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>
                <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">New
                        Password</label><input type="password" name="password" required
                        class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>
                <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Confirm
                        Password</label><input type="password" name="password_confirmation" required
                        class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
                <button type="submit"
                    class="w-full bg-[#875E43] text-white py-2.5 rounded-lg hover:bg-[#9B6B4A] transition mt-2">Update
                    Password</button>
            </div>
        </form>
    </div>
</div>
