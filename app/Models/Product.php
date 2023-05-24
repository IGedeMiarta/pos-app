<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = ['id'];

    public function kategori(){
        return $this->belongsTo(Categories::class,'category_id');
    }
    public function temp(){
        return $this->hasMany(temp::class);
    }

    public function order(){
        return $this->hasMany(OrderDetail::class);
    }
}
