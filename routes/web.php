<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminPengaduanController;
use App\Http\Controllers\AdminPermohonanController;
use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\DataPengaduanController;
use App\Http\Controllers\SuperAdmin\DataPermohonanController;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/about', function () {
    return view('user.about');
})->name('about');



// SUPER ADMIN
Route::middleware(['auth'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            SuperAdminController::class,
            'dashboard'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | DATA ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/data-admin',
            [AdminController::class, 'index']
        )->name('data_admin');


        /*
        |--------------------------------------------------------------------------
        | DATA PENGADUAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/data-pengaduan',
            [DataPengaduanController::class, 'dataPengaduan']
        )->name('data_pengaduan');

        Route::get(
            '/data-pengaduan/{id}',
            [DataPengaduanController::class, 'detailPengaduan']
        )->name('detail_pengaduan');

        Route::post(
            '/data-pengaduan/{id}/update',
            [DataPengaduanController::class, 'update']
        )->name('detail_pengaduan.update');

        Route::put(
            '/data-pengaduan/{id}/update',
            [DataPengaduanController::class, 'updatePengaduan']
        )->name('update_pengaduan');

        Route::put(
            '/data-pengaduan/{id}/status',
            [DataPengaduanController::class, 'updateStatus']
        )->name('update_status_pengaduan');

        Route::delete(
            '/data-pengaduan/{id}',
            [DataPengaduanController::class, 'destroy']
        )->name('delete_pengaduan');


        /*
        |--------------------------------------------------------------------------
        | DATA PERMOHONAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/data-permohonan',
            [DataPermohonanController::class, 'dataPermohonan']
        )->name('data_permohonan');

        Route::get(
            '/data-permohonan/{id}',
            [DataPermohonanController::class, 'detailPermohonan']
        )->name('detail_permohonan');

        Route::delete(
            '/data-permohonan/{id}',
            [DataPermohonanController::class, 'destroy']
        )->name('delete_permohonan');

        Route::put(
            '/data-permohonan/{id}/update',
            [DataPermohonanController::class, 'updatePermohonan']
        )->name('update_permohonan');

    });

// ADMIN PENGADUAN

Route::prefix('adminpengaduan')
    ->name('adminpengaduan.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [AdminPengaduanController::class, 'dashboard']
        )->name('dashboard');

        Route::get(
            '/data-pengaduan',
            [AdminPengaduanController::class, 'dataPengaduan']
        )->name('data_pengaduan');

        Route::get(
            '/detail-pengaduan/{id}',
            [AdminPengaduanController::class, 'detailPengaduan']
        )->name('detail_pengaduan');

        Route::put(
            '/data-pengaduan/{id}/update',
            [AdminPengaduanController::class, 'updatePengaduan']
        )->name('update_pengaduan');

        Route::delete(
            '/data-pengaduan/{id}',
            [AdminPengaduanController::class, 'destroy']
        )->name('delete_pengaduan');
    });


// ADMIN PERMOHONANNNN

Route::prefix('adminpermohonan')
    ->name('adminpermohonan.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [AdminPermohonanController::class, 'dashboard']
        )->name('dashboard');

        Route::get(
            '/data-permohonan',
            [AdminPermohonanController::class, 'dataPermohonan']
        )->name('data_permohonan');

        Route::get(
            '/detail-permohonan/{id}',
            [AdminPermohonanController::class, 'detailPermohonan']
        )->name('detail_permohonan');

        Route::put(
            '/data-permohonan/{id}/update',
            [AdminPermohonanController::class, 'updatePermohonan']
        )->name('update_permohonan');

        Route::delete(
            '/data-permohonan/{id}',
            [AdminPermohonanController::class, 'destroy']
        )->name('delete_permohonan');

    });


// USER
Route::prefix('pengaduan')->name('pengaduan.')->group(function () {

    // STEP 1
    Route::get('/', [PengaduanController::class, 'create'])->name('create');
    Route::post('/step1', [PengaduanController::class, 'storeStep1'])->name('storeStep1');

    // STEP 2
    Route::get('/lokasi', [PengaduanController::class, 'lokasi'])->name('lokasi');
    Route::post('/lokasi', [PengaduanController::class, 'storeStep2'])->name('storeStep2');

    // AJAX
    Route::get('/get-desa/{id}', [PengaduanController::class, 'getDesa'])->name('getDesa');

    // STEP 3
    Route::get('/datapribadi', [PengaduanController::class, 'dataPribadi'])->name('datapribadi');
    Route::post('/datapribadi', [PengaduanController::class, 'storeStep3'])->name('storeStep3');

    // STEP 4
    Route::get('/konfirmasi', [PengaduanController::class, 'konfirmasi'])->name('konfirmasi');

    // KIRIM OTP
    Route::post('/kirim-otp', [PengaduanController::class, 'kirimOtp'])->name('kirimOtp');

    // HALAMAN OTP
    Route::get('/verifikasi-otp', [PengaduanController::class, 'verifikasiOtp'])->name('verifikasiOtp');

    // VERIFIKASI OTP
    Route::post('/verifikasi-otp', [PengaduanController::class, 'verifyOtp'])->name('verifyOtp');

    // SIMPAN PENGADUAN
    Route::post('/store', [PengaduanController::class, 'store'])->name('store');

    // BERHASIL
    Route::get('/berhasil/{kode}', [PengaduanController::class, 'success'])->name('success');

    // CARI
    Route::get('/cari', [PengaduanController::class, 'cari'])
        ->name('cari');

});



// =========================================================
// PENCARIAN & TRACKING
// =========================================================

/*
|--------------------------------------------------------------------------
| HALAMAN PENCARIAN
|--------------------------------------------------------------------------
|
| URL:
| /pencarian
|
| View:
| resources/views/user/pencarian.blade.php
|
*/

Route::get(
    '/pencarian',
    [TrackingController::class, 'index']
)->name('pencarian');


/*
|--------------------------------------------------------------------------
| PROSES PENCARIAN
|--------------------------------------------------------------------------
|
| URL:
| /tracking/search
|
| Mencari:
| - kode_aduan
| - kode_permohonan
|
*/

Route::get(
    '/tracking/search',
    [TrackingController::class, 'search']
)->name('tracking.search');



/*
|--------------------------------------------------------------------------
| DETAIL TRACKING PENGADUAN
|--------------------------------------------------------------------------
|
| Contoh:
| /pengaduan/tracking/ADU-20260821-ABCDE
|
*/

Route::get(
    '/pengaduan/tracking/{kode}',
    [PengaduanController::class, 'trackingDetail']
)->name('pengaduan.tracking.detail');

Route::get(
    '/pengaduan/tracking-public/{kode}',
    [PengaduanController::class, 'trackingPublic']
)->name('pengaduan.tracking.public');




/*
|--------------------------------------------------------------------------
| DETAIL TRACKING PERMOHONAN
|--------------------------------------------------------------------------
|
| Contoh:
| /permohonan/tracking/PMH-20260821-ABCDE
|
*/

Route::get(
    '/permohonan/tracking/{kode}',
    [PermohonanController::class, 'trackingDetail']
)->name('permohonan.tracking.detail');

Route::get(
    '/permohonan/tracking-public/{kode}',
    [PermohonanController::class, 'trackingPublic']
)->name('permohonan.tracking.public');




// =========================================================
// PERMOHONAN LAYANAN
// =========================================================

Route::prefix('permohonan')
    ->name('permohonan.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | FORM PERMOHONAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/',
            [PermohonanController::class, 'create']
        )->name('create');


        /*
        |--------------------------------------------------------------------------
        | KONFIRMASI PERMOHONAN
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/konfirmasi',
            [PermohonanController::class, 'konfirmasi']
        )->name('konfirmasi');


        /*
        |--------------------------------------------------------------------------
        | KIRIM OTP
        |--------------------------------------------------------------------------
        |
        | Controller:
        | kirimOtp()
        |
        */

        Route::post(
            '/kirim',
            [PermohonanController::class, 'kirimOtp']
        )->name('kirim');


        /*
        |--------------------------------------------------------------------------
        | HALAMAN OTP
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/otp',
            [PermohonanController::class, 'otp']
        )->name('otp');


        /*
        |--------------------------------------------------------------------------
        | VERIFIKASI OTP
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/otp/verifikasi',
            [PermohonanController::class, 'verifyOtp']
        )->name('verifyOtp');


        /*
        |--------------------------------------------------------------------------
        | KIRIM ULANG OTP
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/otp/kirim-ulang',
            [PermohonanController::class, 'kirimUlangOtp']
        )->name('kirimUlangOtp');


        /*
        |--------------------------------------------------------------------------
        | HALAMAN BERHASIL
        |--------------------------------------------------------------------------
        |
        | Contoh:
        | /permohonan/berhasil/PMH-20260821-ABCDE
        |
        */

        Route::get(
            '/berhasil/{kode}',
            [PermohonanController::class, 'success']
        )->name('success');


        /*
        |--------------------------------------------------------------------------
        | PENCARIAN PERMOHONAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/cari',
            [PermohonanController::class, 'cari']
        )->name('cari');

    });



// =========================================================
// INFORMASI
// =========================================================

Route::get(
    '/informasi',
    [InformasiController::class, 'index']
)->name('informasi');



// =========================================================
// KONTAK
// =========================================================

Route::get(
    '/kontak',
    [KontakController::class, 'index']
)->name('kontak');



/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [AuthController::class, 'login']
)->name('login');


Route::post(
    '/login',
    [AuthController::class, 'loginProses']
)->name('login.proses');



/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD
|--------------------------------------------------------------------------
*/

Route::get(
    '/forgot-password',
    [AuthController::class, 'forgotPassword']
)->name('forgot.password');


Route::post(
    '/forgot-password',
    [AuthController::class, 'sendResetLink']
)->name('forgot.password.send');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');



/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get(
    '/register',
    [AuthController::class, 'register']
)->name('register');


Route::post(
    '/register',
    [AuthController::class, 'registerProses']
)->name('register.proses');



/*
|--------------------------------------------------------------------------
| GOOGLE LOGIN - SUPERADMIN
|--------------------------------------------------------------------------
*/

// Redirect ke Google
Route::get(
    '/auth/google',
    [AuthController::class, 'redirectToGoogle']
)->name('google.redirect');


// Callback dari Google
Route::get(
    '/auth/google/callback',
    [AuthController::class, 'handleGoogleCallback']
)->name('google.callback');



/*
|--------------------------------------------------------------------------
| RESET PASSWORD
|--------------------------------------------------------------------------
*/

// Halaman reset password
Route::get(
    '/reset-password/{token}',
    [AuthController::class, 'showResetPassword']
)->name('password.reset');


// Proses reset password
Route::post(
    '/reset-password',
    [AuthController::class, 'resetPassword']
)->name('password.update');



/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');

Route::middleware(['auth'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        // DATA ADMIN
        Route::get(
            '/data-admin',
            [AdminController::class, 'index']
        )->name('data_admin');

        // TAMBAH ADMIN
        Route::post(
            '/data-admin',
            [AdminController::class, 'store']
        )->name('data_admin.store');

        // RESET PASSWORD
        Route::put(
            '/data-admin/{id}/reset-password',
            [AdminController::class, 'resetPassword']
        )->name('data_admin.reset_password');

        // HAPUS ADMIN
        Route::delete(
            '/data-admin/{id}',
            [AdminController::class, 'destroy']
        )->name('data_admin.destroy');

        // STATUS
        Route::patch(
            '/data-admin/{id}/toggle-status',
            [AdminController::class, 'toggleStatus']
        )->name('data_admin.toggle_status');
    });