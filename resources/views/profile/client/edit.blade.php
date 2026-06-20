<!-- Edit Profile Modal -->
<div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4"
    onclick="if(event.target===this) closeModal()">
    <div class="bg-white rounded-2xl max-w-lg w-full">
        <div class="bg-[#835837] px-6 py-4 rounded-t-2xl flex justify-between items-center">
            <h3 class="text-white font-medium tracking-wide">EDIT PROFILE</h3>
            <button onclick="closeModal()" class="text-white text-2xl hover:text-gray-200">&times;</button>
        </div>
        <form action="{{ route('client.profile.update') }}" method="POST" class="p-6">
            @csrf
            @method('PATCH')
            <div class="space-y-3">
                <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Full
                        Name</label><input type="text" name="name" value=" {{ old('name', Auth::user()->name) }}"
                        class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                </div>
                
                <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Username</label><input
                        type="text" name="username" value="{{ old('username', Auth::user()->username) }}"
                        class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                </div>
                <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Email</label><input
                        type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                </div>
                <div><label class="text-xs text-[#9B6B4A] font-semibold uppercase tracking-wide">Phone</label><input
                        type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                        class="w-full mt-1 p-2.5 border border-[#F4E7DD] rounded-lg focus:outline-none focus:ring-1 focus:ring-[#875E43]">
                </div>
                <div class="flex gap-3 pt-3">
                    <button type="submit"
                        class="flex-1 bg-[#875E43] text-white py-2.5 rounded-lg hover:bg-[#9B6B4A] transition">Save Changes</button>
                    <button type="button" onclick="closeModal()"
                        class="flex-1 border border-[#875E43] text-[#875E43] py-2.5 rounded-lg hover:bg-[#F9F5F1] transition">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
