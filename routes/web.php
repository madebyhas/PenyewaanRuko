<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Penyewa\DashboardController;
use App\Http\Controllers\Admin\Ruko\RukoController;
use App\Http\Controllers\Admin\Laporan\LaporanController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\AdminDashboardController;
use App\Http\Controllers\Penyewa\Ruko\TagihanController;
use App\Http\Controllers\Penyewa\Ruko\SewaRukoController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Penyewa\Auth\PenyewaLoginController;
use App\Http\Controllers\Penyewa\Auth\PenyewaRegisterController;

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
    return view('landing.welcome');
});

//Route Admin Auth
Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);
});

//Route Penyewa Auth
Route::middleware('guest')->group(function () {
    Route::get('register', [PenyewaRegisterController::class, 'create'])->name('register');

    Route::post('register', [PenyewaRegisterController::class, 'store']);

    Route::get('login', [PenyewaLoginController::class, 'create'])->name('login');

    Route::post('login', [PenyewaLoginController::class, 'store']);
});

//Ruote Penyewa Pada Dasboard
Route::middleware('auth:penyewa')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Sewa Ruko Pada Dashboard
    Route::get('/chart', [SewaRukoController::class, 'chart'])->name('chart');
    Route::post('/checkout', [SewaRukoController::class, 'checkout'])->name('checkout');
    Route::post('/remove-from-cart/{ruko_id}', [RukoController::class, 'removeFromCart'])->name('ruko.remove');


    // Route Tagihan Ruko Pada Dashboard
    Route::get('/create-tagihan', [TagihanController::class, 'tagihan'])->name('checkout.tagihan');
    Route::post('/tagihan/upload', [TagihanController::class, 'upload'])->name('tagihan.upload');
    Route::get('/riwayat', [TagihanController::class, 'riwayat'])->name('riwayat.tagihan');

    // Route Ruko chart Pada Dashboard
    Route::post('/ruko/add-to-cart', [RukoController::class, 'addToCartRuko'])->name('ruko.addToCart');
    // Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
    Route::post('logout', [PenyewaLoginController::class, 'destroy'])->name('penyewa.logout');
});

//Ruote Admin Pada Dashboard
Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // Route Pada Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Route Addadmin Pada Dashboard
    Route::get('admin-tampil', [RegisteredUserController::class, 'tampil'])->name('tampil.admin');
    Route::post('admin-tambah', [RegisteredUserController::class, 'tambah'])->name('tambah.admin');
    Route::resource('admin', RegisteredUserController::class);
    
    // Route addPenyewa Pada Dashboard
    Route::get('penyewa-tampil', [PenyewaRegisterController::class, 'tampil'])->name('tampil.penyewa');
    Route::post('penyewa-tambah', [PenyewaRegisterController::class, 'tambah'])->name('tambah.penyewa');
    Route::resource('penyewa', PenyewaRegisterController::class);
    
    // Route Laporan Pada Dashboard
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('getLaporan', [LaporanController::class, 'getLaporan'])->name('laporan.getLaporan');
    Route::get('laporan/cetak/{from}/{to}', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetakLaporan');



    // Route Ruko Pada Dashboard
    Route::resource('ruko', RukoController::class);

    // // Route Sewa Ruko Pada Dashboard
    Route::resource('sewaruko', SewaRukoController::class);

    // Route Tagihan Ruko Pada Dashboard
    Route::resource('tagihan', TagihanController::class);

    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
});


