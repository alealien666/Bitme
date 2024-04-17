<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\QrCodeController;
use App\Http\Controllers\GenerateQRController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RasaController;
use App\Http\Controllers\Admin\listProductController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\user\riwayatPemesananController;

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


// sertifikat
Route::get('sertifikat/{id}', [PemesananController::class, 'showCoa'])->name('sertifikat.show');
Route::get('download-sertifikat/{id}', [PemesananController::class, 'downloadPdf'])->name('download-sertifikat');

// prevent back denied
Route::group(['middleware' => 'preventBack'], function () {
    Route::get('company', function () {
        return view('company');
    });
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);

    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [LoginController::class, 'index']);
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/register', [RegisterController::class, 'store']);
    });

    // admin & super admin
    Route::middleware(['auth'])->group(function () {
        Route::prefix('Admin')->group(function () {
            Route::middleware(['auth', 'role:0'])->group(function () {
                Route::get('/user', [UserController::class, 'index'])->name('Admin.crudUser');
                Route::post('/user/add', [UserController::class, 'store'])->name('Admin.user.store');
                Route::post('/user/update/{id}', [UserController::class, 'update'])->name('Admin.user.update');
                Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('Admin.user.destroy');
            });
            Route::middleware(['auth', 'role:0 , 1'])->group(function () {
                // list product
                Route::get('/list-product', [listProductController::class, 'index'])->name('Admin.list-product.index');
                Route::post('/list-product/add', [listProductController::class, 'store'])->name('Admin.list-product.store');
                Route::post('/list-product/update/{id}', [listProductController::class, 'update'])->name('Admin.list-product.update');
                Route::delete('/list-product/destroy/{id}', [listProductController::class, 'destroy'])->name('Admin.list-product.destroy');

                // list Rasa
                Route::get('/list-rasa', [RasaController::class, 'index'])->name('Admin.list-rasa');
                Route::post('/list-rasa/add', [RasaController::class, 'store'])->name('Admin.list-rasa.store');
                Route::post('/list-rasa/update/{id}', [RasaController::class, 'update'])->name('Admin.list-rasa.update');
                Route::delete('/list-rasa/delete/{id}', [RasaController::class, 'destroy'])->name('Admin.list-rasa.destroy');

                // pemesanan
                Route::get('/list-pemesanan', [PemesananController::class, 'index'])->name('Admin.list-pemesanan.index');
                Route::post('/riwayat-pemesanan/verifikasi/{id}', [PemesananController::class, 'verifikasi'])->name('riwayat-pemesanan.verifikasi');

                // logout
                Route::get('/metu', [LoginController::class, 'logout'])->name('metu');
            });
        });

        // user
        Route::middleware(['auth', 'role:2'])->group(function () {
            Route::get('/user', [HomeController::class, 'profil']);
            Route::get('/order', [OrderController::class, 'show'])->name('order'); //->middleware('CheckOrder');
            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
            Route::post('/orderr', [OrderController::class, 'store'])->name('orderProduct');

            // riwayat pemesanan
            Route::get('/user/riwayat-pemesanan', [riwayatPemesananController::class, 'index'])->name('riwayat-pemesanan.index');
            Route::post('/riwayat-pemesanan/upload/{id}', [OrderController::class, 'uploadPembayaran'])->name('upload-pembayaran');
            Route::delete('batal/{id}', [riwayatPemesananController::class, 'batal'])->name('batalkan-pesanan');

            // redeem kode
            Route::get('/redeem', [QrCodeController::class, 'index']);
            Route::get('/redeem/{kode}', [QrCodeController::class, 'show'])->name('redeem.page');
            Route::post('/postKode', [QRCodeController::class, 'redeem'])->name('redeemKode');

            // tukar kode
            Route::post('/tukarKode', [QrCodeController::class, 'tukarCodeRedeem'])->name('tukarCode');
        });
    });
});

Route::get('/code', [GenerateQrController::class, 'generateAndShowQrCode']);
