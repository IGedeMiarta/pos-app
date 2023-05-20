<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Kategori';
        $data['table'] = Categories::all();
        return view('product.category',$data);
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
            Categories::create($request->all());
            DB::commit();
            return redirect()->back()->with('success','Data Ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Error '.$th->getMessage());
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
        $cek = Categories::find($id);
        if(!$cek){
            return back()->with('error','Data Tidak Ditemukan');
        }
        DB::beginTransaction();
        try {
            $cek->update($request->all());
            DB::commit();
            return back()->with('success','Data Diupdate');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error','Error: '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cek = Categories::find($id);
        if(!$cek){
            return back()->with('error','Data Tidak Ditemukan');
        }
        $cek->delete();
        return back()->with('success','Data Dihapus');

    }
}
