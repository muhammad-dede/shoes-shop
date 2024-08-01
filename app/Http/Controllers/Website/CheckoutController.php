<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\OrderShipping;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    protected $api_key = '4618e86ae5108c96e2bb230e660fa7db';
    protected $origin_province = '3';
    protected $origin_city = '403';

    public function index(Request $request)
    {
        $carts = Cart::with(['product', 'productVariant'])->where('id_user', auth()->id())->get();
        if ($carts->count() == 0) return redirect()->route('cart.index');
        $provinces = Http::withHeaders([
            'key' => $this->api_key,
        ])->get('https://api.rajaongkir.com/starter/province')['rajaongkir']['results'];
        if ($request->ajax()) {
            if ($request->id_province) {
                $cities = Http::withHeaders([
                    'key' => $this->api_key,
                ])->get('https://api.rajaongkir.com/starter/city?province=' . $request->id_province)['rajaongkir']['results'];
                return response()->json(['cities' => $cities]);
            }
            if ($request->id_city && $request->code_courier) {
                $courier_services = Http::withHeaders([
                    'key' => $this->api_key,
                ])->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => $this->origin_city,
                    'destination' => $request->id_city,
                    'weight' => $carts->sum('weight'),
                    'courier' => $request->code_courier,
                ])['rajaongkir']['results'];
                return response()->json(['courier_services' => $courier_services]);
            }
        }
        return view('website.checkout.index', compact('carts', 'provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'id_province' => ['required', 'string'],
            'id_city' => ['required', 'string'],
            'street_address' => ['required', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:255'],
            'code_courier' => ['required', 'string', 'exists:courier,code'],
            'service' => ['required', 'string'],
            'description' => ['required', 'string'],
            'etd' => ['required', 'string'],
            'cost' => ['required', 'numeric'],
            'id_bank_account' => ['required', 'string', 'exists:bank_account,id'],
            'total_price' => ['required', 'numeric'],
            'total_weight' => ['required', 'numeric'],
            'discount_amount' => ['required', 'numeric'],
            'shipping_cost' => ['required', 'numeric'],
            'payment_amount' => ['required', 'numeric'],
        ]);
        DB::beginTransaction();
        try {
            $user_address =  UserAddress::updateOrCreate([
                'id_user' => auth()->id(),
            ], [
                'id_user' => auth()->id(),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'id_province' => $request->id_province,
                'id_city' => $request->id_city,
                'street_address' => $request->street_address,
                'postal_code' => $request->postal_code,
                'phone' => $request->phone,
                'default' => 1,
            ]);
            $order = Order::create([
                'no_order' => Str::random(20),
                'id_user' => $user_address->id_user,
                'id_user_address' => $user_address->id,
                'note' => $request->note,
                'total_price' => $request->total_price,
                'total_weight' => $request->total_weight,
                'discount_amount' => $request->discount_amount,
                'shipping_cost' => $request->shipping_cost,
                'payment_amount' => $request->payment_amount,
                'id_status' => 1,
            ]);
            $carts = Cart::where('id_user', auth()->id())->get();
            foreach ($carts as $key => $cart) {
                OrderItem::create([
                    'id_order' => $order->id,
                    'id_product' => $cart->id_product,
                    'id_product_variant' => $cart->id_product_variant,
                    'qty' => $cart->qty,
                    'sub_total' => $cart->sub_total,
                    'weight' => $cart->weight,
                    'discount' => $cart->discount,
                    'total' => $cart->total,
                ]);
                $cart->delete();
            }
            OrderShipping::create([
                'id_order' => $order->id,
                'code_courier' => $request->code_courier,
                'service' => $request->service,
                'description' => $request->description,
                'etd' => $request->etd,
                'cost' => $request->cost,
            ]);
            OrderPayment::create([
                'id_order' => $order->id,
                'id_bank_account' => $request->id_bank_account,
                'transfer_date' => null,
                'account_name' => null,
                'account_number' => null,
                'bank_name' => null,
                'transfer_receipt' => null,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        return redirect()->route('order.index')->with('success', 'Pesanan berhasil dibuat');
    }
}
