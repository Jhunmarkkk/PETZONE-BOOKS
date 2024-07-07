<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ChartController extends Controller
{
    public function pieChart()
{
    $result = DB::select(DB::raw("SELECT c.title AS category_title, COUNT(p.id) AS products_count FROM CATEGORIES c LEFT JOIN PRODUCTS p ON c.id = p.category_id GROUP BY c.id, c.title"));
    $data = "";
    foreach ($result as $val) {
        $data .= "['" . $val->category_title . "', " . $val->products_count . "],";
    }
    $chartData = $data;

    return view('admin.charts.pie', compact('chartData'));
}

public function lineChart()
{
    $result = DB::select(DB::raw("SELECT c.title AS category_title, COUNT(p.id) AS product_count, SUM(p.stock) AS total_stock FROM CATEGORIES c JOIN PRODUCTS p ON c.id = p.category_id GROUP BY c.title"));

    $data = "";

    foreach ($result as $val) {
        // Push each row of data into the $data array
        $data .= "['" . $val->category_title . "', " . $val->product_count . ", " . $val->total_stock . "],";
    }

    $chartData = $data;

    // Pass the $chartData array to the view
    return view('admin.charts.line', compact('chartData'));
}

    public function barChart()
{
    $result = DB::select(DB::raw("SELECT c.title AS category_title, SUM(p.stock) AS total_stock FROM CATEGORIES c JOIN PRODUCTS p ON c.id = p.category_id GROUP BY c.title"));
    $data = "";
    foreach ($result as $val) {
        $data .= "['" . $val->category_title . "', " . $val->total_stock . "],";
    }
    $chartData = $data;

    return view('admin.charts.bar', compact('chartData'));
}

    

}
