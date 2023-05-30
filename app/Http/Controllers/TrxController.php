<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use App\Models\PosTransaction;
use App\Models\PosTransactionDetails;
use App\Models\Product;
use App\Models\temp;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrxController extends Controller
{
    public function index()
    {
        $data['title'] = 'Transaction';
        $data['cust'] = Customer::all();
        $data['produk'] = Product::all();
        return view('pos.pos',$data);
    }
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $order =  PosTransaction::Create([
                'reference'             => $request->reference,
                'date'                  => $request->date,
                'due_date'              => $request->due_date,
                'customer_id'           => $request->customer_id,
                'discount_percentage'   => $request->discount_percentage,
                'discount_amount'       => $request->discount_amount,
                'shipping_amount'       => 0,
                'total_amount'          => $request->total,
                'paid_amount'           => $request->dp,
                'due_amount'            => $request->total - $request->dp,
                'status'                => 1,
                'payment_status'        => 1,
                'payment_method'        => $request->method,
                'note'                  => $request->note,
            ]);

            $tempRecords = temp::where('ref',$request->reference)->get();
            foreach ($tempRecords as $tempRecord) {
                 PosTransactionDetails::Create([
                    'pos_id'      => $order->id,
                    'product_id'    => $tempRecord->product_id,
                    'quantity'      => $tempRecord->quantity,
                    'price'         => $tempRecord->price,
                    'sub_total'     => $tempRecord->sub_total,
                 ]);
                   //update stock 
                 $product = Product::find($tempRecord->product_id);
                 $product->product_quantity -= $tempRecord->quantity;
                 $product->save();
            }

            // Delete the copied Temp records
            $tempRecords->each->delete();

            
            $company = Company::find(1);
            
            $transaction = New Transaction();
            $transaction->company_id = $company->id;
            $transaction->amount = $request->dp;
            $transaction->pos_balance = $company->balance + $request->dp;
            $transaction->type = "+";
            $transaction->trx = $request->reference;
            $transaction->details = 'Casher Transaction';
            $transaction->remark = 'pos_trx';
            $transaction->save();

            $company->balance += $request->dp;
            $company->save();
        
            DB::commit();
            
            return redirect()->intended('nota/'.$order->reference)->with('success','Transaction Create');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back()->with('error','Order Error');
        }
    }
}
