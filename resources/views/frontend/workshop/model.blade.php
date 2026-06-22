<div id="contactModal" class="fixed inset-0 bg-black/40 hidden justify-center items-center z-50">
    <div class="bg-white rounded-2xl shadow-lg p-10 w-[450px] text-center">
        <h2 class="text-3xl font-medium text-[#835837] mb-6">Contact Us</h2>
        <div class="font-medium text-left mb-5">
            <p class="text-[#835837] mb-2"><i class="fa-solid fa-phone mr-1"></i> Direct Communication:</p>
            @if (setting('site_phone'))
                <p class="text-[#9A7F73] text-xs capitalize ml-6">Contact the support team by phone:<br>
                    {{ setting('site_phone') }}
                </p>
            @endif

        </div>
        <div class="font-medium text-left mb-5">
            <p class="text-[#835837] mb-2"><i class="fa-solid fa-envelope mr-1"></i> Email:</p>
            @if (setting('site_email'))
                <p class="text-[#9A7F73] text-xs capitalize ml-6">Send us your inquiry at email:<br>
                    {{ setting('site_email') }}
                </p>
            @endif
        </div>
        <div class="font-medium text-left mb-6">
            <p class="text-[#835837]"><i class="fa-solid fa-at mr-1"></i> Social Communication:</p>
            <div class="flex gap-3 text-xl ml-6">
                @if (setting('facebook'))
                    <a href="{{ setting('facebook') }}" target="_blank"><i
                            class="fa-brands fa-facebook text-blue-600 hover:scale-110 transition"></i></a>
                @endif
                @if (setting('whatsapp'))
                    <a href="{{ setting('whatsapp') }}" target="_blank"><i
                            class="fa-brands fa-whatsapp text-green-600 hover:scale-110 transition"></i></a>
                @endif
                @if (setting('instagram'))
                    <a href=""{{ setting('instagram') }} target="_blank"><i
                            class="fa-brands fa-instagram text-pink-600 hover:scale-110 transition"></i></a>
                @endif


            </div>
        </div>
        <p class="font-medium text-sm text-[#835837] capitalize">If you have any inquiries, please contact us.<br><span
                class="text-xs text-[#9A7F73]">We will be happy to respond to you as soon as possible!</span></p>
    </div>
</div>
