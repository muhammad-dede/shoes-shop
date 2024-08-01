<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\File\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    protected $fileService;
    protected $file_path = 'order_payment';

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        $orders = Order::with(['orderItem', 'orderShipping', 'orderPayment'])->where('id_user', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('website.order.index', compact('orders'));
    }

    public function paymentConfirm(Request $request, Order $order)
    {
        DB::beginTransaction();
        try {
            $order_payment = $order->orderPayment()->updateOrCreate(['id_order' => $order->id], [
                'transfer_date' => $request->transfer_date,
                'account_name' => ucwords($request->account_name),
                'account_number' => $request->account_number,
                'bank_name' => strtoupper($request->bank_name),
            ]);
            if ($request->hasFile('transfer_receipt')) {
                if ($order_payment->transfer_receipt) $this->fileService->remove($this->file_path, $order_payment->transfer_receipt);
                $order_payment->update([
                    'transfer_receipt' => Str::uuid() . '.' . $request->transfer_receipt->extension(),
                ]);
                $this->fileService->upload($this->file_path, $request->transfer_receipt, $order_payment->transfer_receipt);
            }
            $order->update([
                'id_status' => 2,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return redirect()->route('order.index')->with('success', 'Konfirmasi Pembayaran Berhasil Dikirim');
    }

    public function cancel(Order $order)
    {
        DB::beginTransaction();
        try {
            $order->update([
                'id_status' => 7,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return redirect()->route('order.index')->with('success', 'Pesanan dibatalkan');
    }

    public function receipt(Order $order)
    {
        DB::beginTransaction();
        try {
            $order->update([
                'id_status' => 6,
                'receipt_date' => now(),
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return redirect()->route('order.index')->with('success', 'Pesanan berhasil diterima');
    }
}
