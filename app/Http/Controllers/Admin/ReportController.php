<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $data = Order::orderBy('created_at', 'desc')->limit('10')->get();
        return view('admin.report.index', compact('data'));
    }

    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::whereBetween('created_at', [$request->start_date, $request->end_date])->orderBy('created_at', 'desc')->get();
            return view('admin.report.data', compact('data'));
        }
    }

    public function pdfReportOrder(Request $request)
    {
        $data = Order::whereBetween('created_at', [$request->get('start_date'), $request->get('end_date')])->orderBy('created_at', 'desc')->get();
        $pdf = Pdf::loadView('pdf.report-order', [
            'data' => $data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ])->setPaper('a4', 'potrait');
        return $pdf->download("Laporan-Pesanan-" . $request->start_date . "-" . $request->end_date  . ".pdf");
    }
}
