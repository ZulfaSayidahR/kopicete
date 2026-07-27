@extends('layouts.app')

@section('title', 'Verifikasi OTP')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-card">

                <!-- Header -->
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

                <!-- Body -->
                <div class="pengaduan-body">

                    <div class="text-center mb-4">

                        <div class="otp-icon">

                            <i class="bi bi-whatsapp"></i>

                        </div>

                        <h4 class="mt-3">
                            Kode OTP telah dikirim
                        </h4>

                        <p class="text-muted">

                            Kami telah mengirim kode verifikasi ke

                            <br>

                            <strong>0896******123</strong>

                        </p>

                    </div>

                    <form action="{{ route('pengaduan.otp.verify') }}" method="POST">

                        @csrf

                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Masukkan Kode OTP

                            </label>

                            <input type="text" name="otp" maxlength="6" class="form-control otp-input"
                                placeholder="Contoh : 834921">

                        </div>

                        <div class="text-center mb-4">

                            <small class="text-muted">

                                Tidak menerima kode?

                            </small>

                            <br>

                            <a href="#">

                                Kirim Ulang OTP

                            </a>

                        </div>

                        <a href="{{ route('home') }}" class="btn btn-primary w-100">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            Verifikasi OTP

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </section>

@endsection