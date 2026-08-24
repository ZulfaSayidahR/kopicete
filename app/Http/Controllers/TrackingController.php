<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Permohonan;

class TrackingController extends Controller
{
    /**
     * =========================================================
     * HALAMAN PENCARIAN
     * =========================================================
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | PENGADUAN
        |--------------------------------------------------------------------------
        */

        $aduanQuery = Pengaduan::with('kecamatan')
            ->latest();

        if ($request->filled('topik')) {

            $topik = trim($request->topik);

            $aduanQuery->where(function ($query) use ($topik) {

                $query->where(
                    'judul_aduan',
                    'like',
                    '%' . $topik . '%'
                )
                    ->orWhere(
                        'kode_aduan',
                        'like',
                        '%' . $topik . '%'
                    )
                    ->orWhere(
                        'detail_aduan',
                        'like',
                        '%' . $topik . '%'
                    );

            });
        }

        $aduanTerbaru = $aduanQuery
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PERMOHONAN
        |--------------------------------------------------------------------------
        */

        $permohonanQuery = Permohonan::query()
            ->latest();

        if ($request->filled('jenis_permohonan')) {

            $jenis = trim($request->jenis_permohonan);

            $permohonanQuery->where(function ($query) use ($jenis) {

                $query->where(
                    'jenis_permohonan',
                    'like',
                    '%' . $jenis . '%'
                )
                    ->orWhere(
                        'kode_permohonan',
                        'like',
                        '%' . $jenis . '%'
                    )
                    ->orWhere(
                        'nama_penyelenggara',
                        'like',
                        '%' . $jenis . '%'
                    )
                    ->orWhere(
                        'nama_pemohon',
                        'like',
                        '%' . $jenis . '%'
                    );

            });
        }

        $permohonanTerbaru = $permohonanQuery
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'user.pencarian',
            compact(
                'aduanTerbaru',
                'permohonanTerbaru'
            )
        );
    }

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

        $request->validate(
            [
                'kode' => 'required|string|max:100',
            ],
            [
                'kode.required' =>
                    'Silakan masukkan kode aduan atau kode permohonan.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | AMBIL KODE
        |--------------------------------------------------------------------------
        */

        $kode = trim(
            $request->input('kode')
        );


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

            return redirect()->route(
                'pengaduan.tracking.detail',
                [
                    'kode' => $pengaduan->kode_aduan
                ]
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

            return redirect()->route(
                'permohonan.tracking.detail',
                [
                    'kode' => $permohonan->kode_permohonan
                ]
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