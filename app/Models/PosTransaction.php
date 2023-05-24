<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosTransaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function cust(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
