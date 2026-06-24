<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = auth()->user();
       $orders = Order::with('orderItems.product')->where('user_id', auth()->id())->latest()->get();
        return view('profile.client.profile-client', [
            'user' => $request->user(),
            'orders'=>$orders
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('image')) {
            if (Auth::user()->image) {
                // Delete old image
                $oldImagePath = public_path('storage/' . Auth::user()->image);
                if (file_exists($oldImagePath)) {
                    // delete the old image file
                    Storage::disk('public')->delete(Auth::user()->image);
                }
            }
            $imagePath = $request->file('image')->store('user', 'public');
            $request->user()->image = $imagePath;
        }

        $request->user()->save();

        return Redirect::route('client.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
