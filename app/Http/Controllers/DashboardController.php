<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    //     // bar chart
    //     $bar_data = DB::table('sales')
    //     ->selectRaw('date, COUNT(*) as total_sales')
    //     ->groupBy('date')
    //     ->orderBy('date', 'ASC')
    //     ->get();

    //    $dates = $bar_data->pluck('date');
    //    $totals = $bar_data->pluck('total_sales');

    //    // pie chart
    //    $pie_data = DB::table('sale_details as sd')
    //        ->join('products as p', 'sd.product_id', '=', 'p.id')
    //        ->selectRaw('p.name, SUM(sd.product_qty) as total_sold')
    //        ->groupBy('p.name')
    //        ->get();

    //    $product_name = $pie_data->pluck('name');
    //    $product_qty = $pie_data->pluck('total_sold');

    //    $today_sale = DB::table('sales as s')
    //        ->where('s.date', '=', Carbon::today())
    //        ->count();

       return view('pages.dashboard');
    }

}
