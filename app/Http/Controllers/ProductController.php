<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Produk';
        $data['table'] = Product::with(['kategori'])->get();
        return view('product.all-produk',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambah()
    {
        $data['title'] = 'Tambah Produk';
        $data['kategori'] = Categories::all();
        return view('product.addProduk',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required|unique:products',
            'category_id' => 'required',
            'product_cost' => 'required',
            'product_quantity' => 'required',
            'product_note' => 'required',
            'product_barcode_symbology' => 'required',
            'product_price' => 'required',
            'product_stock_alert' => 'required',
            'product_unit' => 'required',
            'image' => 'required',
        ]);
        $img = $request->file('image');
        $filename = Str::slug(strtolower($request->product_name)).'.'.$img->getClientOriginalExtension();
        $path = 'images/produk/';
        $imgSave = $path.$filename;
        $img->move(public_path($path),$filename);
        Product::create([
                'category_id'=> $request->category_id,
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_barcode_symbology' => $request->product_barcode_symbology,
                'product_quantity' => $request->product_quantity,
                'product_cost' => $request->product_cost,
                'product_price' => $request->product_price,
                'product_unit' => $request->product_unit,
                'product_stock_alert' => $request->product_stock_alert,
                'product_note' => $request->product_note,
                'product_image' => $imgSave
        ]);
        return redirect()->back()->with('success','Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Product::find($id);
        if(!$produk){
            return redirect()->back()->with(['error','Data Tidak Ditemukan']);
        }
        $data['title'] = 'Edit Produk';
        $data['i']     = $produk;
        $data['kategori'] = Categories::all();
        return view('product.addProduk',$data);
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
        $produk = Product::find($id);
        if(!$produk){
            return redirect()->back()->with(['error','Data Tidak Ditemukan']);
        }
        $update = [
            'category_id'=> $request->category_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_barcode_symbology' => $request->product_barcode_symbology,
            'product_quantity' => $request->product_quantity,
            'product_cost' => $request->product_cost,
            'product_price' => $request->product_price,
            'product_unit' => $request->product_unit,
            'product_stock_alert' => $request->product_stock_alert,
            'product_note' => $request->product_note,
        ];
        if(isset($request->image)){
            $img = $request->file('image');
            $filename = Str::slug(strtolower($request->product_name)).'.'.$img->getClientOriginalExtension();
            $path = 'images/produk/';
            $imgSave = $path.$filename;
            $image_path = $produk->product_image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $img->move(public_path($path),$filename);
            $update['product_image'] = $imgSave;
        }
        $produk->update($update);
        return redirect('produk')->with('success','Data Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Product::find($id);
        if(!$produk){
            return redirect()->back()->with(['error','Data Tidak Ditemukan']);
        }
        $image_path = $produk->product_image;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $produk->delete();
        
        return redirect('produk')->with('success','Data Dihapus');

    }
}
