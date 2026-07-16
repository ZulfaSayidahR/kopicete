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
use App\Http\Controllers\SuperAdmin\DataPengaduanController;
use App\Http\Controllers\SuperAdmin\DataPermohonanController;


// SUPER ADMIN

Route::prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [SuperAdminController::class, 'dashboard']
        )
            ->name('dashboard');

        Route::get(
            '/data-admin',
            [SuperAdminController::class, 'dataAdmin']
        )
            ->name('data_admin');

        Route::get(
            '/data-pengaduan',
            [DataPengaduanController::class, 'dataPengaduan']
        )
            ->name('data_pengaduan');

        Route::get(
            '/data-permohonan',
            [PermohonanController::class, 'dataPermohonan']
        )
            ->name('data_permohonan');
    });

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/


// Halaman Beranda
Route::get(
    '/',
    [HomeController::class, 'index']
)
    ->name('home');



// ==========================
// PENGADUAN
// ==========================

Route::prefix('pengaduan')
    ->name('pengaduan.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | STEP 1 - Data Aduan
        |--------------------------------------------------------------------------
        */
        Route::get('/', [PengaduanController::class, 'create'])
            ->name('create');

        /*
        |--------------------------------------------------------------------------
        | STEP 2 - Lokasi & Lampiran
        |--------------------------------------------------------------------------
        */
        Route::get('/lokasi', [PengaduanController::class, 'lokasi'])
            ->name('lokasi');

        /*
        |--------------------------------------------------------------------------
        | STEP 3 - Data Pribadi
        |--------------------------------------------------------------------------
        */
        Route::get('/datapribadi', [PengaduanController::class, 'dataPribadi'])
            ->name('datapribadi');

        /*
        |--------------------------------------------------------------------------
        | STEP 4 - Konfirmasi
        |--------------------------------------------------------------------------
        */
        Route::get('/konfirmasi', [PengaduanController::class, 'konfirmasi'])
            ->name('konfirmasi');

        /*
        |--------------------------------------------------------------------------
        | Simpan Pengaduan
        |--------------------------------------------------------------------------
        */
        Route::post('/store', [PengaduanController::class, 'store'])
            ->name('store');

        /*
        |--------------------------------------------------------------------------
        | Halaman Berhasil
        |--------------------------------------------------------------------------
        */
        Route::get('/berhasil/{kode}', [PengaduanController::class, 'success'])
            ->name('success');

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


Route::prefix('permohonan')
    ->name('permohonan.')
    ->group(function () {

        Route::get('/', [PermohonanController::class, 'create'])
            ->name('create');

        Route::post('/store', [PermohonanController::class, 'store'])
            ->name('store');


        // detail permohonan
    
        Route::get(
            '/detail/{id}',
            [PermohonanController::class, 'show']
        )
            ->name('detail');


    });




// ==========================
// TRACKING ADUAN
// ==========================


Route::prefix('tracking')
    ->name('tracking.')
    ->group(function () {



        // halaman tracking
    
        Route::get(
            '/',
            [TrackingController::class, 'index']
        )
            ->name('index');



        // proses pencarian kode
    
        Route::post(
            '/search',
            [TrackingController::class, 'search']
        )
            ->name('search');



        // detail status
    
        Route::get(
            '/{kode}',
            [TrackingController::class, 'detail']
        )
            ->name('detail');



    });


Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'loginProses'])
    ->name('login.proses');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot.password');

Route::post('/forgot-password', [AuthController::class, 'forgotPasswordProses'])
    ->name('forgot.password.proses');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->name('forgot.password.send');

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
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/


// Route::prefix('admin')
//     ->name('admin.')
//     ->middleware(['auth'])
//     ->group(function () {



//         // Dashboard

//         Route::get(
//             '/',
//             [AdminDashboardController::class, 'index']
//         )
//             ->name('dashboard');




//         // Data Pengaduan

//         Route::prefix('pengaduan')
//             ->name('pengaduan.')
//             ->group(function () {



//                 Route::get(
//                     '/',
//                     [AdminPengaduanController::class, 'index']
//                 )
//                     ->name('index');



//                 Route::get(
//                     '/{id}',
//                     [AdminPengaduanController::class, 'show']
//                 )
//                     ->name('show');



//                 Route::put(
//                     '/update/{id}',
//                     [AdminPengaduanController::class, 'update']
//                 )
//                     ->name('update');



//                 Route::delete(
//                     '/delete/{id}',
//                     [AdminPengaduanController::class, 'destroy']
//                 )
//                     ->name('delete');



//      });



// });
