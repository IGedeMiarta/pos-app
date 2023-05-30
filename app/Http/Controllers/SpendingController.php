<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Spending;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Pengeluaran';
        $data['table'] = Spending::all();
        return view('spending.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            Spending::create([
                'trx' => $request->trx,
                'name' => $request->name,
                'balance' => $request->balance,
                'type'     => $request->type
            ]);

            $company = Company::find(1);
            $transaction = New Transaction();
            $transaction->company_id = $company->id;
            $transaction->amount =  $request->balance;
            $transaction->pos_balance = $company->balance - $request->balance;
            $transaction->type = "-";
            $transaction->trx = $request->trx;
            $transaction->details = 'Spending & Pengeluaran '. $request->type;
            $transaction->remark = 'spending';
            $transaction->save();

            DB::commit();
            return redirect()->back()->with('success','Pengeluaran Baru Ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Spending $spending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spending $spending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spending $spending)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spending $spending)
    {
        //
    }
}
