<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $admin = Auth::user();
        //حاليا هخليه كدا وبس اعمل تسجيل الدخول هتم حذفه احط اللي فوق 
        $admin = Auth::user();

        return view('dashboard.admin.profile', compact('admin'));
    }
    public function deleteImage()
    {
        $admin = auth()->user();

        // حذف الصورة القديمة
        if ($admin->image && Storage::exists('public/' . $admin->image)) {
            Storage::delete('public/' . $admin->image);
        }

        // حذف من database
        $admin->update(['image' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully'
        ]);
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
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
        ]);

        $data = $request->only(['name', 'phone']);

        // رفع صورة جديدة
        if ($request->hasFile('image')) {

            // حذف القديمة
            if ($admin->image) {
                Storage::delete('public/' . $admin->image);
            }

            // حفظ الجديدة
            $path = $request->file('image')->store('admins', 'public');
            $data['image'] = $path;
        }

        $admin->update($data);

        return back()->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
