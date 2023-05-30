<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pembelian(){
        return $this->belongsTo(Purchases::class,'purchase_id');
    }
      public function produk(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
