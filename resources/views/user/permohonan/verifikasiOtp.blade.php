@extends('layouts.app')

@section('title', 'Verifikasi OTP')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-card">

                {{-- ===================================================== --}}
                {{-- HEADER --}}
                {{-- ===================================================== --}}

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


                {{-- ===================================================== --}}
                {{-- BODY --}}
                {{-- ===================================================== --}}

                <div class="pengaduan-body">

                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | DATA PERMOHONAN
                        |--------------------------------------------------------------------------
                        */

                        $data = session('permohonan.data');

                        /*
                        |--------------------------------------------------------------------------
                        | NOMOR WHATSAPP
                        |--------------------------------------------------------------------------
                        */

                        $wa = $data['no_hp'] ?? null;


                        /*
                        |--------------------------------------------------------------------------
                        | MASKING NOMOR WHATSAPP
                        |--------------------------------------------------------------------------
                        */

                        if ($wa) {

                            $waTampil =
                                substr($wa, 0, 4)
                                . '******'
                                . substr($wa, -3);

                        } else {

                            $waTampil = '-';

                        }

                    @endphp


                    {{-- ================================================= --}}
                    {{-- INFORMASI OTP --}}
                    {{-- ================================================= --}}

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


                        {{-- COUNTDOWN --}}
                        <small class="text-danger fw-bold">

                            OTP akan berakhir dalam

                            <span id="countdown">
                                05:00
                            </span>

                        </small>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SUCCESS --}}
                    {{-- ================================================= --}}

                    @if(session('success'))

                        <div class="alert alert-success alert-dismissible fade show">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            {{ session('success') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert">
                            </button>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- ERROR --}}
                    {{-- ================================================= --}}

                    @if(session('error'))

                        <div class="alert alert-danger alert-dismissible fade show">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            {{ session('error') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert">
                            </button>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- VALIDATION ERROR --}}
                    {{-- ================================================= --}}

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            {{ $errors->first() }}

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- FORM VERIFIKASI OTP --}}
                    {{-- ================================================= --}}

                    <form action="{{ route('permohonan.verifyOtp') }}" method="POST" id="otpForm">

                        @csrf


                        <div class="mb-4">

                            <label for="otp" class="form-label fw-bold">

                                Masukkan Kode OTP

                            </label>


                            <input type="text" name="otp" id="otp" maxlength="6" minlength="6" pattern="[0-9]{6}"
                                inputmode="numeric" class="form-control text-center fs-4" placeholder="123456"
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


                    {{-- ================================================= --}}
                    {{-- KIRIM ULANG OTP --}}
                    {{-- ================================================= --}}

                    <div class="text-center">

                        <small class="text-muted">

                            Belum menerima kode OTP?

                        </small>


                        <form action="{{ route('permohonan.kirimUlangOtp') }}" method="POST" class="mt-2" id="resendForm">

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


    {{-- ============================================================= --}}
    {{-- JAVASCRIPT COUNTDOWN OTP --}}
    {{-- ============================================================= --}}

    <script>

        document.addEventListener("DOMContentLoaded", function () {

            /*
            |--------------------------------------------------------------------------
            | WAKTU EXPIRED DARI SERVER
            |--------------------------------------------------------------------------
            |
            | Controller mengirim:
            |
            | $expired->timestamp * 1000
            |
            | sehingga JavaScript menerima waktu dalam milliseconds.
            |
            */

            const expiredTime = Number(@json($expired));


            /*
            |--------------------------------------------------------------------------
            | ELEMENT HTML
            |--------------------------------------------------------------------------
            */

            const countdown =
                document.getElementById("countdown");

            const btnVerify =
                document.getElementById("btnVerify");

            const btnResend =
                document.getElementById("btnResend");

            const resendText =
                document.getElementById("resendText");

            const otpInput =
                document.getElementById("otp");

            const otpForm =
                document.getElementById("otpForm");

            const resendForm =
                document.getElementById("resendForm");


            /*
            |--------------------------------------------------------------------------
            | TIMER
            |--------------------------------------------------------------------------
            */

            let timer = null;


            /*
            |--------------------------------------------------------------------------
            | CEK APAKAH WAKTU VALID
            |--------------------------------------------------------------------------
            */

            if (
                !expiredTime ||
                isNaN(expiredTime) ||
                expiredTime <= 0
            ) {

                countdown.textContent = "00:00";

                btnVerify.disabled = true;

                btnResend.disabled = false;

            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE TIMER
            |--------------------------------------------------------------------------
            */

            function updateTimer() {

                const now = Date.now();

                const distance =
                    expiredTime - now;


                /*
                |--------------------------------------------------------------------------
                | OTP SUDAH EXPIRED
                |--------------------------------------------------------------------------
                */

                if (distance <= 0) {

                    countdown.textContent = "00:00";


                    /*
                    | Matikan tombol verifikasi
                    */

                    btnVerify.disabled = true;


                    /*
                    | Aktifkan tombol kirim ulang
                    */

                    btnResend.disabled = false;


                    /*
                    | Hapus countdown pada tombol resend
                    */

                    resendText.textContent = "";


                    /*
                    | Hentikan interval
                    */

                    if (timer !== null) {

                        clearInterval(timer);

                        timer = null;

                    }


                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | HITUNG MENIT
                |--------------------------------------------------------------------------
                */

                const minutes =
                    Math.floor(
                        distance / 60000
                    );


                /*
                |--------------------------------------------------------------------------
                | HITUNG DETIK
                |--------------------------------------------------------------------------
                */

                const seconds =
                    Math.floor(
                        (distance % 60000) / 1000
                    );


                /*
                |--------------------------------------------------------------------------
                | FORMAT MM:SS
                |--------------------------------------------------------------------------
                */

                const time =
                    String(minutes).padStart(2, '0')
                    + ":"
                    + String(seconds).padStart(2, '0');


                /*
                |--------------------------------------------------------------------------
                | TAMPILKAN COUNTDOWN
                |--------------------------------------------------------------------------
                */

                countdown.textContent = time;


                /*
                |--------------------------------------------------------------------------
                | OTP MASIH AKTIF
                |--------------------------------------------------------------------------
                */

                btnVerify.disabled = false;

                btnResend.disabled = true;


                /*
                |--------------------------------------------------------------------------
                | TAMPILKAN WAKTU PADA TOMBOL RESEND
                |--------------------------------------------------------------------------
                */

                resendText.textContent =
                    " (" + time + ")";

            }


            /*
            |--------------------------------------------------------------------------
            | JALANKAN TIMER PERTAMA KALI
            |--------------------------------------------------------------------------
            */

            if (
                expiredTime &&
                !isNaN(expiredTime)
            ) {

                updateTimer();


                /*
                |--------------------------------------------------------------------------
                | UPDATE SETIAP 1 DETIK
                |--------------------------------------------------------------------------
                */

                timer = setInterval(
                    updateTimer,
                    1000
                );

            }


            /*
            |--------------------------------------------------------------------------
            | INPUT OTP HANYA ANGKA
            |--------------------------------------------------------------------------
            */

            otpInput.addEventListener(
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
            | FORM VERIFIKASI
            |--------------------------------------------------------------------------
            */

            otpForm.addEventListener(
                "submit",
                function (event) {

                    /*
                    | Pastikan OTP 6 digit
                    */

                    if (
                        otpInput.value.length !== 6
                    ) {

                        event.preventDefault();

                        alert(
                            "Kode OTP harus terdiri dari 6 digit."
                        );

                        otpInput.focus();

                        return;

                    }


                    /*
                    | Disable tombol supaya
                    | tidak diklik berkali-kali
                    */

                    btnVerify.disabled = true;


                    btnVerify.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2"></span>' +
                        'Memverifikasi...';

                }
            );


            /*
            |--------------------------------------------------------------------------
            | FORM KIRIM ULANG
            |--------------------------------------------------------------------------
            */

            resendForm.addEventListener(
                "submit",
                function () {

                    /*
                    | Cegah klik berkali-kali
                    */

                    btnResend.disabled = true;


                    /*
                    | Tampilkan proses pengiriman
                    */

                    btnResend.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2"></span>' +
                        'Mengirim OTP...';

                }
            );

        });

    </script>

@endsection