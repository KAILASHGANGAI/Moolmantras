<?php

use App\Http\Controllers\Web\V1\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('product/{slug}', [ProductController::class , 'show'])->name('showProduct');