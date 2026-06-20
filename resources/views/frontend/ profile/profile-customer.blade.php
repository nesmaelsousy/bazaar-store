@extends('master')
@section('content')
     <main class="bg-[#F9F5F1] min-h-screen pt-36 pb-20"> 
         <section class="max-w-5xl mx-auto px-4">
             <h1 class="text-3xl text-[#835837] font-bold mb-6">Customer Profile</h1>
             <div class="bg-[#F4E7DD] rounded-3xl shadow-lg p-5 md:p-8">
                 <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                     <div class="space-y-8">
                         <div class="bg-white rounded-2xl shadow-md p-6">
                             <div class="flex flex-col items-center">
                                 <div class="size-28 bg-[#F7EEE9] flex justify-center items-center border-4 border-[#F7EEE9] rounded-full">
                                     <i class="fa-solid fa-user text-5xl text-[#9B6B4A]"></i>
                                 </div>
                                 <h2 id="userName" class="text-xl text-[#835837] font-bold mt-2"></h2>
                                 <p id="userEmail" class="text-sm text-[#9B6B4A] mt-1"></p>
                             </div>
                             <div class="space-y-3 mt-6">
                                 <div class="border border-[#e5d3c5] rounded-xl p-3">
                                     <p class="text-sm text-[#9B6B4A] font-semibold">Username</p>
                                     <h3 id="profileUsername" class="text-[#835837]"></h3>
                                 </div>
                                 <div class="border border-[#e5d3c5] rounded-xl p-3">
                                     <p class="text-sm text-[#9B6B4A] font-semibold">Email</p>
                                     <h3 id="profileEmail" class="text-[#835837]"></h3>
                                 </div>
                                 <div class="border border-[#e5d3c5] rounded-xl p-3">
                                     <p class="text-sm text-[#9B6B4A] font-semibold">Phone Number</p>
                                     <h3 id="profilePhone" class="text-[#835837]"></h3>
                                 </div>
                                 <div class="border border-[#e5d3c5] rounded-xl p-3">
                                     <p class="text-sm text-[#9B6B4A] font-semibold">Password</p>
                                     <h3 id="profilePassword" class="text-[#835837]"></h3>
                                 </div>
                                 <button id="editProfileBtn" class="w-full rounded-xl bg-[#875E43] text-white py-2 transition hover:bg-[#9B6B4A]">
                                      <i class="fa-solid fa-pen mr-1"></i>Edit Profile
                                 </button>
                             </div>
                          </div> 
                         <div>
                             <div class="flex justify-between items-center mb-3">
                                 <h2 class="text-xl text-[#835837] font-bold">Address</h2>
                                 <div class="flex gap-2">
                                     <button id="addAddressBtn" class="size-8 rounded-lg bg-[#875E43] text-white transition hover:bg-[#9B6B4A]">
                                         <i class="fa-solid fa-plus"></i>
                                     </button>
                                     <button id="editAddressBtn" class="size-8 rounded-lg bg-[#875E43] text-white transition hover:bg-[#9B6B4A]">
                                         <i class="fa-solid fa-pen"></i>
                                     </button>
                                  </div>
                             </div>
                             <div id="addressContainer" class="space-y-3 bg-white rounded-2xl shadow-md p-5"></div>
                         </div>
                      </div>
                      <div class="lg:col-span-2 space-y-8">
                         <div>
                             <h2 class="text-xl text-[#835837] font-bold mb-3">My Orders</h2>
                             <div class="bg-white rounded-2xl shadow-md p-5 overflow-x-auto">
                                 <table class="w-full min-w-[500px]">
                                     <thead>
                                         <tr class="border-b text-left text-[#9B6B4A]">
                                             <th class="pb-4">Order</th>
                                             <th class="pb-4">Date</th>
                                             <th class="pb-4">Status</th>
                                             <th class="pb-4">Total</th>
                                         </tr>
                                     </thead>
                                     <tbody id="ordersContainer" class="text-[#6B4F3A]"></tbody>
                                 </table>
                             </div>
                         </div>
                         <div>
                             <div class="flex justify-between items-center mb-3"> 
                                 <h2 class="text-xl text-[#835837] font-bold">Favorites</h2>
                                 <a href="favorites.html" class="text-[#835837] hover:text-[#9B6B4A] font-medium">View All →</a>
                             </div>
                             <div id="favoritesContainer" class="bg-white rounded-2xl p-5 shadow-md grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"></div>
                         </div>
                         <div>
                             <div class="flex justify-between items-center mb-3">
                                 <h2 class="text-xl text-[#835837] font-bold">Messages</h2>
                             </div>
                             <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                                 <div class="grid grid-cols-1 md:grid-cols-[260px_1fr]">
                                     <div class="border-r border-[#eee] bg-[#FCFAF8]">
                                         <div class="border-b border-[#eee] p-4">
                                             <h3 class="text-[#9B6B4A] font-semibold">Artisans</h3>
                                         </div>
                                         <div id="artisanList" class="flex flex-col">
                                             <button class="flex items-center gap-3 bg-[#F4E7DD] p-4 border-b border-[#eee] transition hover:bg-[#F7EEE9]">
                                                 <div class="size-12 rounded-full bg-[#E8D8CC] flex justify-center items-center">
                                                     <i class="fa-solid fa-user text-[#9B6B4A]"></i>
                                                 </div>
                                                 <div class="text-left">
                                                     <h3 class="text-[#835837] font-semibold"></h3>
                                                     <p class="text-sm text-[#9B6B4A]"></p>
                                                 </div>
                                             </button>
                                         </div>
                                     </div>
                                     <div class="flex flex-col h-[420px]">
                                         <div class="flex items-center gap-3 p-4 border-b border-[#eee]">
                                             <div class="size-12 rounded-full bg-[#E8D8CC] flex justify-center items-center">
                                                 <i class="fa-solid fa-user text-[#9B6B4A]"></i>
                                             </div>
                                             <div>
                                                 <h3 id="activeArtisanName" class="text-[#835837] font-semibold"></h3>
                                                 <p class="text-sm text-[#9B6B4A]">Artisan Conversation</p>
                                             </div>
                                         </div>
                                         <div id="messagesContainer" class="flex-1 overflow-y-auto bg-[#FFFCFA] p-4 space-y-4">
                                             <div class="flex justify-end">
                                                 <div class="bg-[#835837] text-sm text-white px-4 py-3 rounded-2xl max-w-[75%]"></div>
                                             </div>
                                             <div class="flex justify-start">
                                                 <div class="bg-[#F4E7DD] text-sm text-[#6B4F3A] px-4 py-3 rounded-2xl max-w-[75%]"></div>
                                             </div>
                                         </div>
                                         <div class="border-t border-[#eee] p-4">
                                             <div class="flex gap-2">
                                                 <input id="messageInput" type="text" placeholder="Enter your message..." class="flex-1 p-3 border border-[#e5d3c5] rounded-xl outline-none focus:ring-1 focus:ring-[#875E43]">
                                                 <button id="sendMessageBtn" class="bg-[#875E43] text-white px-4 rounded-xl transition hover:bg-[#9B6B4A]">
                                                     <i class="fa-solid fa-paper-plane"></i>
                                                 </button>
                                             </div>
                                          </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
      </main> 
@endsection
