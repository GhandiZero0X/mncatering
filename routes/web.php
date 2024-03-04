<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SnackController;
use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Pages
Route::get('/', [PagesController::class, 'index']);
Route::get('/shop', [PagesController::class, 'shop']);
Route::get('/detailshop/{id}', [PagesController::class, 'detailshop']);

// Login & Register
Route::get('/login', [AuthController::class, 'index']);
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register/store', [AuthController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth','checkRole:admin']], function(){

    Route::get('/home', [HomeController::class, 'index']);

    // Setting Apps
    Route::get('/aplikasi', [AplikasiController::class, 'index']);
    Route::post('/aplikasi/update/{id}', [AplikasiController::class, 'update']);

    // Data User
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/pelanggan', [UserController::class, 'pelanggan']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);

    // Data Snack
    Route::get('/snack', [SnackController::class, 'index']);
    Route::post('/snack/store', [SnackController::class, 'store']);
    Route::post('/snack/update/{id}', [SnackController::class, 'update']);
    Route::get('/snack/destroy/{id}', [SnackController::class, 'destroy']);

    // Data Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/detail/{no_transaksi}', [TransaksiController::class, 'detail']);
    Route::get('/transaksi/cetak/{no_transaksi}', [TransaksiController::class, 'cetak']);
    Route::post('/transaksi/proses/{id}', [TransaksiController::class, 'proses']);
    Route::post('/transaksi/tolak/{id}', [TransaksiController::class, 'tolak']);
    Route::post('/transaksi/refund/{id}', [TransaksiController::class, 'refund']);

    // Data Laporan
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::post('/laporan/cetak', [LaporanController::class, 'cetak']);

});

Route::group(['middleware' => ['auth','checkRole:pelanggan']], function(){

    // Base
    Route::get('/homeUser', [BaseController::class, 'index']);
    Route::get('/shopUser', [BaseController::class, 'shopUser']);
    Route::get('/detailshopUser/{id}', [BaseController::class, 'detailshopUser']);

    // Keranjang
    Route::get('/keranjang', [BaseController::class, 'keranjang']);
    Route::post('/keranjang/addToCart', [BaseController::class, 'addToCart']);
    Route::post('/keranjang/updateCart', [BaseController::class, 'updateCart']);
    Route::post('/keranjang/increaseQty', [BaseController::class, 'increaseQty']);
    Route::post('/keranjang/decreaseQty', [BaseController::class, 'decreaseQty']);
    Route::get('/keranjang/deleteCart/{id}', [BaseController::class, 'deleteCart']);

    // Checkout
    Route::get('/checkout', [BaseController::class, 'checkout']);
    Route::post('/checkout/store', [BaseController::class, 'store']);

    // Pesanan
    Route::get('/pesanan', [BaseController::class, 'pesanan']);
    Route::get('/pembayaran', [BaseController::class, 'pembayaran']);
    Route::get('/pesanan/detailpesanan/{no_transaksi}', [BaseController::class, 'detailpesanan']);
    Route::get('/pesanan/cetak/{no_transaksi}', [BaseController::class, 'cetak']);

    Route::post('/pesanan/uploaddp/{id}', [BaseController::class, 'uploaddp']);
    Route::post('/pesanan/uploadlunas/{id}', [BaseController::class, 'uploadlunas']);
    Route::post('/pesanan/refund/{id}', [BaseController::class, 'refund']);

    // Data User
    // Route::get('/user', [UserController::class, 'pelanggan2']);
    // Route::get('/pelanggan', [UserController::class, 'pelanggan']);
    // Route::post('/pelanggan/store2', [UserController::class, 'store2']);
    // Route::post('/pelanggan/update2/{id}', [UserController::class, 'update2']);
    // Route::get('/pelanggan/destroy2/{id}', [UserController::class, 'destroy2']);
    
});
