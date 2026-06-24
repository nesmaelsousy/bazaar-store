<!-- في Navbar أو Layout -->


<div x-data="notificationBell()" class="relative" @click.outside="isOpen = false">


    <button @click="isOpen = !isOpen"
        class="relative p-2 text-[#875E43] hover:text-[#E6B693]rounded-lg transition-colors duration-200 ">
        <i class="fa-solid fa-bell text-xl"></i>


        @php
            $unreadCount = auth()->user()?->unreadNotifications()->count() ?? 0;
        @endphp

        @if ($unreadCount > 0)
            <span id="cart-count"
                class="absolute -top-0 -right-2 bg-red-500 text-white text-xs w-5 h-5 flex justify-center items-center rounded-full transition-all duration-300 group-hover:-translate-y-1">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
        @endif
    </button>


    <div x-show="isOpen" x-transition
        class="absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-xl z-50 border border-gray-200">

        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
            <button @click="isOpen = false" class="p-1 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>


        <div class="max-h-96 overflow-y-auto">
            @forelse($notifications as $notification)
                <a href="{{ $notification->data['url'] ?? '#' }}"
                    class="block px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition-colors {{ !$notification->read_at ? 'bg-blue-50' : '' }}">

                    <div class="flex items-start gap-3">

                        <div class="flex-shrink-0">
                            <i
                                class="{{ $notification->data['icon'] ?? 'fa-solid fa-bell' }}
                                 text-[#875E43] text-lg"></i>
                        </div>

                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">
                                {{ $notification->data['body'] ?? 'New Notification' }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>

                        @if (!$notification->read_at)
                            <span class="w-2 h-2 rounded-full  bg-[#E6B693]  mt-2"></span>
                        @endif
                    </div>
                </a>


            @empty <div class="flex flex-col items-center justify-center py-8 text-[#875E43]"> <i
                        class="fa-regular fa-bell text-3xl mb-3"></i>
                    <p>No notifications</p>
                </div>
            @endforelse

        </div>

        <!-- التذييل -->
        @if ($notifications?->count() > 0)
            <div class="flex gap-2 p-4 border-t border-gray-200">
                <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit"
                        class="w-full px-3 py-2 text-sm font-medium  text-[#875E43] hover:text-[#E6B693] rounded-lg transition-colors">
                        Read All
                    </button>
                </form>

              
            </div>
        @endif
    </div>
</div>

<!-- Alpine.js Script -->
<script>
    function notificationBell() {
        return {
            isOpen: false
        }
    }
</script>
