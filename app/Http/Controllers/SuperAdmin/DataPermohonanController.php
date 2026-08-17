<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;

class DataPermohonanController extends Controller
{
    public function dataPermohonan(Request $request)
    {
        $query = Permohonan::query();

        // Search
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('kode_permohonan', 'like', "%{$search}%")
                    ->orWhere('nama_penyelenggara', 'like', "%{$search}%")
                    ->orWhere('penanggung_jawab', 'like', "%{$search}%")
                    ->orWhere('jenis_permohonan', 'like', "%{$search}%");

            });
        }

        // Jenis Permohonan
        if ($request->filled('jenis_permohonan')) {

            $query->where(
                'jenis_permohonan',
                $request->jenis_permohonan
            );
        }

        // Status
        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        // Tanggal Kegiatan
        if ($request->filled('tanggal_kegiatan')) {

            $query->whereDate(
                'tanggal_kegiatan',
                $request->tanggal_kegiatan
            );
        }

        $permohonans = $query
            ->orderBy('id', 'desc')
            ->paginate(10);

        $jenisPermohonan = Permohonan::select('jenis_permohonan')
            ->distinct()
            ->orderBy('jenis_permohonan')
            ->pluck('jenis_permohonan');

        return view(
            'superadmin.data_permohonan',
            compact(
                'permohonans',
                'jenisPermohonan'
            )
        );
    }

    public function updatePermohonan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $permohonan = Permohonan::findOrFail($id);

        $data = [
            'status' => $request->status,
        ];

        // Simpan catatan sesuai status
        if ($request->status == 'Menunggu') {

            $data['tanggal_verifikasi'] = now();
            $data['catatan_verifikasi'] = $request->catatan;
        }

        if ($request->status == 'Diproses') {

            $data['tanggal_proses'] = now();
            $data['catatan_proses'] = $request->catatan;
        }

        if ($request->status == 'Selesai') {

            $data['tanggal_selesai'] = now();
            $data['catatan_selesai'] = $request->catatan;
        }

        $permohonan->update($data);

        return redirect()
            ->route(
                'superadmin.detail_permohonan',
                $permohonan->id
            )
            ->with(
                'success',
                'Status permohonan berhasil diperbarui.'
            );
    }

    public function detailPermohonan($id)
    {
        $permohonan = Permohonan::findOrFail($id);

        return view(
            'superadmin.detail_permohonan',
            compact('permohonan')
        );
    }

    public function destroy($id)
    {
        $permohonan = Permohonan::findOrFail($id);

        $permohonan->delete();

        return redirect()
            ->route('superadmin.data_permohonan')
            ->with(
                'success',
                'Data permohonan berhasil dihapus.'
            );
    }
}