<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'meta_title'=> 'nullable|string|max:255',
            'meta_description'=> 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);


        $validatedData['slug'] = $request->slug ??  \Str::slug($request->title);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Generate a unique name for the file
            $fileName = uniqid('photo_') . '.' . $image->getClientOriginalExtension();

            // Move the file to the public/photos/products directory
            $image->move(public_path('photos/blogs'), $fileName);

            // Store the file path
            $imagePaths = '/photos/blogs/' . $fileName;

            $validatedData['image_path'] = $imagePaths;
        }

        Blog::create($validatedData);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([

            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'content' => 'required',
            'meta_title'=> 'nullable|string|max:255',
            'meta_description'=> 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);


        try {

            if ($request->hasFile('image')) {
                // if (file_exists($blog->image)) {
                //     unlink($blog->image);
                // }
                $image = $request->file('image');
                // Generate a unique name for the file
                $fileName = uniqid('photo_') . '.' . $image->getClientOriginalExtension();

                // Move the file to the public/photos/products directory
                $image->move(public_path('photos/blogs'), $fileName);

                // Store the file path
                $imagePaths = '/photos/blogs/' . $fileName;

                $validatedData['image_path'] = $imagePaths;
            }


            $blog->update($validatedData);

            return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
        } catch (Exception $th) {
        dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
