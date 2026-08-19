<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Storage;

class AdminPengaduanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        // ==========================================
        // STATISTIK PENGADUAN
        // ==========================================

        $totalPengaduan = Pengaduan::count();

        $menungguVerifikasi = Pengaduan::where(
            'status',
            'Menunggu'
        )->count();

        $diproses = Pengaduan::where(
            'status',
            'Diproses'
        )->count();

        $selesai = Pengaduan::where(
            'status',
            'Selesai'
        )->count();


        // ==========================================
        // PENGADUAN TERBARU
        // ==========================================

        $pengaduanTerbaru = Pengaduan::with([
            'kecamatan'
        ])
            ->latest()
            ->take(5)
            ->get();


        // ==========================================
        // KIRIM DATA KE DASHBOARD
        // ==========================================

        return view(
            'adminpengaduan.dashboard',
            compact(
                'totalPengaduan',
                'menungguVerifikasi',
                'diproses',
                'selesai',
                'pengaduanTerbaru'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DATA PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function dataPengaduan(Request $request)
    {
        // ==========================================
        // QUERY DASAR
        // ==========================================

        $query = Pengaduan::with([
            'kecamatan'
        ]);


        // ==========================================
        // PENCARIAN
        // ==========================================

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'kode_aduan',
                    'like',
                    '%' . $search . '%'
                )

                    ->orWhere(
                        'judul_aduan',
                        'like',
                        '%' . $search . '%'
                    );

            });

        }


        // ==========================================
        // FILTER KATEGORI / TOPIK
        // ==========================================

        if ($request->filled('kategori')) {

            $query->where(
                'topik_aduan',
                $request->kategori
            );

        }


        // ==========================================
        // FILTER KECAMATAN
        // ==========================================

        if ($request->filled('kecamatan')) {

            $query->where(
                'id_kecamatan',
                $request->kecamatan
            );

        }


        // ==========================================
        // FILTER STATUS
        // ==========================================

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }


        // ==========================================
        // DATA PENGADUAN
        // ==========================================

        $pengaduans = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $pengaduans->appends(request()->query());


        // ==========================================
        // DATA KECAMATAN
        // ==========================================

        $kecamatans = Kecamatan::orderBy(
            'nama_kecamatan'
        )->get();


        // ==========================================
        // DATA KATEGORI
        // ==========================================

        $kategori = Pengaduan::query()
            ->whereNotNull('topik_aduan')
            ->where('topik_aduan', '!=', '')
            ->distinct()
            ->orderBy('topik_aduan')
            ->pluck('topik_aduan');


        // ==========================================
        // KIRIM KE VIEW
        // ==========================================

        return view(
            'adminpengaduan.data_pengaduan',
            compact(
                'pengaduans',
                'kecamatans',
                'kategori'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function detailPengaduan($id)
    {
        $pengaduan = Pengaduan::with([
            'kecamatan',
            'desa'
        ])->findOrFail($id);

        return view(
            'adminpengaduan.detail_pengaduan',
            compact('pengaduan')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function updatePengaduan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diverifikasi,Diproses,Selesai,Ditolak',
            'catatan' => 'nullable|string',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $data = [
            'status' => $request->status,
        ];

        // ===============================
        // DIVERIFIKASI
        // ===============================
        if ($request->status == 'Diverifikasi') {

            $data['tanggal_verifikasi'] = now();
            $data['catatan_verifikasi'] = $request->catatan;

            if ($request->hasFile('bukti')) {

                $data['foto_verifikasi'] = $request
                    ->file('bukti')
                    ->store('pengaduan/verifikasi', 'public');
            }
        }

        // ===============================
        // DIPROSES
        // ===============================
        elseif ($request->status == 'Diproses') {

            $data['tanggal_proses'] = now();
            $data['catatan_proses'] = $request->catatan;

            if ($request->hasFile('bukti')) {

                $data['foto_proses'] = $request
                    ->file('bukti')
                    ->store('pengaduan/proses', 'public');
            }
        }

        // ===============================
        // SELESAI
        // ===============================
        elseif ($request->status == 'Selesai') {

            $data['tanggal_selesai'] = now();
            $data['catatan_selesai'] = $request->catatan;

            if ($request->hasFile('bukti')) {

                $data['foto_selesai'] = $request
                    ->file('bukti')
                    ->store('pengaduan/selesai', 'public');
            }
        }

        // ===============================
        // DITOLAK
        // ===============================
        elseif ($request->status == 'Ditolak') {

            $data['tanggal_verifikasi'] = now();
            $data['catatan_verifikasi'] = $request->catatan;
        }

        $pengaduan->update($data);

        return redirect()
            ->route('adminpengaduan.detail_pengaduan', $pengaduan->id)
            ->with('success', 'Data pengaduan berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE PENGADUAN
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->delete();

        return redirect()
            ->route('data_pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}