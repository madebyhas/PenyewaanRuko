<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Ruko\RukoController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Penyewa\DashboardController;
use App\Http\Controllers\Penyewa\Ruko\TagihanController;
use App\Http\Controllers\Penyewa\Ruko\SewaRukoController;
use App\Http\Controllers\Penyewa\Ruko\PembayaranController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Penyewa\Auth\PenyewaLoginController;
use App\Http\Controllers\Penyewa\Auth\PenyewaRegisterController;

//Route Admin Auth
Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);
});

// //Route Penyewa Auth
// Route::middleware('guest')->group(function () {
//     Route::get('register', [PenyewaRegisterController::class, 'create'])->name('register');

//     Route::post('register', [PenyewaRegisterController::class, 'store']);

//     Route::get('login', [PenyewaLoginController::class, 'create'])->name('login');

//     Route::post('login', [PenyewaLoginController::class, 'store']);
// });

// //Ruote Penyewa Pada Login
// Route::middleware('auth:penyewa')->group(function () {
//     // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     // Route Sewa Ruko Pada Dashboard
//     Route::resource('sewaruko', SewaRukoController::class);

//     // Route Ruko chart Pada Dashboard
//     Route::post('/ruko/add-to-cart/{id}', [RukoController::class, 'addToCartRuko'])->name('ruko.addToCart');
//     // Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
//     Route::post('logout', [PenyewaLoginController::class, 'destroy'])->name('penyewa.logout');
// });

//Ruote Admin Pada Dashboard
Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Route Ruko Pada Dashboard
    Route::get('admin-tampil', [RegisteredUserController::class, 'tampil'])->name('tampil.admin');
    Route::post('admin-tambah', [RegisteredUserController::class, 'tambah'])->name('tambah.admin');
    ;

    // Route Ruko Pada Dashboard
    Route::resource('ruko', RukoController::class);

    // // Route Sewa Ruko Pada Dashboard
    // Route::resource('sewaruko', SewaRukoController::class);

    // Route Tagihan Ruko Pada Dashboard
    // Route::resource('tagihan', TagihanController::class);

    // Route Pembayaran Ruko Pada Dashboard
    Route::resource('pembayaran', PembayaranController::class);

    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
});
