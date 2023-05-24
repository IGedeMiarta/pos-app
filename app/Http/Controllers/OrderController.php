<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\temp;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Order';
        $data['table'] = Order::with(['cust'])->get();
        return view('order.all',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Order';
        $data['cust'] = Customer::all();
        $data['produk'] = Product::all();
        return view('order.createOrder',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $order =  Order::Create([
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
                 OrderDetail::Create([
                    'order_id'      => $order->id,
                    'product_id'    => $tempRecord->product_id,
                    'quantity'      => $tempRecord->quantity,
                    'price'         => $tempRecord->price,
                    'sub_total'     => $tempRecord->sub_total,
                 ]);
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
            $transaction->details = 'Transaction From Order';
            $transaction->remark = 'order_trx';
            $transaction->save();

            $company->balance += $request->dp;
            $company->save();
        
            DB::commit();
            
            return redirect()->intended('order')->with('success','Order Create');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back()->with('error','Order Error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        DB::beginTransaction();
        try {
            $order->payment_status = 2; //done
            $order->status = 2;
            $order->due_amount = 0;
            $order->save();

            $company = Company::find(1);
            
            $transaction = New Transaction();
            $transaction->company_id = $company->id;
            $transaction->amount = $order->due_amount;
            $transaction->pos_balance = $company->balance + $order->due_amount;
            $transaction->type = "+";
            $transaction->trx = $order->reference;
            $transaction->details = 'Transaction From Order';
            $transaction->remark = 'order_trx';
            $transaction->save();

            $company->balance += $order->due_amount;
            $company->save();
            DB::commit();
            return redirect()->back()->with('success','Order Updated');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('success','Order Error');
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
