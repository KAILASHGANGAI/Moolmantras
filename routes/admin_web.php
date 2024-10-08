<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth', 'role:admin|SuperAdmin|vendor'],  'prefix' => 'admin'], function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('orders', OrderController::class);
    Route::get('orders-rejected/{id}', [OrderController::class, 'reject'])->name('orders.reject');
    Route::get('orders-approve/{id}', [OrderController::class, 'approve'])->name('orders.approve');
    Route::get('/checkout/bill', [OrderController::class, 'showBill']);
    Route::resource('blogs', BlogController::class);

}); 




