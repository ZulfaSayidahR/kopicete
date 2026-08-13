<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Permohonan;

class PermohonanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM PERMOHONAN
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $permohonanTerbaru = Permohonan::latest()
            ->take(5)
            ->get();

        return view('user.permohonan.create', compact('permohonanTerbaru'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN FORM SEMENTARA → KONFIRMASI
    |--------------------------------------------------------------------------
    */

    public function konfirmasi(Request $request)
    {
        $data = $request->validate([

            'jenis_permohonan' => 'required|string|max:255',

            'nama_penyelenggara' => 'required|string|max:255',

            'tanggal_kegiatan' => 'required|date',

            'waktu_kegiatan' => 'required',

            'tempat' => 'required|string|max:255',

            'penanggung_jawab' => 'required|string|max:255',

            'no_hp' => 'required|string|max:20',

            'jumlah_peserta' => 'required|integer|min:1',

            'keterangan' => 'nullable|string',

            'lampiran' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD LAMPIRAN
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('lampiran')) {

            $data['lampiran'] = $request->file('lampiran')->store(
                'permohonan',
                'public'
            );

        } else {

            $data['lampiran'] = null;

        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA KE SESSION
        |--------------------------------------------------------------------------
        */

        Session::put(
            'permohonan.data',
            $data
        );


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN HALAMAN KONFIRMASI
        |--------------------------------------------------------------------------
        */

        return view(
            'user.permohonan.konfirmasi',
            [
                'data' => $data,
        'permohonanTerbaru' => Permohonan::latest()
            ->take(5)
            ->get()
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | KIRIM OTP
    |--------------------------------------------------------------------------
    */

    public function kirimOtp(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PERMOHONAN
        |--------------------------------------------------------------------------
        */

        $data = Session::get('permohonan.data');

        if (!$data) {

            return redirect()
                ->route('permohonan.create')
                ->with(
                    'error',
                    'Sesi permohonan telah berakhir. Silakan isi formulir kembali.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | NOMOR WHATSAPP
        |--------------------------------------------------------------------------
        */

        $nomor = $data['no_hp'];


        // Hilangkan spasi
        $nomor = preg_replace('/\s+/', '', $nomor);


        // Ubah 08xxxxxxxx menjadi 628xxxxxxxx
        if (substr($nomor, 0, 1) === '0') {

            $nomor = '62' . substr($nomor, 1);

        }


        /*
        |--------------------------------------------------------------------------
        | GENERATE OTP
        |--------------------------------------------------------------------------
        */

        $otp = rand(100000, 999999);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN OTP
        |--------------------------------------------------------------------------
        */

        Session::put(
            'permohonan.otp',
            $otp
        );


        /*
        |--------------------------------------------------------------------------
        | WAKTU EXPIRED 5 MENIT
        |--------------------------------------------------------------------------
        */

        $expired = Carbon::now()->addMinutes(5);


        Session::put(
            'permohonan.otp_expired',
            $expired
        );


        /*
        |--------------------------------------------------------------------------
        | KIRIM OTP WHATSAPP
        |--------------------------------------------------------------------------
        */

        try {

            Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN')
            ])->post(
                    'https://api.fonnte.com/send',
                    [

                        'target' => $nomor,

                        'message' =>
                            "Kode OTP Permohonan BNNK Tulungagung\n\n" .
                            "Kode OTP Anda : $otp\n\n" .
                            "Berlaku selama 5 menit.\n\n" .
                            "Jangan berikan kode ini kepada siapa pun."

                    ]
                );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                'OTP gagal dikirim. Silakan coba lagi.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | KE HALAMAN OTP
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('permohonan.otp');
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN OTP
    |--------------------------------------------------------------------------
    */

    public function otp()
    {
        /*
        |--------------------------------------------------------------------------
        | CEK DATA PERMOHONAN
        |--------------------------------------------------------------------------
        */

        if (!Session::has('permohonan.data')) {

            return redirect()
                ->route('permohonan.create')
                ->with(
                    'error',
                    'Silakan isi formulir permohonan terlebih dahulu.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA
        |--------------------------------------------------------------------------
        */

        $data = Session::get('permohonan.data');

        $expired = Session::get(
            'permohonan.otp_expired'
        );


        /*
        |--------------------------------------------------------------------------
        | NOMOR WHATSAPP
        |--------------------------------------------------------------------------
        */

        $nomor = $data['no_hp'] ?? '';

        if ($nomor) {

            $waTampil =
                substr($nomor, 0, 4) .
                '******' .
                substr($nomor, -3);

        } else {

            $waTampil = '-';

        }


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN OTP
        |--------------------------------------------------------------------------
        */

        return view(
            'user.permohonan.verifikasiOtp',
            [

                'expired' => $expired
                    ? $expired->timestamp * 1000
                    : 0,

                'waTampil' => $waTampil

            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI OTP
    |--------------------------------------------------------------------------
    */

    public function verifyOtp(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'otp' => 'required|digits:6'

        ], [

            'otp.required' =>
                'Kode OTP wajib diisi.',

            'otp.digits' =>
                'Kode OTP harus terdiri dari 6 angka.'

        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL SESSION
        |--------------------------------------------------------------------------
        */

        $otpSession = Session::get(
            'permohonan.otp'
        );

        $expired = Session::get(
            'permohonan.otp_expired'
        );

        $data = Session::get(
            'permohonan.data'
        );


        /*
        |--------------------------------------------------------------------------
        | CEK DATA
        |--------------------------------------------------------------------------
        */

        if (!$otpSession || !$data || !$expired) {

            return redirect()
                ->route('permohonan.create')
                ->with(
                    'error',
                    'Sesi permohonan telah berakhir.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK EXPIRED
        |--------------------------------------------------------------------------
        */

        if (Carbon::now()->greaterThan($expired)) {

            Session::forget([
                'permohonan.otp',
                'permohonan.otp_expired'
            ]);

            return back()
                ->with(
                    'error',
                    'Kode OTP telah kedaluwarsa. Silakan kirim ulang OTP.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK OTP
        |--------------------------------------------------------------------------
        */

        if ((string) $request->otp !== (string) $otpSession) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Kode OTP yang Anda masukkan salah.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GENERATE KODE PERMOHONAN
        |--------------------------------------------------------------------------
        */

        do {

            $kode =
                'PMH-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(Str::random(5));

        } while (
            Permohonan::where(
                'kode_permohonan',
                $kode
            )->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $permohonan = Permohonan::create([

            'kode_permohonan' =>
                $kode,

            'jenis_permohonan' =>
                $data['jenis_permohonan'],

            'nama_penyelenggara' =>
                $data['nama_penyelenggara'],

            'tanggal_kegiatan' =>
                $data['tanggal_kegiatan'],

            'waktu_kegiatan' =>
                $data['waktu_kegiatan'],

            'tempat' =>
                $data['tempat'],

            'penanggung_jawab' =>
                $data['penanggung_jawab'],

            'no_hp' =>
                $data['no_hp'],

            'jumlah_peserta' =>
                $data['jumlah_peserta'],

            'keterangan' =>
                $data['keterangan'] ?? null,

            'lampiran' =>
                $data['lampiran'] ?? null,

            'status' =>
                'Menunggu'

        ]);


        /*
        |--------------------------------------------------------------------------
        | HAPUS SESSION
        |--------------------------------------------------------------------------
        */

        Session::forget([
            'permohonan.data',
            'permohonan.otp',
            'permohonan.otp_expired'
        ]);


        /*
        |--------------------------------------------------------------------------
        | HALAMAN BERHASIL
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'permohonan.success',
                $permohonan->kode_permohonan
            );
    }


    /*
|--------------------------------------------------------------------------
| TRACKING PERMOHONAN
|--------------------------------------------------------------------------
*/

    public function tracking($kode)
    {
        $permohonan = Permohonan::where(
            'kode_permohonan',
            $kode
        )->firstOrFail();

        return view(
            'user.permohonan.tracking',
            compact('permohonan')
        );
    }
    /*
    |--------------------------------------------------------------------------
    | HALAMAN BERHASIL
    |--------------------------------------------------------------------------
    */

    public function success($kode)
    {
        $permohonan = Permohonan::where(
            'kode_permohonan',
            $kode
        )->firstOrFail();

        return view(
            'user.permohonan.success',
            compact('permohonan')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | KIRIM ULANG OTP
    |--------------------------------------------------------------------------
    */

    public function kirimUlangOtp(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA
        |--------------------------------------------------------------------------
        */

        $data = Session::get(
            'permohonan.data'
        );


        if (!$data) {

            return redirect()
                ->route('permohonan.create')
                ->with(
                    'error',
                    'Sesi permohonan telah berakhir.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | NOMOR HP
        |--------------------------------------------------------------------------
        */

        $nomor = $data['no_hp'];


        $nomor = preg_replace(
            '/\s+/',
            '',
            $nomor
        );


        if (substr($nomor, 0, 1) === '0') {

            $nomor =
                '62' .
                substr($nomor, 1);

        }


        /*
        |--------------------------------------------------------------------------
        | OTP BARU
        |--------------------------------------------------------------------------
        */

        $otp = rand(
            100000,
            999999
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN OTP BARU
        |--------------------------------------------------------------------------
        */

        Session::put(
            'permohonan.otp',
            $otp
        );


        /*
        |--------------------------------------------------------------------------
        | RESET WAKTU 5 MENIT
        |--------------------------------------------------------------------------
        */

        $expired =
            Carbon::now()->addMinutes(5);


        Session::put(
            'permohonan.otp_expired',
            $expired
        );


        /*
        |--------------------------------------------------------------------------
        | KIRIM WHATSAPP
        |--------------------------------------------------------------------------
        */

        try {

            Http::withHeaders([
                'Authorization' =>
                    env('FONNTE_TOKEN')

            ])->post(
                    'https://api.fonnte.com/send',
                    [

                        'target' =>
                            $nomor,

                        'message' =>
                            "Kode OTP Baru Permohonan BNNK Tulungagung\n\n" .
                            "Kode OTP Anda : $otp\n\n" .
                            "Berlaku selama 5 menit.\n\n" .
                            "Jangan berikan kode ini kepada siapa pun."

                    ]
                );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                'OTP gagal dikirim ulang.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE HALAMAN OTP
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('permohonan.otp')
            ->with(
                'success',
                'OTP baru telah dikirim ke WhatsApp Anda.'
            );
    }

     /*
    |--------------------------------------------------------------------------
    | CARI
    |--------------------------------------------------------------------------
    */
    public function cari(Request $request)
{
    $query = Permohonan::query();

    if ($request->filled('jenis_permohonan')) {
        $query->where(
            'jenis_permohonan',
            'like',
            '%' . $request->jenis_permohonan . '%'
        );
    }

    $permohonanTerbaru = $query
        ->latest()
        ->get();

    return view('user.permohonan.create', compact('permohonanTerbaru'));
}

}