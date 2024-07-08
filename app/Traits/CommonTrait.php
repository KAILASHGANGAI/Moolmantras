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

    public function allHomePagedata(){
        $condition=null;
        $categoryCondition = [
            'parent_category_id'=> '!=0'
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
            'image'
        ];
        $MENU =[
            'parent_category_id'=>0
        ];
        return [
            'menuCategories' => $this->repository->getData(Category::query(), $MENU, $columns),
            'categories' => $this->repository->getData(Category::query(), $categoryCondition, $columns),
            'featuredProducts'=>$this->repository->getWithPagination(Product::query(), 20, $condition,  $productColumns),
            'latestProducts'=>$this->repository->getWithPagination(Product::query(), 6,  $condition,  $productColumns),
            'ratedProducts'=>$this->repository->getWithPagination(Product::query(), 6,$condition, $productColumns),
            'reviewedProducts'=>$this->repository->getWithPagination(Product::query(), 6,$condition, $productColumns)
        ];
    }
}
