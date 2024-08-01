<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $total_customer = User::whereHas('roles', function ($query) {
            $query->where('name', 'User');
        })->count();
        $total_product = Product::count();
        $total_order = Order::count();
        $total_brand = Brand::count();
        $get_chart_order = DB::table('order')
            ->select('created_at', DB::raw('count(*) as total'))
            ->groupBy('created_at')
            ->get();
        $chart_order_date = [];
        $chart_order_total = [];
        foreach ($get_chart_order as $key => $value) {
            $chart_order_date[] = Carbon::parse($value->created_at)->isoFormat('Y-MM-DD');
            $chart_order_total[] = $value->total;
        }
        return view('admin.home.index', [
            'total_customer' => $total_customer,
            'total_product' => $total_product,
            'total_order' => $total_order,
            'total_brand' => $total_brand,
            'chart_order_date' => $chart_order_date,
            'chart_order_total' => $chart_order_total,
        ]);
    }
}
