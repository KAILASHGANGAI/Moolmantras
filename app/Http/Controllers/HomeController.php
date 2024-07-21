<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use CommonTrait;
    protected $repository;


    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function  index(Request $request){
       $datas = $this->allHomePagedata();
      return view('welcome', $datas);
    }

    public function shopingCart(){
        $datas = [
            'menuCategories'=>$this->maincategory()
        ];
        return view('shoping-cart', $datas);
    }

    public function checkout(){
        $datas = [
            'menuCategories'=>$this->maincategory()
        ];
        return view('checkout', $datas);
    }
    
}
