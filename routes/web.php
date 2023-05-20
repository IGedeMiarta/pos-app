<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('home',function(){
    return view('main.dashboard');
});
Route::resource('kategori',KategoriController::class);
Route::get('tambah-produk',[ProductController::class,'tambah']);
Route::resource('produk',ProductController::class);
Route::resource('customers',CustomerController::class);
Route::resource('suppliers',SupplierController::class);

Route::resource('pembelian',PurchasesController::class);
Route::get('tambah-pembelian',[PurchasesController::class,'create']);