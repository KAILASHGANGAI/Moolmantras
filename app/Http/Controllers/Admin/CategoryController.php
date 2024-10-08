<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'category_name' => 'required|string|unique:categories',
        ]);

        // Handle file uploads
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images');
        }

        Category::create([
            'parent_category_id' => $request->parent_category_id,
            'category_name' => $request->category_name,
            'pendingProcess' => 1,
            'description' => $request->description,
            'tags' => $request->tags,
            'slug' => $request->slug ?? Str::slug($request->category_name),
            'status' => $request->status ?? 0,
            'banner' => $bannerPath ?? null,
            'image' => $imagePath ?? null,
        ]);

        return redirect()->back()->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|unique:categories,category_name,' . $category->id,
        ]);


        // Handle file uploads
        if ($request->hasFile('banner')) {
            if ($category->banner) {
                Storage::delete($category->banner);
            }
            $bannerPath = $request->file('banner')->store('banners');
        }

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::delete($category->image);
            }
            $imagePath = $request->file('image')->store('images');
        }
        $category->update([
            'parent_category_id' => $request->parent_category_id,
            'category_name' => $request->category_name,
            'pendingProcess' => 1,
            'description' => $request->description,
            'tags' => $request->tags,
            'slug' => $request->slug ?? Str::slug($request->category_name),
            'status' => $request->status ?? 0,
            'banner' => @$bannerPath,
            'image' => @$imagePath,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
