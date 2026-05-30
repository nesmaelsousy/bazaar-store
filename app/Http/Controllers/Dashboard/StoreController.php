<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $stores = Store::with('user')->Filter($request->all())->paginate(10);
        $rating = Store::RATINGS;
        return view('dashboard.stores.index', compact('stores', 'rating'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $store = new Store();
        $users = User::where('role', 'craftsmen')->get();

        $rating = Store::RATINGS;

        return view('dashboard.stores.add', compact('store', 'users', 'rating'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']) . '-' . rand(1000, 9999) . '_bazaar';
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('stores', 'public');
        }
        
        // dd($request->all());
        Store::create($data);
        // Redirect back to the index page with a success message
        return redirect()->route('admin.store.index')
            ->with('success', 'Store created successfully.');
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
    public function edit(Store $store)
    {
        $users = User::where('role', 'craftsmen')->get();
        $rating = Store::RATINGS;

        return view('dashboard.stores.edit', compact('store', 'users', 'rating'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store)
    {
        $data = $request->except('image', 'modal_type');

        $old_image = $store->image;

        $new_image = $this->UploadImage($request);

        if ($new_image) {
            $data['image'] = $new_image;
        }

        try {
            $store->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('admin.store.index')->with('warning', 'The Store has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        if ($store->image) {
            Storage::disk('public')->delete($store->image);
        }
        $store->delete();
        return redirect()->route('admin.store.index')->with('success', 'Store deleted.');
    }
    protected function UploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $name = $file->getClientOriginalName() . '_' . rand() . '_' . time();
        $path = $file->store('stores', 'public');
        return $path;
    }
}
