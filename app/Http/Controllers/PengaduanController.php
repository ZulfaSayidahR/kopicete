<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STEP 1 : Data Aduan
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('user.pengaduan.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 2 : Lokasi & Lampiran
    |--------------------------------------------------------------------------
    */
    public function lokasi()
    {
        return view('user.pengaduan.lokasi');
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 3 : Data Pribadi
    |--------------------------------------------------------------------------
    */
    public function dataPribadi()
    {
        return view('user.pengaduan.datapribadi');
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 4 : Konfirmasi
    |--------------------------------------------------------------------------
    */
    public function konfirmasi()
    {
        return view('user.pengaduan.konfirmasi');
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Pengaduan
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        // Validasi data (sementara dikosongkan)

        return redirect()->route('pengaduan.success', [
            'kode' => 'BNNK-001'
        ]);
    }

    // ===================================
// Cari berdasarkan kode
// ===================================

    public function search(Request $request)
    {
        $kode = $request->kode;

        return redirect()->route(
            'pengaduan.tracking',
            $kode
        );
    }

    // ===================================
// Halaman Tracking
// ===================================

    public function tracking($kode)
    {
        return view(
            'user.pengaduan.tracking',
            compact('kode')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman Berhasil
    |--------------------------------------------------------------------------
    */
    public function success($kode)
    {
        return view('user.pengaduan.success', compact('kode'));
    }
}