<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $new_arrivals = Product::orderBy('id', 'desc')->limit(4)->get();
        $brands = Brand::with(['product', 'product.category', 'product.brand'])->whereHas('product')->inRandomOrder()->limit(4)->get();
        return view('website.home.index', [
            'new_arrivals' => $new_arrivals,
            'brands' => $brands,
        ]);
    }
}
