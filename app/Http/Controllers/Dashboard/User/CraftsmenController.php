<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Mail\UserCreatedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CraftsmenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->query();

        $users = User::where('role', 'craftsmen')->Filter($query)->paginate(5);

        return view('dashboard.craftsmen.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.craftsmen.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();

        $data['username'] = Str::random() . rand();
        $data['slug'] = Str::slug($data['name']) . '-' . rand(1000, 9999);
        $data['password'] = Hash::make(Str::random());
        //send password to user email
        Mail::to($data['email'])->send(new UserCreatedMail($data));

        if ($request->hasFile('image')) {
            $data['image'] = User::UploadImage($request, 'user');
        }
        //dd($request->all());
        User::create($data);
        return redirect()->route('admin.user.index');
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
    public function edit(User $artisan)
    {
        return view('dashboard.craftsmen.edit', compact('artisan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $artisan)
    {
        $data = $request->validat([
            "name" => "required|string|max:255",
            "username" => "required|string|max:255",
            "phone" => "required|string|max:20",
            "address" => "required|string|max:255",
            "email" => "required|email",
            "password" => "nullable|min:6",
            "image" => "nullable|image|max:2048",
            "role" => "required",
        ]);

        // صورة جديدة
        if ($request->hasFile('image')) {

            // حذف الصورة القديمة
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $data['image'] = User::UploadImage($request, 'user');
        }

        $user->update($data);

        Flasher::success('User updated successfully');

        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
