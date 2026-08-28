<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

use App\Models\Pengaduan;
use Illuminate\Support\Str;

use App\Models\Kecamatan;
use App\Models\Desa;

use Carbon\Carbon;

class PengaduanController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | STEP 1 : DATA ADUAN
    |--------------------------------------------------------------------------
    */



    public function create()
    {
        $aduanTerbaru = Pengaduan::latest()

            ->get();

        return view('user.pengaduan.create', compact('aduanTerbaru'));
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

        $aduanTerbaru = Pengaduan::with('kecamatan')
            ->latest()
            ->get();

        return view(
            'user.pengaduan.lokasi',
            compact('kecamatan', 'aduanTerbaru')
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
            'alamat_kejadian' => 'required',
            'lampiran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $lampiran = null;

        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran')
                ->store('lampiran', 'public');
        }

        Session::put('pengaduan.step2', [
            'id_kecamatan' => $request->id_kecamatan,
            'id_desa' => $request->id_desa,
            'alamat_kejadian' => $request->alamat_kejadian,
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
        $aduanTerbaru = Pengaduan::latest()
            ->latest()
            ->get();

        return view('user.pengaduan.datapribadi', compact('aduanTerbaru'));
    }
    public function storeStep3(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'alamat_domisili' => 'required|string',
            'email' => 'nullable|email',
        ]);

        Session::put('pengaduan.step3', [

            'nama_lengkap' => $request->nama_lengkap,
            'no_whatsapp' => $request->no_whatsapp,
            'email' => $request->email,
            'alamat_domisili' => $request->alamat_domisili,

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
        // Ambil data aduan terbaru untuk sidebar
        $aduanTerbaru = Pengaduan::with('kecamatan')
            ->latest()
            ->get();

        // Ambil data dari session
        $step1 = Session::get('pengaduan.step1');
        $step2 = Session::get('pengaduan.step2');
        $step3 = Session::get('pengaduan.step3');

        $kecamatan = null;
        $desa = null;

        if ($step2) {
            $kecamatan = Kecamatan::find($step2['id_kecamatan']);
            $desa = Desa::find($step2['id_desa']);
        }

        return view('user.pengaduan.konfirmasi', compact(
            'step1',
            'step2',
            'step3',
            'kecamatan',
            'desa',
            'aduanTerbaru'
        ));

    }

    /*
|--------------------------------------------------------------------------
| KIRIM OTP
|--------------------------------------------------------------------------
*/
    public function kirimOtp(Request $request)
    {
        $request->validate([
            'persetujuan' => 'accepted',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'persetujuan.accepted' =>
                'Anda harus menyetujui pernyataan sebelum melanjutkan.',

            'g-recaptcha-response.required' =>
                'Silakan centang "Saya bukan robot".',

            'g-recaptcha-response.captcha' =>
                'Verifikasi reCAPTCHA gagal.',
        ]);

        $step3 = Session::get('pengaduan.step3');

        if (!$step3) {
            return redirect()
                ->route('pengaduan.datapribadi')
                ->with('error', 'Data pribadi tidak ditemukan.');
        }

        $nomor = $step3['no_whatsapp'];

        // Ubah 08xxxxxxxx menjadi 628xxxxxxxx
        if (substr($nomor, 0, 1) === '0') {
            $nomor = '62' . substr($nomor, 1);
        }

        // Hapus OTP lama
        Session::forget('otp');
        Session::forget('otp_expired');

        // Generate OTP 6 digit
        $otp = random_int(100000, 999999);

        // Expired 5 menit
        $expired = now()->addMinutes(5);

        // Simpan OTP
        Session::put('otp', $otp);
        Session::put('otp_expired', $expired);

        // Kirim WhatsApp
        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN')
        ])->post('https://api.fonnte.com/send', [
                    'target' => $nomor,
                    'message' =>
                        "Kode OTP Pengaduan BNNK Tulungagung\n\n" .
                        "Kode OTP Anda : {$otp}\n\n" .
                        "Berlaku selama 5 menit.\n\n" .
                        "Jangan berikan kode ini kepada siapa pun."
                ]);

        // Jika pengiriman gagal
        if (!$response->successful()) {

            Session::forget('otp');
            Session::forget('otp_expired');

            return back()->with(
                'error',
                'OTP gagal dikirim ke WhatsApp. Silakan coba lagi.'
            );
        }

        return redirect()
            ->route('pengaduan.verifikasiOtp')
            ->with('success', 'Kode OTP berhasil dikirim ke WhatsApp Anda.');
    }
    /*
  |--------------------------------------------------------------------------
  | HALAMAN OTP
  |--------------------------------------------------------------------------
  */
    public function verifikasiOtp()
    {
        $expired = Session::get('otp_expired');

        // Jika OTP tidak ada, jangan biarkan user masuk ke halaman OTP
        if (!$expired || !Session::has('otp')) {
            return redirect()
                ->route('pengaduan.datapribadi')
                ->with('error', 'OTP tidak ditemukan. Silakan kirim OTP kembali.');
        }

        // Jika OTP sudah expired
        if (Carbon::now()->greaterThanOrEqualTo($expired)) {
            Session::forget('otp');
            Session::forget('otp_expired');

            return redirect()
                ->route('pengaduan.datapribadi')
                ->with('error', 'OTP telah kedaluwarsa. Silakan kirim OTP kembali.');
        }

        return view('user.pengaduan.verifikasiotp', [
            'expired' => Carbon::parse($expired)->timestamp * 1000,
        ]);
    }
    /*
 |--------------------------------------------------------------------------
 | VERIFIKASI OTP
 |--------------------------------------------------------------------------
 */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => [
                'required',
                'digits:6',
            ],
        ], [
            'otp.required' => 'Silakan masukkan kode OTP.',
            'otp.digits' => 'Kode OTP harus terdiri dari 6 digit.',
        ]);

        $sessionOtp = Session::get('otp');
        $expired = Session::get('otp_expired');

        // OTP tidak ditemukan
        if (!$sessionOtp || !$expired) {

            return back()->with(
                'error',
                'OTP tidak ditemukan. Silakan kirim ulang OTP.'
            );
        }

        // Cek expired
        if (Carbon::now()->greaterThanOrEqualTo(Carbon::parse($expired))) {

            Session::forget('otp');
            Session::forget('otp_expired');

            return back()->with(
                'error',
                'OTP telah kedaluwarsa. Silakan kirim ulang OTP.'
            );
        }

        // Cek OTP
        if ((string) $request->otp !== (string) $sessionOtp) {

            return back()->with(
                'error',
                'Kode OTP yang Anda masukkan salah.'
            );
        }

        // OTP benar
        return $this->store();
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $step1 = Session::get('pengaduan.step1');
        $step2 = Session::get('pengaduan.step2');
        $step3 = Session::get('pengaduan.step3');

        // Pastikan semua session masih ada
        if (!$step1 || !$step2 || !$step3) {

            return redirect()
                ->route('pengaduan.create')
                ->with(
                    'error',
                    'Data pengaduan telah berakhir. Silakan isi kembali dari awal.'
                );
        }

        // Generate kode
        $kode = 'BNNK-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        Pengaduan::create([
            'kode_aduan' => $kode,
            'judul_aduan' => $step1['judul_aduan'],
            'topik_aduan' => $step1['topik_aduan'],
            'detail_aduan' => $step1['detail_aduan'],
            'id_kecamatan' => $step2['id_kecamatan'],
            'id_desa' => $step2['id_desa'],
            'lampiran' => $step2['lampiran'],
            'nama_lengkap' => $step3['nama_lengkap'],
            'no_whatsapp' => $step3['no_whatsapp'],
            'email' => $step3['email'],
            'alamat_domisili' => $step3['alamat_domisili'],
            'otp_verified_at' => now(),
            'status' => 'Diajukan'
        ]);

        // Bersihkan session
        Session::forget('pengaduan');
        Session::forget('otp');
        Session::forget('otp_expired');

        return redirect()->route('pengaduan.success', [
            'kode' => $kode
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | TRACKING
    |--------------------------------------------------------------------------
    */
    public function search(Request $request)
    {
        $request->validate([
            'kode' => 'required'
        ]);

        return redirect()->route('pengaduan.tracking', [
            'kode' => $request->kode
        ]);
    }

    public function tracking($kode)
    {
        $pengaduan = Pengaduan::where('kode_aduan', $kode)->firstOrFail();

        $kecamatan = Kecamatan::find($pengaduan->id_kecamatan);
        $desa = Desa::find($pengaduan->id_desa);

        return view('user.pengaduan.tracking', compact(
            'pengaduan',
            'kecamatan',
            'desa'
        ));
    }
    /*
 |--------------------------------------------------------------------------
 | Tracking Public
 |--------------------------------------------------------------------------
 */

    public function trackingPublic($kode)
    {
        $pengaduan = Pengaduan::with([
            'kecamatan',
            'desa'

        ])
            ->where('kode_aduan', $kode)
            ->first();

        if (!$pengaduan) {

            return redirect()
                ->route('pencarian')
                ->with(
                    'error',
                    'Data pengaduan tidak ditemukan.'
                );
        }

        $kecamatan = $pengaduan->kecamatan;

        return view(
            'user.pengaduan.trackingPublic',
            compact('pengaduan', 'kecamatan')
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

    public function trackingDetail($kode)
    {
        $pengaduan = Pengaduan::where(
            'kode_aduan',
            $kode
        )->first();

        if (!$pengaduan) {

            return redirect('/')
                ->with(
                    'error',
                    'Pengaduan tidak ditemukan.'
                );
        }

        return view(
            'user.pengaduan.tracking',
            compact('pengaduan')
        );
    }

    /*
   |--------------------------------------------------------------------------
   | CARI
   |--------------------------------------------------------------------------
   */
    public function cari(Request $request)
    {
        $topik = $request->input('topik');

        $aduanTerbaru = Pengaduan::query()
            ->when($topik, function ($query) use ($topik) {
                $query->where('topik_aduan', 'like', '%' . $topik . '%');
            })
            ->latest()
            ->get();

        return view('user.pengaduan.create', [
            'aduanTerbaru' => $aduanTerbaru,
        ]);
    }
}