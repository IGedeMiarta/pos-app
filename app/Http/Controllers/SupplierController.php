<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Supplier';
        $data['table'] = Supplier::all();
        return view('peoples.supplier',$data);
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
            Supplier::create($request->all());
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supp = Supplier::find($id);
        if(!$supp){
            return redirect()->back()->with('error','Data Not Found!');
        }
        DB::beginTransaction();
        try {
            $supp->update($request->all());
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
    public function destroy(string $id)
    {
        $supp = Supplier::find($id);
        if(!$supp){
            return redirect()->back()->with('error','Data Not Found!');
        }
        DB::beginTransaction();
        try {
           $supp->delete();
            DB::commit();
            return redirect()->back()->with('success','Data Dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Error: '.$th->getMessage());
        }
    }
}
