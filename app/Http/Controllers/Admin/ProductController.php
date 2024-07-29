<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequests;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nwidart\Modules\Collection;
use Symfony\Component\HttpFoundation\File\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequests $request)
    {

        try {
            $data = $request->all();
            $data['vendor_id'] = Auth::id();
            unset($data['images']);
            DB::beginTransaction();
            $product =  Product::create($data);
            // Handle image upload
            // Handle multiple image uploads

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {

                    // Generate a unique name for the file
                    $fileName = uniqid('photo_') . '.' . $image->getClientOriginalExtension();

                    // Move the file to the public/photos/products directory
                    $image->move(public_path('photos/products'), $fileName);

                    // Store the file path
                    $imagePaths = 'photos/products/' . $fileName;
                    if ($key == 0) {
                        $product->update(['image' => $imagePaths]);
                    }
                    Image::create([
                        'product_id' => $product->id,
                        'pendingProcess' => 1,
                        'mainImage' => ($key == 0) ? 1 : 0,
                        'image' => $imagePaths,
                        'imageSequence' => $key,
                        'fullUrl' => env('APP_URL') . $imagePaths,
                        'status' => 1
                    ]);
                }
            }




            # toast('product created successfully!', 'success');
            DB::commit();
            return redirect()->route('products.index')->with('success', 'product created successfully!');
        } catch (Exception $e) {
            # toast($e->getMessage(), 'error');
            # dd($e);
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $data = $request->all();
            unset($data['images']);
            DB::beginTransaction();
            $product =  $product->update($data);

            // Handle image upload
            // Handle multiple image uploads

            if ($request->hasFile('images')) {
                $Images = Image::where('product_id', $product->id)->get();
                foreach ($Images as $img) {
                    if (file_exists($img->image)) {
                        unlink($img->image);
                        $img->delete();
                    }
                }

                foreach ($request->file('images') as $key => $image) {

                    // Generate a unique name for the file
                    $fileName = uniqid('photo_') . '.' . $image->getClientOriginalExtension();

                    // Move the file to the public/photos/products directory
                    $image->move(public_path('photos/products'), $fileName);

                    // Store the file path
                    $imagePaths = 'photos/products/' . $fileName;
                    if ($key == 0) {
                        $product->update(['image' => $imagePaths]);
                    }
                    Image::create([
                        'product_id' => $product->id,
                        'pendingProcess' => 1,
                        'mainImage' => ($key == 0) ? 1 : 0,
                        'image' => $imagePaths,
                        'imageSequence' => $key,
                        'fullUrl' => env('APP_URL') . $imagePaths,
                        'status' => 1
                    ]);
                }
            }

            # toast('product created successfully!', 'success');
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } catch (Exception $e) {
            // toast($e->getMessage(), 'error');
            dd($e);
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
    public function search(Request $request)
    {

        try {
            $query = $request->searchitem;
            // Perform a simple search on product_name
            $products = Product::where('product_name', 'like', "%$query%")->get();

            return  response()->json($products);
        } catch (Exception $e) {
            return redirect()->json(['error' => $e->getMessage()]);
        }
    }
}
