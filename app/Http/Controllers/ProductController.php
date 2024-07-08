<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use CommonTrait;
    private BaseRepository $repo;
    public function __construct(BaseRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $condition=null;

        $productColumns = [
            'product_name',
            'sku',
            'compare_price',
            'selling_price',
            'image'
        ];
        $columns = [
            'category_name',
            'slug',
            'image'
        ];
        $categoryCondition = [
            
            'pendingProcess'=>1
        ];
        $datas = [
            'menuCategories' => $this->maincategory(),
            'featuredProducts'=>$this->repo->getWithPagination(Product::query(), 12, $condition,  $productColumns),
            'offerProducts'=>$this->repo->getWithPagination(Product::query(), 6, $condition,  $productColumns),
            'categories' => $this->repo->getData(Category::query(), $categoryCondition, $columns),
            'totalCountProducts'=> Product::count()
        ];

        return view('products', $datas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
