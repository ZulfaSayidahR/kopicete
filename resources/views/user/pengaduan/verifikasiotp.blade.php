@extends('layouts.app')

@section('title', 'Verifikasi OTP')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-card">

                {{-- HEADER --}}
                <div class="pengaduan-header">

                    <div class="header-icon">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>

                    <div>
                        <h2>Verifikasi Nomor WhatsApp</h2>

                        <p>
                            Masukkan kode OTP yang telah dikirim ke nomor WhatsApp Anda.
                        </p>
                    </div>

                </div>


                {{-- BODY --}}
                <div class="pengaduan-body">

                    {{-- DATA WHATSAPP --}}
                    @php

                        $step3 = session('pengaduan.step3');

                        $wa = $step3['no_whatsapp'] ?? null;

                        if ($wa) {

                            $waTampil =
                                substr($wa, 0, 4)
                                . '******'
                                . substr($wa, -3);

                        } else {

                            $waTampil = '-';

                        }

                    @endphp


                    {{-- INFORMASI OTP --}}
                    <div class="text-center mb-4">

                        <div class="otp-icon">

                            <i class="bi bi-whatsapp"></i>

                        </div>


                        <h4 class="mt-3">

                            Kode OTP Telah Dikirim

                        </h4>


                        <p class="text-muted">

                            Kami telah mengirim kode verifikasi ke

                            <br>

                            <strong>
                                {{ $waTampil }}
                            </strong>

                        </p>


                        <small class="text-danger fw-bold">

                            OTP akan berakhir dalam

                            <span id="countdown">
                                05:00
                            </span>

                        </small>

                    </div>


                    {{-- SUCCESS --}}
                    @if(session('success'))

                        <div class="alert alert-success alert-dismissible fade show">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            {{ session('success') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert">
                            </button>

                        </div>

                    @endif


                    {{-- ERROR --}}
                    @if(session('error'))

                        <div class="alert alert-danger alert-dismissible fade show">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            {{ session('error') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert">
                            </button>

                        </div>

                    @endif


                    {{-- ERROR VALIDASI --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            {{ $errors->first() }}

                        </div>

                    @endif


                    {{-- FORM VERIFIKASI OTP --}}
                    <form action="{{ route('pengaduan.verifyOtp') }}" method="POST" id="otpForm">

                        @csrf


                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Masukkan Kode OTP

                            </label>


                            <input type="text" name="otp" id="otp" maxlength="6" minlength="6" pattern="[0-9]{6}"
                                inputmode="numeric" class="form-control text-center fs-4" placeholder="------"
                                autocomplete="one-time-code" required>


                            @error('otp')

                                <small class="text-danger">

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>


                        {{-- BUTTON VERIFIKASI --}}
                        <button type="submit" id="btnVerify" class="btn btn-primary w-100">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            Verifikasi OTP

                        </button>

                    </form>


                    <hr>


                    {{-- KIRIM ULANG OTP --}}
                    <div class="text-center">

                        <small class="text-muted">

                            Belum menerima kode OTP?

                        </small>


                        <form action="{{ route('pengaduan.kirimOtp') }}" method="POST" class="mt-2" id="resendForm">

                            @csrf


                            <button type="submit" id="btnResend" class="btn btn-link" disabled>

                                <i class="bi bi-arrow-repeat"></i>

                                Kirim ulang OTP

                                <span id="resendText"></span>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT COUNTDOWN OTP --}}
    {{-- ========================================================= --}}

    <script>

        document.addEventListener("DOMContentLoaded", function () {

            /*
            |--------------------------------------------------------------------------
            | Ambil waktu expired dari Laravel
            |--------------------------------------------------------------------------
            */

            const expiredTime = Number(@json($expired));


            /*
            |--------------------------------------------------------------------------
            | Element HTML
            |--------------------------------------------------------------------------
            */

            const countdown =
                document.getElementById("countdown");

            const verify =
                document.getElementById("btnVerify");

            const resend =
                document.getElementById("btnResend");

            const resendText =
                document.getElementById("resendText");

            const otp =
                document.getElementById("otp");


            /*
            |--------------------------------------------------------------------------
            | Timer
            |--------------------------------------------------------------------------
            */

            let timer = null;


            /*
            |--------------------------------------------------------------------------
            | Fungsi Countdown
            |--------------------------------------------------------------------------
            */

            function updateTimer() {

                const now = Date.now();

                const distance =
                    expiredTime - now;


                /*
                |--------------------------------------------------------------------------
                | OTP EXPIRED
                |--------------------------------------------------------------------------
                */

                if (distance <= 0) {

                    countdown.textContent = "00:00";


                    // OTP tidak bisa diverifikasi
                    verify.disabled = true;


                    // Tombol kirim ulang aktif
                    resend.disabled = false;


                    // Hilangkan countdown dari tombol resend
                    resendText.textContent = "";


                    // Hentikan timer
                    if (timer !== null) {

                        clearInterval(timer);

                        timer = null;

                    }


                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Hitung menit
                |--------------------------------------------------------------------------
                */

                const minutes =
                    Math.floor(distance / 60000);


                /*
                |--------------------------------------------------------------------------
                | Hitung detik
                |--------------------------------------------------------------------------
                */

                const seconds =
                    Math.floor(
                        (distance % 60000) / 1000
                    );


                /*
                |--------------------------------------------------------------------------
                | Format MM:SS
                |--------------------------------------------------------------------------
                */

                const time =
                    String(minutes).padStart(2, '0')
                    + ":"
                    + String(seconds).padStart(2, '0');


                /*
                |--------------------------------------------------------------------------
                | Tampilkan countdown
                |--------------------------------------------------------------------------
                */

                countdown.textContent = time;


                /*
                |--------------------------------------------------------------------------
                | OTP masih aktif
                |--------------------------------------------------------------------------
                */

                verify.disabled = false;

                resend.disabled = true;


                resendText.textContent =
                    " (" + time + ")";

            }


            /*
            |--------------------------------------------------------------------------
            | Jalankan timer langsung
            |--------------------------------------------------------------------------
            */

            updateTimer();


            /*
            |--------------------------------------------------------------------------
            | Jalankan setiap 1 detik
            |--------------------------------------------------------------------------
            */

            timer = setInterval(
                updateTimer,
                1000
            );


            /*
            |--------------------------------------------------------------------------
            | Hanya izinkan angka pada input OTP
            |--------------------------------------------------------------------------
            */

            otp.addEventListener(
                "input",
                function () {

                    this.value =
                        this.value
                            .replace(/\D/g, '')
                            .slice(0, 6);

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Cegah submit OTP jika belum 6 digit
            |--------------------------------------------------------------------------
            */

            document
                .getElementById("otpForm")
                .addEventListener(
                    "submit",
                    function (event) {

                        if (otp.value.length !== 6) {

                            event.preventDefault();

                            alert(
                                "Kode OTP harus terdiri dari 6 digit."
                            );

                            otp.focus();

                        }

                    }
                );


        /*|--------------------------------------------------------------------------
                | Saat kirim ulang OTP
                |--------------------------------------------------------------------------
                */

                document
                    .getElementById("resendForm")
                    .addEventListener(
                        "submit",
                        function () {

                            /*
                            | Disable tombol supaya tidak
                            | diklik berkali-kali
                            */

                            resend.disabled = true;

                            resend.innerHTML =
                                '<i class="bi bi-arrow-repeat"></i> Mengirim OTP...';

                        }
                    );

            });

        </script>

@endsection