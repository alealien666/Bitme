<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\QrCodeController;
use App\Http\Controllers\GenerateQRController;
use App\Http\Controllers\user\LabController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\Admin\listAlatController;
use App\Http\Controllers\Admin\listLabsController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\Admin\listAnalisesController;
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
                // list alat
                Route::get('/list-alat', [listAlatController::class, 'index'])->name('Admin.list-alat.index');
                Route::post('/list-alat/add', [listAlatController::class, 'store'])->name('Admin.list-alat.store');
                Route::post('/list-alat/update/{id}', [listAlatController::class, 'update'])->name('Admin.list-alat.update');
                Route::delete('/list-alat/destroy/{id}', [listAlatController::class, 'destroy'])->name('Admin.list-alat.destroy');

                // list labs
                Route::get('/list-labs', [listLabsController::class, 'index'])->name('Admin.list-labs.index');
                Route::post('/list-labs/add', [listLabsController::class, 'store'])->name('Admin.list-labs.store');
                Route::post('/list-labs/update/{id}', [listLabsController::class, 'update'])->name('Admin.list-labs.update');
                Route::delete('/list-labs/destroy/{id}', [listLabsController::class, 'destroy'])->name('Admin.list-labs.destroy');

                // analises
                Route::post('/riwayat-pemesanan/verifikasi/{id}', [PemesananController::class, 'verifikasi'])->name('riwayat-pemesanan.verifikasi');


                // pemesanan
                Route::get('/list-pemesanan', [PemesananController::class, 'index'])->name('Admin.list-pemesanan.index');
                Route::get('/metu', [LoginController::class, 'logout'])->name('metu');

                // entry hasil
                Route::post('/entriData/{id}', [PemesananController::class, 'entryDataHasilAnalisis'])->name('hasilAnalisis');
            });
        });

        // user
        Route::middleware(['auth', 'role:2'])->group(function () {
            Route::get('/user', [HomeController::class, 'profil']);
            Route::get('/order', [OrderController::class, 'show'])->name('order'); //->middleware('CheckOrder');
            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
            Route::post('/orderr', [OrderController::class, 'store'])->name('orderProduct');
            Route::post('/riwayat-pemesanan/upload/{id}', [OrderController::class, 'uploadPembayaran'])->name('upload-pembayaran');

            // riwayat pemesanan
            Route::get('/user/riwayat-pemesanan', [riwayatPemesananController::class, 'index'])->name('riwayat-pemesanan.index');

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
