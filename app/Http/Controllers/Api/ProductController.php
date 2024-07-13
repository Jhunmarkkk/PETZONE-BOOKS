<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index() {
        $products = Product::with('category')->get(); // Ensure category is loaded
        return response()->json($products);
    }

    public function show(Product $product) {
        return response()->json($product->load('category')); // Ensure category is loaded
    }

    public function categories() {
        $categories = Product::select('category')->distinct()->get();
        return response()->json($categories);
    }
}