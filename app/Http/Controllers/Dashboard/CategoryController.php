<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $categories = Category::latest()->Filter($request->all())->paginate(10);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        $categories = Category::with('parent')->latest()->get();
        return view('dashboard.categories.add', compact('categories', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']) . '-' . rand(1000, 9999);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);
        // Redirect back to the index page with a success message
        return redirect()->route('admin.category.index')
            ->with('success', 'Category created successfully.');
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
    public function edit(Category $category)
    {
        //    dd($id);
        // to find id 
        // $categories = Category::findOrFail($id);
        // SELECT * FORM CATEGORY WHERE ID <> $id (parent_id is null and parent_id <> $id)
        $categories = Category::where('id', '!=', $category->id)
            ->where(function ($query) use ($category) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $category->id);
            })->get();
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->except('image', 'modal_type');

        $old_image = $category->image;

        $new_image = $this->UploadImage($request);

        if ($new_image) {
            $data['image'] = $new_image;
        }

        try {
            $category->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('admin.category.index')->with('warning', 'The category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted.');
    }
    protected function UploadImage(Request $request)
    {
        // insure if user sent image  
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');    //uploudedFile object 
        //rename image 
        $name = $file->getClientOriginalName() . '_' . rand() . '_' . time();
        // store('name file','disk')  , storeAs('name file',$name,'disk')
        $path = $file->store('categories', 'public');
        return $path;
    }
}
