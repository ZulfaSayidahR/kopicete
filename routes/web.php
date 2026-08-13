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



// SUPER ADMIN

Route::prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        // Dashboard
        Route::get(
            '/dashboard',
            [SuperAdminController::class, 'dashboard']
        )->name('dashboard');

        // Data Admin
        Route::get(
            '/data-admin',
            [AdminController::class, 'index']
        )->name('data_admin');

        // Data Pengaduan
        Route::get(
            '/data-pengaduan',
            [DataPengaduanController::class, 'dataPengaduan']
        )->name('data_pengaduan');

        Route::get(
            '/data-pengaduan/{id}',
            [DataPengaduanController::class, 'detailPengaduan']
        )->name('detail_pengaduan');

        Route::put(
            '/data-pengaduan/{id}/status',
            [DataPengaduanController::class, 'updateStatus']
        )->name('update_status_pengaduan');

        Route::delete(
            '/data-pengaduan/{id}',
            [DataPengaduanController::class, 'destroy']
        )->name('delete_pengaduan');

        // Data Permohonan
        Route::get(
            '/data-permohonan',
            [DataPermohonanController::class, 'index']
        )->name('data_permohonan');

        Route::get(
            '/data-permohonan/{id}',
            [DataPermohonanController::class, 'show']
        )->name('detail_permohonan');

        Route::put(
            '/data-permohonan/{id}/status',
            [DataPermohonanController::class, 'updateStatus']
        )->name('update_status_permohonan');

        Route::delete(
            '/data-permohonan/{id}',
            [DataPermohonanController::class, 'destroy']
        )->name('delete_permohonan');
    });

// ADMIN PENGADUAN



Route::prefix('adminpengaduan')
    ->name('adminpengaduan.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('adminpengaduan.dashboard');
        })->name('dashboard');

        // Data Pengaduan
        Route::get('/data-pengaduan', function () {
            return view('adminpengaduan.data_pengaduan');
        })->name('data_pengaduan');

        Route::get('/detail-pengaduan', [AdminPengaduanController::class, 'detailPengaduan'])
            ->name('detail_pengaduan');

        // UPDATE STATUS
        Route::post('/update-pengaduan', [AdminPengaduanController::class, 'updatePengaduan'])
            ->name('update_pengaduan');

    });

// ADMIN PERMOHONANNNN
use App\Http\Controllers\AdminPermohonanController;

Route::prefix('adminpermohonan')
    ->name('adminpermohonan.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [AdminPermohonanController::class, 'dashboard']
        )
            ->name('dashboard');

        Route::get(
            '/data-permohonan',
            [AdminPermohonanController::class, 'dataPermohonan']
        )
            ->name('data_permohonan');

        Route::get(
            '/detail-permohonan',
            [AdminPermohonanController::class, 'detailPermohonan']
        )
            ->name('detail_permohonan');

        Route::post(
            '/update-permohonan',
            [AdminPermohonanController::class, 'updatePermohonan']
        )
            ->name('update_permohonan');

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



// =========================
// LACAK ADUAN
// =========================

Route::get('/lacak', [PengaduanController::class, 'search'])
    ->name('pengaduan.search');

Route::get('/lacak/{kode}', [PengaduanController::class, 'tracking'])
    ->name('pengaduan.tracking');

// ==========================
// PERMOHONAN LAYANAN
// ==========================

Route::prefix('permohonan')->name('permohonan.')->group(function () {

    Route::get('/', [PermohonanController::class, 'create'])
        ->name('create');

    Route::post('/konfirmasi', [PermohonanController::class, 'konfirmasi'])
        ->name('konfirmasi');

    Route::post('/kirim', [PermohonanController::class, 'kirim'])
        ->name('kirim');

    Route::get('/otp', [PermohonanController::class, 'otp'])
        ->name('otp');

    Route::post('/otp/verifikasi', [PermohonanController::class, 'verifyOtp'])
        ->name('verifyOtp');
    // Kirim ulang OTP
    Route::post('/otp/kirim-ulang', [PermohonanController::class, 'kirimUlangOtp'])
        ->name('kirimUlangOtp');

    // TRACKING
    Route::get('/tracking/{kode}', [PermohonanController::class, 'tracking'])
        ->name('tracking');

    Route::get('/berhasil/{kode}', [PermohonanController::class, 'success'])
        ->name('success');

    // CARI
    Route::get('/cari', [PermohonanController::class, 'cari'])
        ->name('cari');

});




// ==========================
// INFORMASI
// ==========================


Route::get(
    '/informasi',
    [InformasiController::class, 'index']
)
    ->name('informasi');




// ==========================
// KONTAK
// ==========================


Route::get(
    '/kontak',
    [KontakController::class, 'index']
)
    ->name('kontak');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'loginProses'])
    ->name('login.proses');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot.password');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->name('forgot.password.send');




