<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\tempController;
use App\Http\Controllers\TrxController;
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
Route::group(['middleware' => 'guest'], function () {
    Route::get('/',[AuthController::class,'index'])->name('login');
    Route::post('login',[AuthController::class,'login']);
});

Route::group(['middleware' => 'auth'], function () {
    // Routes that require the 'auth.custom' middleware

    Route::post('logout',[AuthController::class,'logout']);

    Route::get('home',[HomeController::class,'index']);
    Route::resource('kategori',KategoriController::class);
    Route::get('tambah-produk',[ProductController::class,'tambah']);
    Route::resource('produk',ProductController::class);
    Route::resource('customers',CustomerController::class);
    Route::resource('suppliers',SupplierController::class);

    Route::resource('pembelian',PurchasesController::class);
    Route::get('tambah-pembelian',[PurchasesController::class,'create']);

    Route::resource('order',OrderController::class);
    Route::get('tambah-order',[OrderController::class,'create']);

    Route::get('pos',[TrxController::class,'index']);
    Route::post('pos',[TrxController::class,'store']);


    Route::post('temp',[tempController::class,'push'])->name('temp');
    Route::get('temp-table/{id}',[tempController::class,'table']);

    Route::resource('spending',SpendingController::class);

    Route::get('pdf/{id}',[pdfController::class,'pdf']);
    Route::get('nota/{id}',[pdfController::class,'nota']);

});