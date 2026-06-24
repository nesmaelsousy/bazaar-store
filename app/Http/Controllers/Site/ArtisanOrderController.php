<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;


use App\Models\Order;
use Illuminate\Http\Request;

class ArtisanOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('profile.craftsmen.order-details', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:paid,processing,shipped,completed,canceled'
        ]);

        $current = $order->status;
        $new = $request->status;

        // المسارات المسموحة للتغيير
        $transitions = [
            'paid' => ['processing', 'canceled'],
            'processing' => ['shipped', 'canceled'],
            'shipped' => ['completed'],
            'completed' => [],
            'canceled' => [],
        ];

        if (!in_array($new, $transitions[$current] ?? [])) {
            return back()->with('error', 'This status change is not allowed');
        }

        $order->update([
            'status' => $new
        ]);

        return back()->with('success', 'Order status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
