<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Shop\MainController;
use App\Http\Controllers\InfinityScrollController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Shop\BasketController;
use App\Http\Controllers\Shop\ProductController as ShopProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ExpensesController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\OrderController;

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

//API for showing products
Route::get('/', [ShopProductController::class, 'index'])->name('api.products.index');
Route::get('/products/{product}', [ShopProductController::class, 'show'])->name('api.products.show');
Route::get('/categories', [ShopProductController::class, 'categories'])->name('api.products.categories');


//API routes for basket operations
Route::get('/basket/add/{product}', [BasketController::class, 'add'])->name('api.basket.add');
Route::delete('/basket/remove/{product}', [BasketController::class, 'remove'])->name('api.basket.remove');
Route::put('/basket/update/quantity/{product}', [BasketController::class, 'updateQuantity'])->name('api.basket.update.quantity'); // Add this route
Route::get('/basket/clear', [BasketController::class, 'clear'])->name('api.basket.clear'); // Add this route


// API for checkout
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/process', [CheckoutController::class, 'processCheckout'])->name('api.checkout.process');
    Route::get('/checkout', [CheckoutController::class, 'checkoutForm'])->name('api.checkout.index'); // This should point to the view
    // Route::get('/checkout', [CheckoutController::class, 'checkoutView'])->name('checkout.view');
});


// API routes for ADMIN PRODUCT MANAGEMENT
Route::prefix('/products')->group(function(){
    Route::get('/' , [productController::class , 'all'])->name('api.products.all');
    Route::post('/' , [productController::class , 'store'])->name('api.products.store');
    Route::get('/create' , [productController::class , 'create'])->name('api.products.create');
    Route::get('/{product}/edit' , [productController::class , 'edit'])->name('api.products.edit');
    Route::put('/{product}/update' , [productController::class , 'update'])->name('api.products.update');
    Route::delete('/{product}/remove' , [productController::class , 'destroy'])->name('api.products.destroy');
    Route::get('{product}/download/demo' , [productController::class , 'downloadDemo'])->name('api.products.download.demo');
});


// API routes for ADMIN USER MANAGEMENT
Route::prefix('/users')->group(function() {
    Route::get('', [UserController::class, 'all'])->name('api.users.all');
    Route::get('/create' , [UserController::class , 'create'])->name('api.users.create');
    Route::post('', [UserController::class, 'store'])->name('api.users.store');
    Route::get('/{user}', [UserController::class, 'show'])->name('api.users.show');
    Route::put('/{user}/update' , [UserController::class , 'update'])->name('api.users.update');
    Route::get('/{user}/edit' , [UserController::class , 'edit'])->name('api.users.edit');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('api.users.destroy');
});

// API routes for ADMIN CATEGORIES
Route::get('/categories', [CategoryController::class, 'getCategories'])->name('api.categories.data');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('api.categories.destroy');


// API routes for LOGIN AND REGISTRATION
Route::post('/register', [RegisterController::class, 'register'])->name('api.register');
Route::post('/login', [LoginController::class, 'attemptLogin'])->name('api.login');


//API for CHARTS
Route::prefix('/dashboard')->group(function(){
    Route::get('/pie-chart', [ChartController::class, 'pieChart'])->name('api.charts.pie');
    Route::get('/line-chart', [ChartController::class, 'lineChart'])->name('api.charts.line');
    Route::get('/bar-chart', [ChartController::class, 'barChart'])->name('api.charts.bar');
}); 

// API routes for ADMIN EXPENSES MANAGEMENT
Route::prefix('/expenses')->group(function(){
    Route::get('', [ExpensesController::class, 'all'])->name('api.expenses.all');
    Route::post('', [ExpensesController::class, 'store'])->name('api.expenses.store');
    Route::get('/create', [ExpensesController::class, 'create'])->name('api.expenses.create');
    Route::get('/{expense}/edit', [ExpensesController::class, 'edit'])->name('api.expenses.edit');
    Route::put('/{expense}/update', [ExpensesController::class, 'update'])->name('api.expenses.update');
    Route::delete('/{expense}/remove', [ExpensesController::class, 'destroy'])->name('api.expenses.destroy');
    Route::post('/import', [ExpensesController::class, 'importCSV'])->name('api.expenses.import');
});

// API routes for ADMIN SUPPLIERS MANAGEMENT
Route::prefix('/suppliers')->group(function(){
    Route::get('' , [SupplierController::class , 'all'])->name('api.suppliers.all');
    Route::get('/create' , [SupplierController::class , 'create'])->name('api.suppliers.create');
    Route::post('' , [SupplierController::class , 'store'])->name('api.suppliers.store');
    Route::delete('/{supplier}/remove' , [SupplierController::class , 'destroy'])->name('api.suppliers.destroy');
    Route::get('/{supplier}/edit' , [SupplierController::class , 'edit'])->name('api.suppliers.edit');
    Route::put('/{supplier}/update' , [SupplierController::class , 'update'])->name('api.suppliers.update');
});

// API routes for ADMIN ORDERS MANAGEMENT
Route::prefix('admin/orders')->group(function () {
    Route::get('', [OrderController::class, 'all'])->name('api.orders.all');
    Route::get('/create', [OrderController::class, 'create'])->name('api.orders.create');
    Route::post('', [OrderController::class, 'store'])->name('api.orders.store');
    Route::delete('/{order}/remove', [OrderController::class, 'destroy'])->name('api.orders.destroy');
    Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('api.orders.edit');
    Route::put('/{order}/update', [OrderController::class, 'update'])->name('api.orders.update');
});