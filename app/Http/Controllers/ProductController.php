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
    public function index(Request $request)
    {
        $pagination = 12;

        $sort = $this->sortProduct($request->sort);

        $pagination = $request->pagination ? min($request->pagination, 50)  : $pagination;
        $pageCondition['sort'] = $request->sort;
        $pageCondition['pagination'] = $request->pagination;

        $condition = null;

        $productColumns = [
            'product_name',
            'sku',
            'compare_price',
            'selling_price',
            'image',
            'category_id',
            'PushedDate',
            'created_at'
        ];
        $columns = [
            'category_name',
            'slug',
            'image'
        ];
        $categoryCondition = [

            'pendingProcess' => 1
        ];
        $productModel = Product::query()->with(['category:id,category_name']);
        $datas = [
            'menuCategories' => $this->maincategory(),
            'featuredProducts' => $this->repo->getWithPagination($productModel, $pagination, $condition,  $productColumns, $sort),
            'offerProducts' => $this->repo->getWithPagination($productModel, 6, $condition,  $productColumns, null),
            'categories' => $this->repo->getData(Category::query(), $categoryCondition, $columns),
            'totalCountProducts' => Product::count(),
            'pageCondition' => $pageCondition ?? null
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
    public function show($sku)
    {
        $pcondition = [
            'sku' => $sku
        ];
        $data = $this->repo->getSingleData(
            Product::query()->with(['category:id,category_name','images' => function ($q) {
                return $q->orderBy('imageSequence', 'ASC');
            }]),
            $pcondition
        );
      

        $relatedCondition = [
            'category_id' => $data->category_id
        ];
        $productColumns = [
            'product_name',
            'sku',
            'compare_price',
            'selling_price',
            'category_id',
            'image'
        ];
        $datas = [
            'menuCategories' => $this->maincategory(),
            'product' => $data,
            'relatedProduct' => $this->repo->getData(
                Product::query()->with('category:id,category_name')->inRandomOrder(),
                $relatedCondition,
                $productColumns,
                4
            ),

        ];
        return view('product-details', $datas);
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
