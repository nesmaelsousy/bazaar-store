<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;


use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;

use App\Models\User;
use App\Services\ArtisanDashboard;
use App\UploadableImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ArtisanDashboardController extends Controller
{
    use UploadableImage;
    public function index(Request $request)
    {
        $user = $request->user();

        // استخدام الـ Service
        $dashboardService = new ArtisanDashboard(auth()->id());
        $dashboardData = $dashboardService->getAllData();

        // الفئات
        $categories = Category::pluck('name', 'id')->toArray();

        // إرسال البيانات للـ view
        return view('profile.craftsmen.craftsmen-dashboard', [
            'user' => $user,
            'categories' => $categories,
            'avgReview' => $dashboardData['avgReview'],
            'orderTotal' => $dashboardData['orderTotal'],
            'topProduct' => $dashboardData['topProduct'],
            'soldThisMonth' => $dashboardData['soldThisMonth'],
            'percentage' => $dashboardData['percentage'],
        ]);
    }


    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        // fill data
        $user->fill($request->validated());

        // email change reset verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // image upload
        if ($request->hasFile('image')) {
            $user->image = $this->updateImage(
                $request,
                $user->image,
                'user'
            );
        }

        try {
            $user->save();

            return Redirect::route('craftsmen.profile.index')
                ->with('status', 'profile-updated');
        } catch (\Exception $e) {

            return Redirect::back()
                ->withErrors(['error' => 'فشل في تحديث الملف الشخصي']);
        }
    }
    public function show(User $artisan)
    {
        // $rating = round($product->reviews->avg('rating'));
        return view('frontend.craftsmen.artisan', compact('artisan'));
    }
}
