<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::with(['orderItem', 'orderPayment', 'orderShipping'])->orderBy('created_at', 'desc')->get();
        return view('admin.order.index', compact('data'));
    }

    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }

    public function status(Request $request, Order $order)
    {
        $request->validate([
            'id_status' => ['required', 'exists:status,id'],
            'tracking_number' => ['nullable', Rule::requiredIf(function () use ($order) {
                return $order->id_status == 3;
            }), 'string']
        ]);
        DB::beginTransaction();
        try {
            $order->update([
                'id_status' => $request->id_status,
                'tracking_number' =>  $request->tracking_number ? $request->tracking_number : $order->tracking_number,
            ]);
            if ($order->id_status == 4) {
                foreach ($order->orderItem as $key => $item) {
                    $product_variant =  ProductVariant::where('id', $item->id_product_variant)->first();
                    $product_variant->update([
                        'qty' => $product_variant->qty - $item->qty,
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return redirect()->back()->with('success', 'Berhasil dikirim');
    }
}
