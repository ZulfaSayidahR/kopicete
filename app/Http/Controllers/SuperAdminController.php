<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuperAdminController extends Controller
{
    public function dashboard(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | TAHUN YANG DIPILIH
        |--------------------------------------------------------------------------
        */

        $tahun = $request->get('tahun', date('Y'));


        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        // Total seluruh pengaduan
        $totalPengaduan = Pengaduan::count();

        // Pengaduan yang sedang diproses
        $pengaduanDiproses = Pengaduan::where('status', 'diproses')
            ->count();

        // Total seluruh permohonan
        $totalPermohonan = Permohonan::count();

        // Pengaduan yang sudah selesai
        $laporanSelesai = Pengaduan::where('status', 'selesai')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK BERDASARKAN TAHUN
        |--------------------------------------------------------------------------
        */

        // Total pengaduan pada tahun yang dipilih
        $totalPengaduanTahun = Pengaduan::whereYear(
            'created_at',
            $tahun
        )->count();


        // Total permohonan pada tahun yang dipilih
        $totalPermohonanTahun = Permohonan::whereYear(
            'created_at',
            $tahun
        )->count();


        // Pengaduan diproses pada tahun yang dipilih
        $pengaduanDiprosesTahun = Pengaduan::whereYear(
            'created_at',
            $tahun
        )
            ->where('status', 'diproses')
            ->count();


        // Pengaduan selesai pada tahun yang dipilih
        $laporanSelesaiTahun = Pengaduan::whereYear(
            'created_at',
            $tahun
        )
            ->where('status', 'selesai')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK PENGADUAN PER BULAN
        |--------------------------------------------------------------------------
        */

        $dataPengaduan = Pengaduan::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as jumlah')
        )
            ->whereYear('created_at', $tahun)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('bulan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK PERMOHONAN PER BULAN
        |--------------------------------------------------------------------------
        */

        $dataPermohonan = Permohonan::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as jumlah')
        )
            ->whereYear('created_at', $tahun)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('bulan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | SIAPKAN 12 BULAN
        |--------------------------------------------------------------------------
        */

        $grafikPengaduan = array_fill(1, 12, 0);

        $grafikPermohonan = array_fill(1, 12, 0);


        /*
        |--------------------------------------------------------------------------
        | MASUKKAN DATA PENGADUAN KE BULAN
        |--------------------------------------------------------------------------
        */

        foreach ($dataPengaduan as $data) {

            $grafikPengaduan[$data->bulan] = $data->jumlah;
        }


        /*
        |--------------------------------------------------------------------------
        | MASUKKAN DATA PERMOHONAN KE BULAN
        |--------------------------------------------------------------------------
        */

        foreach ($dataPermohonan as $data) {

            $grafikPermohonan[$data->bulan] = $data->jumlah;
        }


        /*
        |--------------------------------------------------------------------------
        | DATA JUDUL PENGADUAN
        |--------------------------------------------------------------------------
        */

        $judulAduan = Pengaduan::select(
            'judul_aduan',
            DB::raw('COUNT(*) as jumlah')
        )
            ->whereYear('created_at', $tahun)
            ->groupBy('judul_aduan')
            ->orderByDesc('jumlah')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DATA JENIS PERMOHONAN
        |--------------------------------------------------------------------------
        */

        $jenisPermohonan = Permohonan::select(
            'jenis_permohonan',
            DB::raw('COUNT(*) as jumlah')
        )
            ->whereYear('created_at', $tahun)
            ->groupBy('jenis_permohonan')
            ->orderByDesc('jumlah')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KIRIM SEMUA DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'superadmin.dashboard',
            compact(

                // Statistik keseluruhan
                'totalPengaduan',
                'pengaduanDiproses',
                'totalPermohonan',
                'laporanSelesai',

                // Tahun
                'tahun',

                // Statistik berdasarkan tahun
                'totalPengaduanTahun',
                'totalPermohonanTahun',
                'pengaduanDiprosesTahun',
                'laporanSelesaiTahun',

                // Grafik
                'grafikPengaduan',
                'grafikPermohonan',

                // Data kategori
                'judulAduan',
                'jenisPermohonan'
            )
        );

    }
    public function updatePengaduan(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);


        // ==========================================
        // VALIDASI
        // ==========================================

        $validated = $request->validate([

            'status' => [
                'required',
                'in:Diajukan,Diverifikasi,Diproses Lapangan,Selesai,Ditolak'
            ],

            'catatan' => [
                'nullable',
                'string'
            ],

            'bukti' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ],

        ]);


        // ==========================================
        // STATUS BARU
        // ==========================================

        $status = $request->status;


        // ==========================================
        // UPDATE STATUS
        // ==========================================

        $pengaduan->status = $status;


        // ==========================================
        // SIMPAN ADMIN YANG MELAKUKAN UPDATE
        // ==========================================

        if (Auth::check()) {

            $pengaduan->admin_id = Auth::id();

        }


        // ==========================================
        // CATATAN + FOTO SESUAI STATUS
        // ==========================================

        if ($status === 'Diverifikasi') {

            $pengaduan->catatan_verifikasi =
                $request->catatan;

            $pengaduan->tanggal_verifikasi =
                now();


            if ($request->hasFile('bukti')) {

                $pengaduan->foto_verifikasi =
                    $request->file('bukti')
                        ->store('pengaduan/verifikasi', 'public');

            }

        } elseif ($status === 'Diproses Lapangan') {

            $pengaduan->catatan_proses =
                $request->catatan;

            $pengaduan->tanggal_proses =
                now();


            if ($request->hasFile('bukti')) {

                $pengaduan->foto_proses =
                    $request->file('bukti')
                        ->store('pengaduan/proses', 'public');

            }

        } elseif ($status === 'Selesai') {

            $pengaduan->catatan_selesai =
                $request->catatan;

            $pengaduan->tanggal_selesai =
                now();


            if ($request->hasFile('bukti')) {

                $pengaduan->foto_selesai =
                    $request->file('bukti')
                        ->store('pengaduan/selesai', 'public');

            }

        }


        // ==========================================
        // SIMPAN KE DATABASE
        // ==========================================

        $pengaduan->save();


        // ==========================================
        // KEMBALI KE DETAIL
        // ==========================================

        return redirect()
            ->route(
                'superadmin.detail_pengaduan',
                $pengaduan->id
            )
            ->with(
                'success',
                'Data pengaduan berhasil diperbarui.'
            );
    }
}