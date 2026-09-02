<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;

class DataPermohonanController extends Controller
{
    /**
     * ============================================================
     * DATA PERMOHONAN
     * ============================================================
     */
    public function dataPermohonan(Request $request)
    {
        $query = Permohonan::query();


        // ========================================================
        // SEARCH
        // ========================================================

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'kode_permohonan',
                    'like',
                    "%{$search}%"
                )

                    ->orWhere(
                        'nama_penyelenggara',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'nama_pemohon',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'penanggung_jawab',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'jenis_permohonan',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'tempat',
                        'like',
                        "%{$search}%"
                    );

            });
        }


        // ========================================================
        // FILTER JENIS PERMOHONAN
        // ========================================================

        if ($request->filled('jenis_permohonan')) {

            $query->where(
                'jenis_permohonan',
                $request->jenis_permohonan
            );

        }


        // ========================================================
        // FILTER STATUS
        // ========================================================

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }


        // ========================================================
        // FILTER TANGGAL KEGIATAN
        // ========================================================

        if ($request->filled('tanggal_kegiatan')) {

            $query->whereDate(
                'tanggal_kegiatan',
                $request->tanggal_kegiatan
            );

        }


        // ========================================================
        // DATA PERMOHONAN
        // ========================================================

        $permohonans = $query
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(request()->query());

        // ========================================================
        // JENIS PERMOHONAN
        //
        // HANYA ADA 2 PILIHAN
        // ========================================================

        $jenisPermohonan = collect([
            'Permohonan Rehabilitasi',
            'Permohonan Sosialisasi',
        ]);


        // ========================================================
        // DATA VIEW
        // ========================================================

        return view(
            'superadmin.data_permohonan',
            compact(
                'permohonans',
                'jenisPermohonan'
            )
        );
    }


    /**
     * ============================================================
     * UPDATE PERMOHONAN
     * ============================================================
     */
    public function updatePermohonan(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'status' => 'required|in:Diverifikasi,Diproses,Selesai,Ditolak',

            'catatan' => 'nullable|string',

            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PERMOHONAN
        |--------------------------------------------------------------------------
        */

        $permohonan = Permohonan::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS
        |--------------------------------------------------------------------------
        */

        $permohonan->status = $request->status;


        /*
        |--------------------------------------------------------------------------
        | DIVERIFIKASI
        |--------------------------------------------------------------------------
        */

        if ($request->status === 'Diverifikasi') {

            $permohonan->tanggal_verifikasi = now();

            $permohonan->catatan_verifikasi = $request->catatan;


            /*
            |--------------------------------------------------------------------------
            | UPLOAD FILE VERIFIKASI
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('bukti')) {

                $file = $request->file('bukti');

                if ($file->isValid()) {

                    $path = $file->store(
                        'permohonan/verifikasi',
                        'public'
                    );

                    $permohonan->file_verifikasi = $path;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DIPROSES
        |--------------------------------------------------------------------------
        */ elseif ($request->status === 'Diproses') {

            $permohonan->tanggal_proses = now();

            $permohonan->catatan_proses = $request->catatan;


            /*
            |--------------------------------------------------------------------------
            | UPLOAD FILE PROSES
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('bukti')) {

                $file = $request->file('bukti');

                if ($file->isValid()) {

                    $path = $file->store(
                        'permohonan/proses',
                        'public'
                    );

                    $permohonan->file_proses = $path;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */ elseif ($request->status === 'Selesai') {

            $permohonan->tanggal_selesai = now();

            $permohonan->catatan_selesai = $request->catatan;


            /*
            |--------------------------------------------------------------------------
            | UPLOAD FILE SELESAI
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('bukti')) {

                $file = $request->file('bukti');

                if ($file->isValid()) {

                    $path = $file->store(
                        'permohonan/selesai',
                        'public'
                    );

                    $permohonan->file_selesai = $path;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DITOLAK
        |--------------------------------------------------------------------------
        */ elseif ($request->status === 'Ditolak') {

            $permohonan->tanggal_verifikasi = now();

            $permohonan->catatan_verifikasi = $request->catatan;
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $permohonan->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'superadmin.detail_permohonan',
                [
                    'id' => $permohonan->id
                ]
            )
            ->with(
                'success',
                'Status permohonan berhasil diperbarui.'
            );
    }

    /**
     * ============================================================
     * DETAIL PERMOHONAN
     * ============================================================
     */
    public function detailPermohonan($id)
    {
        $permohonan = Permohonan::findOrFail($id);


        return view(
            'superadmin.detail_permohonan',
            compact('permohonan')
        );
    }


    /**
     * ============================================================
     * HAPUS PERMOHONAN
     * ============================================================
     */
    public function destroy($id)
    {
        $permohonan = Permohonan::findOrFail($id);


        $permohonan->delete();


        return redirect()
            ->route(
                'superadmin.data_permohonan'
            )
            ->with(
                'success',
                'Data permohonan berhasil dihapus.'
            );
    }
}