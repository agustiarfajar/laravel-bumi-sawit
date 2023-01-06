<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProdukKategoriController;
use App\Http\Controllers\ProdukController;

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
Route::get('/', [HomeController::class, 'index']);
Route::get('produk', [HomeController::class, 'produk']);
Route::get('produk-kategori/{id}', [HomeController::class, 'produk_by_kategori']);
Route::get('detail-produk/{slug}', [HomeController::class, 'detail_produk']);
Route::get('tentang', [HomeController::class, 'tentang']);
Route::get('kontak', [HomeController::class, 'kontak']);

// AUTH
Route::get('login', [AuthController::class, 'showLogin']);
Route::post('doLogin', [AuthController::class, 'doLogin']);
Route::get('register', [AuthController::class, 'showRegister']);
Route::post('doRegister', [AuthController::class, 'doRegister']);
Route::get('doLogout', [AuthController::class, 'doLogout']);
// END AUTH

// User Need Login
Route::group(['middleware' => ['login']], function(){
    Route::get('profil', [ProfilController::class, 'index']);
    Route::post('profil-update/{id}', [ProfilController::class, 'updateProfil']);
    Route::get('ubah-password', [ProfilController::class, 'ubah_password']);
    Route::post('update-password/{id}', [ProfilController::class, 'update_password']);
    Route::get('pesanan', [ProfilController::class, 'pesanan']);
    Route::post('add-to-cart/{id}', [HomeController::class, 'addToCart']);
    Route::post('update-cart', [HomeController::class, 'updateCart']);
    Route::get('delete-cart/{id}', [HomeController::class, 'deleteCart']);
    Route::get('keranjang', [HomeController::class, 'keranjang']);
    Route::post('doCheckout', [HomeController::class, 'doCheckout']);
    Route::get('checkout', [HomeController::class, 'checkout']);
    Route::post('save-pesanan', [HomeController::class, 'save_pesanan']);
});
// End User Need Login
// ---------------ADMIN SECTION -------------------- //
// ADMIN
Route::get('admin/login', [AuthAdminController::class, 'showLogin']);
Route::post('doLoginAdmin', [AuthAdminController::class, 'doLogin']);
Route::get('doLogoutAdmin', [AuthAdminController::class, 'doLogout']);

Route::group(['middleware' => ['login_admin']], function(){
    Route::get('admin/dashboard', [AuthAdminController::class, 'dashboard']);

    Route::resource('admin-produk-kategori', ProdukKategoriController::class);
    Route::resource('admin-produk', ProdukController::class);
    Route::get('pesanan-user', [AuthAdminController::class, 'pesanan_user']);
    Route::post('update-pesanan-admin/{id}', [AuthAdminController::class, 'update_pesanan']);
});
// END ADMIN