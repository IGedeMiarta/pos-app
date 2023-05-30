<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Customer';
        $data['table'] = Customer::all();
        return view('peoples.customer',$data);
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
          DB::beginTransaction();
        try {
            Customer::create($request->all());
            DB::commit();
            return redirect()->back()->with('success','Data Ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Error: '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        
        DB::beginTransaction();
        try {
            $customer->update($request->all());
            DB::commit();
            return redirect()->back()->with('success','Data Diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Error: '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
         DB::beginTransaction();
        try {
            $customer->delete();
            DB::commit();
            return redirect()->back()->with('success','Data Dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Error: '.$th->getMessage());
        }
    }
}
