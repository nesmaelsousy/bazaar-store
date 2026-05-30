<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->query();

        $users = User::Filter($query)->paginate(5);

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['username'] = Str::random() . rand();
        $data['slug'] = Str::slug($data['name']) . '-' . rand(1000, 9999);
        $data['password'] = Hash::make(Str::random());
        //send password to user email
        // Mail::to($data['email'])->send(new UserCreated($data));

        if ($request->hasFile('image')) {
            $data['image'] = User::UploadImage($request, 'user');
        }
        //dd($request->all());
        User::create($data);
        return redirect()->route('admin.user.index')->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        // حماية role & status
        // بس اعمل ال auth شيل الكومنت عنها
        // if (auth()->user()->role !== 'admin') {
        //     unset($data['role'], $data['status']);
        // }

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
    public function destroy(User $user)
    {
        // حذف الصورة
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        Flasher::success('User deleted successfully');

        return redirect()->back();
    }
}
