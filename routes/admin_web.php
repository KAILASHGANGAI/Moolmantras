<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth', 'role:admin|SuperAdmin'],  'prefix' => 'admin'], function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);
}); 




