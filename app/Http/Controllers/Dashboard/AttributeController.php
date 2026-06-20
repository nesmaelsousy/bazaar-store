<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $attributes = Attribute::Filter($request->all())->paginate(10);

        return view('dashboard.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attribute = new Attribute();

        return view('dashboard.attributes.add', compact('attribute',));
    }

    /**
     * attribute a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255'
        ]);

        attribute::create($data);

        return redirect()->route('admin.attribute.index');
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
    public function edit(Attribute $attribute)
    {

        return view('dashboard.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $data = $request->all();

        try {
            $attribute->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }



        return redirect()->route('admin.attribute.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('admin.attribute.index');
    }
}
