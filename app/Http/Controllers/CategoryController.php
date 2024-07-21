<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

        $datas = [
            'menuCategories' => $this->maincategory(),
            'collections' => $this->repo->getallDatas(Category::query())
        ];
        return view('collections', $datas);
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
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $condition = [
            'slug' => $slug
        ];
        $data = $this->repo->getSingleData(Category::query(), $condition);
        $pcondition = [
            'category_id'=>$data->id
        ];
        $productModel = Product::query()->with(['category:id,category_name']);

        $datas = [
            'menuCategories' => $this->maincategory(),
            'collection' => $data,
            'products' => $this->repo->getWithPagination($productModel, 12, $pcondition,null, null)
        ];
       #dd($datas);
        return view('collection', $datas);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
