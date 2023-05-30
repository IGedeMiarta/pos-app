<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\IgnoreFunctionForCodeCoverage;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'order_details';

    public function produk(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
