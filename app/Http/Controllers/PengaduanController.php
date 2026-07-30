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
    | STEP 1 : Data Aduan
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

            'detail_aduan' => 'required'

        ]);


        Session::put('pengaduan.step1', [

            'judul_aduan' => $request->judul_aduan,

            'topik_aduan' => $request->topik_aduan,

            'detail_aduan' => $request->detail_aduan,

        ]);


        return redirect()
            ->route('pengaduan.lokasi');

    }



    /*
    |--------------------------------------------------------------------------
    | HALAMAN STEP 2 : Lokasi
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
    | AJAX AMBIL DESA BERDASARKAN KECAMATAN
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
    | STEP 2 : Simpan Lokasi
    |--------------------------------------------------------------------------
    */

    public function storeStep2(Request $request)
    {


        $request->validate([

            'id_kecamatan' => 'required|exists:kecamatan,id_kecamatan',

            'id_desa' => 'required|exists:desa,id_desa',

            'lampiran' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);



        $lampiran = null;



        if ($request->hasFile('lampiran')) {

            $lampiran = $request
                ->file('lampiran')
                ->store(
                    'lampiran',
                    'public'
                );

        }




        Session::put('pengaduan.step2', [


            'id_kecamatan' => $request->id_kecamatan,


            'id_desa' => $request->id_desa,


            'lampiran' => $lampiran,


        ]);



        return redirect()
            ->route('pengaduan.datapribadi');

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



        return redirect()
            ->route('pengaduan.konfirmasi');

    }

};

    /*
|--------------------------------------------------------------------------
| STEP 4 : KONFIRMASI
|--------------------------------------------------------------------------
*/

Route::get(
    '/konfirmasi',
    [PengaduanController::class, 'konfirmasi']
)->name('pengaduan.konfirmasi');


// KIRIM OTP

Route::post(
    '/kirim-otp',
    [PengaduanController::class, 'kirimOtp']
)->name('pengaduan.kirimOtp');





// HALAMAN OTP

Route::get(
    '/verifikasi-otp',
    [PengaduanController::class, 'verifikasiOtp']
)->name('pengaduan.verifikasiOtp');



    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENGADUAN
    |--------------------------------------------------------------------------
    */


    public function store(Request $request)
    {

        $request->validate(
            [

                'judul_aduan' => 'required',
                'detail_aduan' => 'required',
                'pernyataan' => 'required'

            ],
            [

                'pernyataan.required' =>
                    'Anda harus menyetujui pernyataan kebenaran laporan.'

            ]
        );


        $step1 = Session::get('pengaduan.step1');
        $step2 = Session::get('pengaduan.step2');
        $step3 = Session::get('pengaduan.step3');


        // simpan data ke database


        return redirect()->route('pengaduan.success', [
            'kode' => 'BNNK-001'
        ]);

    }



    /*
    |--------------------------------------------------------------------------
    | OTP
    |--------------------------------------------------------------------------
    */


    public function verifikasiOtp()
    {
        return view(
            'user.pengaduan.verifikasiotp'
        );
    }



    public function verifyOtp(Request $request)
    {

        $request->validate([

            'otp' => 'required|min:6|max:6'

        ]);



        return redirect()
            ->route(
                'pengaduan.success',
                [
                    'kode' => 'BNNK-123456'
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

        $kode = $request->kode;


        return redirect()
            ->route(
                'pengaduan.tracking',
                $kode
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