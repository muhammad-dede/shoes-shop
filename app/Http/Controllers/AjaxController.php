<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function productVariantQty(Request $request)
    {
        if ($request->id) {
            $product_variant = ProductVariant::where('id', $request->id)->first();
        }
        return response()->json(['data' => $product_variant ?? null]);
    }
}
