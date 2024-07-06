<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        
    }
    public function show($id){
        $data = [
            'id'=>$id
        ];
        return view('product-details',compact('data'));

    }
}
