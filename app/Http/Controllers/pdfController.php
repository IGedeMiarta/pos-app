<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Purchases;
use App\Models\PurchasesDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class pdfController extends Controller
{
    public function pdf($ref){
        $cekOrder = Order::with(['cust'])->where('reference',$ref)->first();
        if ($cekOrder) {
            $data['data'] = $cekOrder;
            $data['detail'] = OrderDetail::with(['produk'])->where('order_id',$cekOrder->id)->get();
            $pdf = pdf::loadView('pdf.pdf', $data)->setPaper('a4', 'landscape');;
            return $pdf->download('ORDER_INVOICE_'.$ref. '.pdf');
            return view('pdf.pdf',$data);
        }
        $cekPurch = Purchases::with(['sup'])->where('reference',$ref)->first();
        // dd($cekPurch);
        if ($cekPurch) {
            $data['data'] = $cekPurch;
            $data['detail'] = PurchasesDetail::with(['produk'])->where('purchase_id',$cekPurch->id)->get();

            $pdf = pdf::loadView('pdf.pdf', $data)->setPaper('a4', 'landscape');;
            return $pdf->download('PRUCHASE_INVOICE_'.$ref. '.pdf');
            return view('pdf.pdf',$data);

        }
    }
}
