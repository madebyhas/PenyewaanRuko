<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Ruko\RukoController;
use App\Http\Controllers\Penyewa\DashboardController;
use App\Http\Controllers\Penyewa\Ruko\TagihanController;
use App\Http\Controllers\Penyewa\Ruko\SewaRukoController;
use App\Http\Controllers\Penyewa\Auth\PenyewaLoginController;
use App\Http\Controllers\Penyewa\Auth\PenyewaRegisterController;

//Route Penyewa Auth
Route::middleware('guest')->group(function () {
    Route::get('register', [PenyewaRegisterController::class, 'create'])->name('register');

    Route::post('register', [PenyewaRegisterController::class, 'store']);

    Route::get('login', [PenyewaLoginController::class, 'create'])->name('login');

    Route::post('login', [PenyewaLoginController::class, 'store']);
});

//Ruote Penyewa Pada Login
Route::middleware('auth:penyewa')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route Sewa Ruko Pada Dashboard
    Route::resource('sewaruko', SewaRukoController::class);

    // Route Tagihan Ruko Pada Dashboard
    Route::resource('tagihan', TagihanController::class);

    // Route Ruko chart Pada Dashboard
    Route::post('/ruko/add-to-cart', [RukoController::class, 'addToCartRuko'])->name('ruko.addToCart');
    // Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
    Route::post('logout', [PenyewaLoginController::class, 'destroy'])->name('penyewa.logout');
});

