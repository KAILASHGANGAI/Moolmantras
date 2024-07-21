<?php

use App\Http\Controllers\AddToCardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EsewaModelController;
use App\Http\Controllers\FonepayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KhaltiController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class , 'index'])->name('home');


Route::get('product/{slug}', [ProductController::class , 'show'])->name('showProduct');
Route::get('blog/{slug}', [ProductController::class , 'show'])->name('blog');
Route::get('collection/{slug}', [CategoryController::class , 'show'])->name('collection');
Route::get('collections', [CategoryController::class , 'index'])->name('collections');
Route::get('products', [ProductController::class , 'index'])->name('products');

Route::get('/cart-to-add/{id}', [AddToCardController::class, 'add'])->name('cart.add');
Route::get('/remove-from-cart/{id}', [AddToCardController::class, 'remove'])->name('cart.remove');
Route::post('/update-quantity', [AddToCardController::class, 'updateQuantity']);

Route::get('/shoping-cart', [HomeController::class, 'shopingCart'])->name('shopingCart');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');

Route::get('esewa-checkout/{product:slug}',[EsewaModelController::class,'esewaPay'])->name('esewa.checkout');
Route::get('esewa-verification/{product:slug}',[EsewaModelController::class,'verification'])->name('esewa.verification');

Route::get('fonepay-checkout/{slug}',[FonepayController::class,'checkout'])->name('fonepay.checkout');
Route::get('fonepay-verification/{slug}',[FonepayController::class,'verification'])->name('fonepay.verification');

Route::get('khalti-checkout/{product:slug}',[KhaltiController::class,'checkout'])->name('khalti.checkout');
Route::get('khalti-verification/{product:slug}',[KhaltiController::class,'verification'])->name('khalti.verification');
