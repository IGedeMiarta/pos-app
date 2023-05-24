<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Purchases;
use App\Models\PurchasesDetail;
use App\Models\Supplier;
use App\Models\temp;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Pembelian';
        $data['table'] = Purchases::with(['sup'])->get();
        return view('purchase.allPurch',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Buat Pembelian';
        $data['produk'] = Product::all();
        $data['supplier'] = Supplier::all();
        return view('purchase.createPurchase',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $purchases = Purchases::create([
                'reference' => $request->reference,
                'date' => $request->date,
                'supplier_id' => $request->supplier_id,
                'discount_amount' => $request->discount_amount,
                'shipping_amount' => $request->shipping_amount,
                'payment_status' => $request->payment_status,
                'sub_total' => $request->sub_total,
                'total' => $request->total,
                'status' => $request->payment_status == 1?1:2,
                'payment_status' => $request->payment_status,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
            ]);
           $purchasesId =  $purchases->id;
            $tempRecords = temp::where('ref',$request->reference)->get();
            foreach ($tempRecords as $tempRecord) {
                
                 PurchasesDetail::Create([
                    'purchase_id'      => $purchasesId,
                    'product_id'    => $tempRecord->product_id,
                    'quantity'      => $tempRecord->quantity,
                    'price'         => $tempRecord->price,
                    'sub_total'     => $tempRecord->sub_total,
                 ]);

                 //update stock 
                 $product = Product::find($tempRecord->product_id);
                 $product->product_quantity += $tempRecord->quantity;
                 $product->save();
            }

            // Delete the copied Temp records
            $tempRecords->each->delete();

            $company = Company::find(1);
            
            $transaction = New Transaction();
            $transaction->company_id = $company->id;
            $transaction->amount = $request->total;
            $transaction->pos_balance = $company->balance - $request->total;
            $transaction->type = "-";
            $transaction->trx = $request->reference;
            $transaction->details = 'Transaction From Purchase';
            $transaction->remark = 'order_trx';
            $transaction->save();

            $company->balance -= $request->total;
            $company->save();

            DB::commit();
            return redirect()->intended('pembelian')->with('success','Purchases Created');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchases $purchases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchases $purchases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchases $purchases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchases $purchases)
    {
        //
    }
}
