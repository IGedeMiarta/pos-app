<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\temp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tempController extends Controller
{
    public function push(Request $request){
        $product = Product::findorfail($request->product_id);
          //update stock 
        // if(isset($request->type) && $product->product_quantity <  $request->qty){
        //     return response()->json(['status'=>0,'msg'=>'Product Out Of Stock']);
        // }
        DB::beginTransaction();
        try {
            $price = $request->harga?? $product->product_price;
            temp::create([
                'ref'           => $request->ref,
                'product_id'    => $request->product_id,
                'quantity'      => $request->qty,
                'price'         => $price,
                'sub_total'     => $price * $request->qty,
            ]);
            DB::commit();
            return response()->json(['status'=>1]);
        } catch (\Throwable $th) {
           DB::rollBack();
           return response()->json(['status'=>0,'msg'=>$th->getMessage()]);
        }
    }
    public function table($id){
        $data = temp::with('produk')->where('ref',$id)->get();
        $rs = [];
        $t_price = 0;
        $t_total = 0;
        $_qty = 0;
        foreach ($data as $key => $value) {
           $rs[] = [
            'no'        => $key+1,
            'product'   => $value->produk->product_name,
            'qty'       => $value->quantity,
            'price'     => $value->price,
            'total'     => $value->sub_total,
           ];
           $t_price += $value->price;
           $t_total += $value->sub_total;
           $_qty += $value->quantity;
        }
        return response()->json(['status'=>1,'data'=>$rs,'price'=>$t_price,'total'=>$t_total,'qty'=>$_qty]);
    }
}
