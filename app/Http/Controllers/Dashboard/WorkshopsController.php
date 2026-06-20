<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkshopsRequest;
use App\Models\Workshop;

class WorkshopsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workshops = Workshop::paginate(10);
        return view('dashboard.workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.workshops.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkshopsRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->UploadImage($request);
        Workshop::create($data);
        return redirect()->route('admin.workshop.index')
            ->with('success', 'Workshop created successfully.');
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
    public function edit(Workshop $workshop)
    {
        return view('dashboard.workshops.edit', compact('workshop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkshopsRequest $request, Workshop $workshop)
    {
        $data = $request->except('image');

        $old_image = $workshop->image;

        $new_image = $this->UploadImage($request);

        if ($new_image) {
            $data['image'] = $new_image;
        }

        try {
            $workshop->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('admin.workshop.index')->with('warning', 'The workshop has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    protected function UploadImage(WorkshopsRequest $request)
    {
        // insure if user sent image  
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        //rename image 
        $name = $file->getClientOriginalName() . '_' . rand() . '_' . time();

        $path = $file->store('workshops', 'public');
        return $path;
    }
}
