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
        $request->validate([
            'status' => 'required',
            'catatan' => 'nullable|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);


        $permohonan = Permohonan::findOrFail($id);


        $data = [
            'status' => $request->status,
        ];


        // ========================================================
        // DIVERIFIKASI
        // ========================================================

        if ($request->status === 'Diverifikasi') {

            $data['tanggal_verifikasi'] = now();

            $data['catatan_verifikasi'] =
                $request->catatan;


            // Upload lampiran verifikasi
            if ($request->hasFile('bukti')) {

                $data['file_verifikasi'] =
                    $request->file('bukti')
                        ->store('permohonan/verifikasi', 'public');
            }
        }


        // ========================================================
        // DIPROSES
        // ========================================================

        if ($request->status === 'Diproses') {

            $data['tanggal_proses'] = now();

            $data['catatan_proses'] =
                $request->catatan;


            // Upload lampiran proses
            if ($request->hasFile('bukti')) {

                $data['file_proses'] =
                    $request->file('bukti')
                        ->store('permohonan/proses', 'public');
            }
        }


        // ========================================================
        // SELESAI
        // ========================================================

        if ($request->status === 'Selesai') {

            $data['tanggal_selesai'] = now();

            $data['catatan_selesai'] =
                $request->catatan;


            // Upload lampiran selesai
            if ($request->hasFile('bukti')) {

                $data['file_selesai'] =
                    $request->file('bukti')
                        ->store('permohonan/selesai', 'public');
            }
        }


        // ========================================================
        // UPDATE DATABASE
        // ========================================================

        $permohonan->update($data);


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