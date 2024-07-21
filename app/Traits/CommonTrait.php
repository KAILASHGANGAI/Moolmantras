<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\BaseRepository;

trait CommonTrait
{
    protected $repository;

    public function initializeRepository(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function allHomePagedata()
    {
        $condition = null;
        $categoryCondition = [

            'pendingProcess' => 1
        ];
        $columns = [
            'category_name',
            'slug',
            'image'
        ];
        $productColumns = [
            'product_name',
            'sku',
            'compare_price',
            'selling_price',
            'category_id',
            'image'
        ];
        $MENU = [
            'parent_category_id' => 0
        ];
        $productModel = Product::query()->with(['category:id,category_name']);

        return [
            'menuCategories' => $this->repository->getData(Category::query(), $MENU, $columns),
            'categories' => $this->repository->getData(Category::query(), $categoryCondition, $columns),
            'featuredProducts' => $this->repository->getWithPagination($productModel, 12, $condition,  $productColumns),
            'latestProducts' => $this->repository->getWithPagination($productModel, 6,  $condition,  $productColumns),
            'ratedProducts' => $this->repository->getWithPagination($productModel, 6, $condition, $productColumns),
            'reviewedProducts' => $this->repository->getWithPagination($productModel, 6, $condition, $productColumns),
            'offerProducts' => $this->repository->getWithPagination($productModel, 6, $condition,  $productColumns, null),

        ];
    }
    public function maincategory()
    {
        $MENU = [
            'parent_category_id' => 0
        ];
        $columns = [
            'category_name',
            'slug',
            'image'
        ];
        return Category::where($MENU)->get($columns);
    }

    public function sortProduct($sortBy)
    {

        switch ($sortBy) {
            case 'alphabet_asc':
                $order = [
                    'column' => 'product_name',
                    'value' => 'ASC'
                ];
                break;
            case 'alphabet_desc':
                $order = [
                    'column' => 'product_name',
                    'value' => 'DESC'
                ];
                break;
            case 'price_asc':
                $order = [
                    'column' => 'selling_price',
                    'value' => 'ASC'
                ];
                break;
            case 'price_desc':
                $order = [
                    'column' => 'selling_price',
                    'value' => 'DESC'
                ];
                break;
            case 'oldest':
                $order = [
                    'column' => 'PushedDate',
                    'value' => 'ASC'
                ];

                break;
            case 'newest':
                $order = [
                    'column' => 'PushedDate',
                    'value' => 'DESC'
                ];
                break;
            default:
                $order = [
                    'column' => 'PushedDate',
                    'value' => 'DESC'
                ];
                break;
        }

       
        return $order;
    }
}
