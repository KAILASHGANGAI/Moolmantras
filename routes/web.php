<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\Web\V1\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class , 'index'])->name('home');


Route::get('product/{slug}', [ProductController::class , 'show'])->name('showProduct');
Route::get('blog/{slug}', [ProductController::class , 'show'])->name('blog');
Route::get('collection/{slug}', [CategoryController::class , 'show'])->name('collection');
Route::get('collections', [CategoryController::class , 'index'])->name('collections');
Route::get('products', [ControllersProductController::class , 'index'])->name('products');