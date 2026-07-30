<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Kecamatan;
use App\Models\Desa;

class PengaduanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STEP 1 : DATA ADUAN
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('user.pengaduan.create');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'judul_aduan' => 'required|max:255',
            'topik_aduan' => 'required',
            'detail_aduan' => 'required',
        ]);

        Session::put('pengaduan.step1', [
            'judul_aduan' => $request->judul_aduan,
            'topik_aduan' => $request->topik_aduan,
            'detail_aduan' => $request->detail_aduan,
        ]);

        return redirect()->route('pengaduan.lokasi');
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 2 : LOKASI
    |--------------------------------------------------------------------------
    */

    public function lokasi()
    {
        $kecamatan = Kecamatan::all();

        return view(
            'user.pengaduan.lokasi',
            compact('kecamatan')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX DESA
    |--------------------------------------------------------------------------
    */

    public function getDesa($id_kecamatan)
    {
        $desa = Desa::where(
            'id_kecamatan',
            $id_kecamatan
        )->get();

        return response()->json($desa);
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN STEP 2
    |--------------------------------------------------------------------------
    */

    public function storeStep2(Request $request)
    {
        $request->validate([
            'id_kecamatan' => 'required|exists:kecamatan,id_kecamatan',
            'id_desa' => 'required|exists:desa,id_desa',
            'lampiran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $lampiran = null;

        if ($request->hasFile('lampiran')) {

            $lampiran = $request
                ->file('lampiran')
                ->store('lampiran', 'public');
        }

        Session::put('pengaduan.step2', [
            'id_kecamatan' => $request->id_kecamatan,
            'id_desa' => $request->id_desa,
            'lampiran' => $lampiran,
        ]);

        return redirect()->route('pengaduan.datapribadi');
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 3 : DATA PRIBADI
    |--------------------------------------------------------------------------
    */

    public function dataPribadi()
    {
        return view('user.pengaduan.datapribadi');
    }

    public function storeStep3(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'whatsapp' => 'required',
                'alamat' => 'required',
                'email' => 'nullable|email',
            ],
            [
                'nama.required' =>
                    'Nama lengkap wajib diisi',

                'whatsapp.required' =>
                    'Nomor WhatsApp wajib diisi',

                'alamat.required' =>
                    'Alamat wajib diisi',
            ]
        );

        Session::put('pengaduan.step3', [
            'nama' => $request->nama,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pengaduan.konfirmasi');
    }

    /*
    |--------------------------------------------------------------------------
    | STEP 4 : KONFIRMASI
    |--------------------------------------------------------------------------
    */

    public function konfirmasi()
    {
        return view('user.pengaduan.konfirmasi');
    }

    /*
    |--------------------------------------------------------------------------
    | KIRIM OTP
    |--------------------------------------------------------------------------
    */

    public function kirimOtp(Request $request)
    {
        // nanti di sini proses kirim OTP menggunakan Fonnte

        return redirect()->route('pengaduan.verifikasiOtp');
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN OTP
    |--------------------------------------------------------------------------
    */

    public function verifikasiOtp()
    {
        return view('user.pengaduan.verifikasiotp');
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI OTP
    |--------------------------------------------------------------------------
    */

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|min:6|max:6',
        ]);

        // nanti cek OTP di sini

        return redirect()->route(
            'pengaduan.success',
            [
                'kode' => 'BNNK-123456',
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $step1 = Session::get('pengaduan.step1');
        $step2 = Session::get('pengaduan.step2');
        $step3 = Session::get('pengaduan.step3');

        /*
        Nanti di sini:

        Pengaduan::create([
            ...
        ]);
        */

        Session::forget('pengaduan');

        return redirect()->route(
            'pengaduan.success',
            [
                'kode' => 'BNNK-001',
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TRACKING
    |--------------------------------------------------------------------------
    */

    public function search(Request $request)
    {
        return redirect()->route(
            'pengaduan.tracking',
            $request->kode
        );
    }

    public function tracking($kode)
    {
        return view(
            'user.pengaduan.tracking',
            compact('kode')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | BERHASIL
    |--------------------------------------------------------------------------
    */

    public function success($kode)
    {
        return view(
            'user.pengaduan.success',
            compact('kode')
        );
    }
}