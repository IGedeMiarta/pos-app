<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index(){
        $data['title'] = 'Dashboard';
        $data['product'] = Product::all();
        $data['customer'] = Customer::all();
        $data['order'] = Order::where('status',1)->get();
        $data['pembelian'] = Transaction::where('type',"-")->sum('amount');
        $data['penjualan'] = Transaction::where('type',"+")->sum('amount');
        return view('main.dashboard',$data);
     }
}
