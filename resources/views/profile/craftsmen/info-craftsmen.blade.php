<div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl w-full max-w-md mx-4 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-[#835837]">Edit Profile</h3>
            <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form id="profileForm" action="{{ route('craftsmen.profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label class="block text-[#835837] mb-2">Store Name</label>
                <input type="text" id="profileName" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#835837]">
            </div>
            <div class="mb-4">
                <label class="block text-[#835837] mb-2">Email</label>
                <input type="email" id="profileEmail" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#835837]">
            </div>
            <div class="mb-4">
                <label class="block text-[#835837] mb-2">Phone</label>
                <input type="text" id="profilePhone" name="phone" value="{{ old('phone', $user->phone) }}"
                    class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#835837]">
            </div>
            <div class="mb-4">
                <label class="block text-[#835837] mb-2">Address</label>
                <input type="text" id="profileAddress" name="address" value="{{ old('address', $user->address) }}"
                    class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#835837]">
            </div>
            <div class="mb-4">
                <label class="block text-[#835837] mb-2">Bio</label>
                <textarea id="profileBio" rows="3" name="bio"
                    class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#835837]">{{ old('bio', $user->bio) }}</textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit"
                    class="flex-1 bg-[#835837] text-white py-2 rounded-xl hover:bg-[#9B6B4A] 
                    transition">Save
                    Changes</button>
                <button type="button" id="cancelModalBtn"
                    class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-xl hover:bg-gray-300 transition">Cancel</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* تحسينات إضافية */
    #editProfileModal {
        backdrop-filter: blur(4px);
    }

    #editProfileModal .bg-white {
        animation: modalSlideIn 0.3s ease-out;
        max-height: 90vh;
        overflow-y: auto;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-30px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* تخصيص scrollbar للمودال */
    #editProfileModal .bg-white::-webkit-scrollbar {
        width: 6px;
    }

    #editProfileModal .bg-white::-webkit-scrollbar-track {
        background: #F4E7DD;
        border-radius: 10px;
    }

    #editProfileModal .bg-white::-webkit-scrollbar-thumb {
        background: #9B6B4A;
        border-radius: 10px;
    }

    #editProfileModal .bg-white::-webkit-scrollbar-thumb:hover {
        background: #835837;
    }
</style>
