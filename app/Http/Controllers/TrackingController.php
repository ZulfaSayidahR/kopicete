<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Permohonan;

class TrackingController extends Controller
{
    /**
     * =========================================================
     * SEARCH PENGADUAN / PERMOHONAN
     * =========================================================
     */
    public function search(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'kode' => 'required|string|max:100',
        ], [
            'kode.required' =>
                'Silakan masukkan kode aduan atau kode permohonan.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL KODE
        |--------------------------------------------------------------------------
        */

        $kode = trim($request->input('kode'));


        /*
        |--------------------------------------------------------------------------
        | CARI PENGADUAN
        |--------------------------------------------------------------------------
        */

        $pengaduan = Pengaduan::where(
            'kode_aduan',
            $kode
        )->first();


        if ($pengaduan) {

            return redirect()->to(
                '/pengaduan/tracking/' . $pengaduan->kode_aduan
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CARI PERMOHONAN
        |--------------------------------------------------------------------------
        */

        $permohonan = Permohonan::where(
            'kode_permohonan',
            $kode
        )->first();


        if ($permohonan) {

            return redirect()->to(
                '/permohonan/tracking/' . $permohonan->kode_permohonan
            );
        }


        /*
        |--------------------------------------------------------------------------
        | TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput()
            ->with(
                'error',
                'Kode aduan atau kode permohonan tidak ditemukan.'
            );
    }
}