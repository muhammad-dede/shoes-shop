<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['brand', 'category', 'productVariant']);
        if ($request->get('search')) {
            $products = $products->where('name', 'like', '%' . $request->get('search') . '%');
        }
        if ($request->get('brand')) {
            $brands = explode('.', $request->get('brand'));
            $products = $products->orWhereHas('brand', function ($query) use ($brands) {
                $query->whereIn('slug', $brands);
            });
        }
        if ($request->get('category')) {
            $categories = explode('.', $request->get('category'));
            $products = $products->orWhereHas('category', function ($query) use ($categories) {
                $query->whereIn('slug', $categories);
            });
        }
        if ($request->get('sort')) {
            if ($request->get('sort') == 'new') $products = $products->orderBy('id', 'desc');
            if ($request->get('sort') == 'asc_price') $products = $products->orderBy('price', 'asc');
            if ($request->get('sort') == 'desc_price') $products = $products->orderBy('price', 'desc');
            if ($request->get('sort') == 'asc_name') $products = $products->orderBy('price', 'asc');
            if ($request->get('sort') == 'desc_name') $products = $products->orderBy('price', 'desc');
        }
        $products = $products->paginate(9);
        return view('website.product.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) return abort(404);
        $related_products = Product::with(['brand', 'category'])->where('id_category', $product->id_category)->inRandomOrder(4)->get();
        return view('website.product.show', compact('product', 'related_products'));
    }
}
