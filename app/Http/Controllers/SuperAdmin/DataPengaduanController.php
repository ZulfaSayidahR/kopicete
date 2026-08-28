<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DataPengaduanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PENGADUAN
    |--------------------------------------------------------------------------
    */
    public function dataPengaduan(Request $request)
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();

        $query = Pengaduan::with([
            'kecamatan',
            'desa'
        ]);

        // Search kode / judul
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('kode_aduan', 'like', "%{$search}%")
                    ->orWhere('judul_aduan', 'like', "%{$search}%");

            });
        }

        // Filter topik aduan
        if ($request->filled('topik_aduan')) {

            $query->where(
                'topik_aduan',
                $request->topik_aduan
            );
        }

        // Filter kecamatan
        if ($request->filled('kecamatan')) {

            $query->where(
                'id_kecamatan',
                $request->kecamatan
            );
        }

        // Filter status
        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        $pengaduans = $query
            ->latest()
            ->paginate(10);

        return view(
            'superadmin.data_pengaduan',
            compact(
                'pengaduans',
                'kecamatans'
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
            'superadmin.detail_pengaduan',
            compact('pengaduan')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS PENGADUAN
    |--------------------------------------------------------------------------
    */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->status = $request->status;

        /*
        |--------------------------------------------------------------------------
        | SIMPAN TANGGAL BERDASARKAN STATUS
        |--------------------------------------------------------------------------
        */
        if ($request->status === 'Diproses') {
            $pengaduan->tanggal_proses = now();
        } elseif ($request->status === 'Selesai') {
            $pengaduan->tanggal_selesai = now();
        }

        $pengaduan->save();

        return redirect()
            ->route(
                'superadmin.detail_pengaduan',
                $pengaduan->id
            )
            ->with(
                'success',
                'Status pengaduan berhasil diperbarui.'
            );
    }


    public function updatePengaduan(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'status' => 'required|in:Diverifikasi,Diproses,Selesai,Ditolak',
            'catatan' => 'nullable|string',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PENGADUAN
        |--------------------------------------------------------------------------
        */

        $pengaduan = Pengaduan::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | STATUS SAAT INI
        |--------------------------------------------------------------------------
        */

        $statusSekarang = $pengaduan->status;

        $statusBaru = $request->status;


        /*
        |--------------------------------------------------------------------------
        | ATURAN TIMELINE STATUS
        |--------------------------------------------------------------------------
        |
        | Diajukan
        |    ↓
        | Diverifikasi
        |    ↓
        | Diproses
        |    ↓
        | Selesai
        |
        | Diajukan / Diverifikasi → Ditolak
        |
        |--------------------------------------------------------------------------
        */

        $transisiDiizinkan = [

            'Diajukan' => [
                'Diverifikasi',
                'Ditolak',
            ],

            'Diverifikasi' => [
                'Diproses',
                'Ditolak',
            ],

            'Diproses' => [
                'Selesai',
            ],

            'Selesai' => [],

            'Ditolak' => [],
        ];


        /*
        |--------------------------------------------------------------------------
        | CEK APAKAH PERUBAHAN STATUS SESUAI TIMELINE
        |--------------------------------------------------------------------------
        */

        if (
            !isset($transisiDiizinkan[$statusSekarang]) ||
            !in_array(
                $statusBaru,
                $transisiDiizinkan[$statusSekarang]
            )
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Status tidak dapat diubah. Perubahan status harus mengikuti urutan timeline.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | DATA DASAR
        |--------------------------------------------------------------------------
        */

        $data = [
            'status' => $statusBaru,
        ];


        /*
        |--------------------------------------------------------------------------
        | STATUS DIVERIFIKASI
        |--------------------------------------------------------------------------
        */

        if ($statusBaru === 'Diverifikasi') {

            $data['tanggal_verifikasi'] = now();

            $data['catatan_verifikasi'] = $request->catatan;


            if ($request->hasFile('bukti')) {

                $file = $request->file('bukti')
                    ->store(
                        'pengaduan/verifikasi',
                        'public'
                    );

                $data['foto_verifikasi'] = $file;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS DIPROSES
        |--------------------------------------------------------------------------
        */ elseif ($statusBaru === 'Diproses') {

            $data['tanggal_proses'] = now();

            $data['catatan_proses'] = $request->catatan;


            if ($request->hasFile('bukti')) {

                $file = $request->file('bukti')
                    ->store(
                        'pengaduan/proses',
                        'public'
                    );

                $data['foto_proses'] = $file;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS SELESAI
        |--------------------------------------------------------------------------
        */ elseif ($statusBaru === 'Selesai') {

            $data['tanggal_selesai'] = now();

            $data['catatan_selesai'] = $request->catatan;


            if ($request->hasFile('bukti')) {

                $file = $request->file('bukti')
                    ->store(
                        'pengaduan/selesai',
                        'public'
                    );

                $data['foto_selesai'] = $file;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS DITOLAK
        |--------------------------------------------------------------------------
        */ elseif ($statusBaru === 'Ditolak') {

            $data['tanggal_verifikasi'] = now();

            $data['catatan_verifikasi'] = $request->catatan;


            if ($request->hasFile('bukti')) {

                $file = $request->file('bukti')
                    ->store(
                        'pengaduan/verifikasi',
                        'public'
                    );

                $data['foto_verifikasi'] = $file;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PERUBAHAN
        |--------------------------------------------------------------------------
        */

        $pengaduan->update($data);


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE DETAIL
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'superadmin.detail_pengaduan',
                $pengaduan->id
            )
            ->with(
                'success',
                'Status pengaduan berhasil diperbarui.'
            );
    }
    /*
    |--------------------------------------------------------------------------
    | HAPUS PENGADUAN
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->delete();

        return redirect()
            ->route('superadmin.data_pengaduan')
            ->with(
                'success',
                'Data pengaduan berhasil dihapus.'
            );
    }
}