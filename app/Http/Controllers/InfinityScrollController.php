<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class InfinityScrollController extends Controller
{
    /**
     * Display a listing of the products with infinite scroll.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::paginate(3); // Adjust the number of products per page

        if ($request->ajax()) {
            return view('frontend.partials.products-list', compact('products'))->render();
        }

        return view('frontend.index', compact('products'));
    }

    /**
     * Fetch discounted books.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchDiscountedBooks()
    {
        $discountedBooks = Product::whereNotNull('percent_discount')->paginate(10);

        return view('frontend.partials.discounted-books-list', compact('discountedBooks'))->render();
    }

    /**
     * Show home page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $popularCategories = ['War', 'Historical', 'Psychology'];
        $all = OwnerValues::geCategoriesWithProducts();
        $discountedBooks = Product::whereNotNull('percent_discount')->get();

        return view('frontend.index', compact('popularCategories', 'all', 'discountedBooks'));
    }
}