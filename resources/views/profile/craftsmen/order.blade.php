 <section id="ordersSection" class="dashboard-section hidden">
     <h2 class="text-2xl text-[#835837] font-bold mb-4">Recent Orders</h2>
     <div class="bg-white rounded-2xl shadow-md overflow-x-auto">
         <table class="w-full">
             <thead>
                 <tr class="border-b text-[#9B6B4A] bg-[#F9F5F1]">
                     <th class="p-4 text-left">Order ID</th>
                     <th class="p-4 text-left">Customer</th>
                     <th class="p-4 text-left">Items</th>
                     <th class="p-4 text-left">Status</th>
                     <th class="p-4 text-left">Total</th>
                     <th class="p-4 text-left">Date</th>
                     <th class="p-4 text-left">Action</th>
                 </tr>
             </thead>
             <tbody id="ordersTable">
                 @forelse ($user->sellerOrders as $order)
                     <tr class="border-b hover:bg-[#F9F5F1]">
                         <td class="p-4 font-medium">{{ $order->number }}</td>
                         <td class="p-4">{{ $order->user->name }}</td>
                         <td class="p-4">
                             {{ $order->orderItems->sum('quantity') }} items
                         </td>
                         @php
                             $statusClasses = [
                                 'pending' => 'bg-purple-100 text-purple-700',
                                 'processing' => 'bg-yellow-100 text-yellow-700',
                                 'completed' => 'bg-green-100 text-green-700',
                                 'cancelled' => 'bg-red-100 text-red-700',
                                 'refunded' => 'bg-blue-100 text-blue-700',
                             ];
                         @endphp
                         <td class="p-4">
                             <span
                                 class="px-2 py-1 {{ $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-700' }} rounded-full text-xs">
                                 {{ ucfirst($order->status) }}
                             </span>
                         </td>
                         <td class="p-4 font-semibold">{{ $order->total_price }} $</td>
                         <td class="p-4 text-sm">{{ $order->created_at->format('D, M Y') }}</td>

                         <!-- Status Update Form -->
                         <td class="p-4">
                             
                                 <a href="{{ route('craftsmen.orders.show', $order->id) }}" 
                                     class="px-4 py-1 text-sm bg-[#835837] text-white rounded-lg hover:bg-[#6b4529] transition">
                                     view
                                 </a>
                           
                         </td>
                     </tr>
                 @empty
                     <tr>
                         <td colspan="100%" class="text-center py-10 text-gray-500">
                             <div class="flex flex-col items-center justify-center gap-2">
                                 <i class="fa-solid fa-box-open text-3xl text-gray-300"></i>
                                 <p class="text-lg font-semibold">No orders yet</p>
                                 <p class="text-sm text-gray-400">There are no orders available at the moment</p>
                             </div>
                         </td>
                     </tr>
                 @endforelse
             </tbody>
         </table>
     </div>
 </section>
