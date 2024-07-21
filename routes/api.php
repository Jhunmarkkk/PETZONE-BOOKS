<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Shop\MainController;
use App\Http\Controllers\InfinityScrollController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//api for showing products from UI
Route::get('/products', [ProductController::class, 'index'])->name('api.products.index');
Route::get('/api/products/{product}', [ProductController::class, 'show'])->name('api.products.show');
Route::get('/categories', [ProductController::class, 'categories'])->name('api.products.categories');


//api for checkout
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('api.checkout.process');
});


// API routes for admin/categories
Route::get('/categories', [CategoryController::class, 'getCategories'])->name('api.categories.data');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('api.categories.destroy');

// API routes for login and registration
Route::post('/register', [RegisterController::class, 'register'])->name('api.register');
Route::post('/login', [LoginController::class, 'login'])->name('api.login');