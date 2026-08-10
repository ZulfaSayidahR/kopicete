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

                    @php

                        $data = session('permohonan.data');

                        $wa = $data['no_hp'] ?? null;

                        if ($wa) {

                            $waTampil =
                                substr($wa, 0, 4)
                                . '******'
                                . substr($wa, -3);

                        } else {

                            $waTampil = '-';

                        }

                    @endphp

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

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- ERROR --}}
                    @if(session('error'))

                        <div class="alert alert-danger">

                            {{ session('error') }}

                        </div>

                    @endif


                    {{-- FORM OTP --}}
                    <form action="{{ route('permohonan.verifyOtp') }}" method="POST">

                        @csrf

                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Masukkan Kode OTP

                            </label>

                            <input type="text" name="otp" maxlength="6" minlength="6" pattern="[0-9]{6}" inputmode="numeric"
                                class="form-control text-center fs-4" placeholder="123456" autocomplete="off" required>

                            @error('otp')

                                <small class="text-danger">

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>

                        <button type="submit" id="btnVerify" class="btn btn-primary w-100">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            Verifikasi OTP

                        </button>

                    </form>

                    <hr>

                    <div class="text-center">

                        <small class="text-muted">

                            Belum menerima kode OTP?

                        </small>

                        <form action="{{ route('permohonan.kirimUlangOtp') }}" method="POST" class="mt-2">

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


    <script>

        document.addEventListener("DOMContentLoaded", function () {

            const expiredTime = Number("{{ $expired }}");

            const countdown =
                document.getElementById("countdown");

            const verify =
                document.getElementById("btnVerify");

            const resend =
                document.getElementById("btnResend");

            const resendText =
                document.getElementById("resendText");


            function updateTimer() {

                const now = Date.now();

                const distance =
                    expiredTime - now;


                if (distance <= 0) {

                    countdown.innerHTML = "00:00";

                    verify.disabled = true;

                    resend.disabled = false;

                    resendText.innerHTML = "";

                    clearInterval(timer);

                    return;
                }


                const minutes =
                    Math.floor(distance / 60000);


                const seconds =
                    Math.floor(
                        (distance % 60000) / 1000
                    );


                const time =
                    String(minutes).padStart(2, '0')
                    + ":"
                    + String(seconds).padStart(2, '0');


                countdown.innerHTML = time;

                resend.disabled = true;

                resendText.innerHTML =
                    " (" + time + ")";

            }


            updateTimer();


            const timer =
                setInterval(updateTimer, 1000);

        });

    </script>

@endsection