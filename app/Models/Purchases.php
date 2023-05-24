<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function details(){
        return $this->hasMany(PurchasesDetail::class);
    }
    public function sup(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
