<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('id_user', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('website.cart.index', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_product' => ['required', 'exists:product,id'],
            'id_product_variant' => ['required', 'exists:product_variant,id'],
            'qty' => ['required', 'numeric'],
        ], [], [
            'id_product' => __('Produk'),
            'id_product_variant' => __('Ukuran'),
            'qty' => __('Quantity'),
        ]);
        DB::beginTransaction();
        try {
            $cart = Cart::where('id_user', auth()->id())->where('id_product_variant', $request->id_product_variant)->first();
            if ($cart) {
                $cart->update([
                    'qty' => $cart->qty + $request->qty,
                    'sub_total' => $cart->product->price * ($cart->qty + $request->qty),
                    'weight' => $cart->product->weight * ($cart->qty + $request->qty),
                    'discount' => ($cart->product->price * $cart->product->discount / 100) * ($cart->qty + $request->qty),
                    'total' => ($cart->product->price * ($cart->qty + $request->qty)) - (($cart->product->price * $cart->product->discount / 100) * ($cart->qty + $request->qty)),
                ]);
            } else {
                $product = Product::where('id', $request->id_product)->first();
                $cart = Cart::create([
                    'id_user' => auth()->id(),
                    'id_product' => $request->id_product,
                    'id_product_variant' => $request->id_product_variant,
                    'qty' => $request->qty,
                    'sub_total' => $product->price * $request->qty,
                    'weight' => $product->weight * $request->qty,
                    'discount' => ($product->price * $product->discount / 100) * $request->qty,
                    'total' => ($product->price * $request->qty) - (($product->price * $product->discount / 100) * $request->qty),
                ]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return redirect()->route('cart.index')->with('success', 'Berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart.*.id_product' => ['required', 'exists:product,id'],
            'cart.*.id_product_variant' => ['required', 'exists:product_variant,id'],
            'cart.*.qty' => ['required', 'numeric'],
        ], [], [
            'cart.*.id_product' => __('Product'),
            'cart.*.id_product_variant' => __('Ukuran'),
            'cart.*.qty' => __('Quantity'),
        ]);
        DB::beginTransaction();
        try {
            foreach ($request->cart as $key => $value) {
                $product = Product::where('id', $value['id_product'])->first();
                Cart::where('id_user', auth()->id())->where('id_product', $value['id_product'])->where('id_product_variant', $value['id_product_variant'])->update([
                    'qty' => $value['qty'],
                    'sub_total' => $product->price * $value['qty'],
                    'weight' => $product->weight * $value['qty'],
                    'discount' => ($product->price * $product->discount / 100) * $value['qty'],
                    'total' => ($product->price * $value['qty']) - (($product->price * $product->discount / 100) * $value['qty']),
                ]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return redirect()->route('cart.index')->with('success', 'Berhasil diubah!');
    }

    public function delete(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Berhasil dihapus');
    }
}
