<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\V1\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class , 'index'])->name('home');


Route::get('product/{slug}', [ProductController::class , 'show'])->name('showProduct');
Route::get('blog/{slug}', [ProductController::class , 'show'])->name('blog');