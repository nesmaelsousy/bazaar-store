<div class="bg-white rounded-2xl shadow-lg border border-[#F4E7DD] overflow-hidden">
    <div class="bg-[#835837] px-6 py-4">
        <h2 class="text-white font-medium tracking-wide text-sm">
            <i class="fa-solid fa-truck mr-2"></i>ORDER HISTORY
        </h2>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[500px]">
                <thead>
                    <tr class="border-b-2 border-[#F4E7DD] text-left">
                        <th class="pb-3 text-[#9B6B4A] font-semibold text-xs tracking-wider uppercase">
                            Order #</th>
                        <th class="pb-3 text-[#9B6B4A] font-semibold text-xs tracking-wider uppercase">
                            Date</th>
                        <th class="pb-3 text-[#9B6B4A] font-semibold text-xs tracking-wider uppercase">
                            Status</th>
                        <th class="pb-3 text-[#9B6B4A] font-semibold text-xs tracking-wider uppercase">
                            Total</th>
                    </tr>
                </thead>
                <tbody class="text-[#6B4F3A]">
                    @forelse ($orders as $order)
                        <tr class="border-b border-[#F4E7DD] hover:bg-[#F9F5F1] transition">
                            <td class="py-3 text-[#835837] font-medium">#{{ $order->number }}</td>
                            <td class="py-3">{{ $order->created_at }}</td>
                            <td class="py-3"><span
                                    class="inline-block px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">{{ $order->status }}</span>
                            </td>
                            <td class="py-3 font-semibold text-[#835837]"> ${{ $order->total_price }}</td>
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
    </div>
</div>
