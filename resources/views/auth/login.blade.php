@extends('layouts.app')

@section('title','Login Admin')

@section('content')

<section class="login-page">

    <div class="container">

        <div class="login-wrapper">

            <!-- Background Card -->

            <div class="login-card">

                <div class="login-logo">

                    <img src="{{ asset('images/logo-bnn.png') }}" alt="Logo">

                    <h3>BNNK TULUNGAGUNG</h3>

                    <p>
                        Portal Administrator Pengaduan &
                        Permohonan
                    </p>

                </div>

                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    <h4>Selamat Datang</h4>

                    <p class="login-subtitle">
                        Silakan masuk menggunakan akun Admin.
                    </p>

                    <div class="mb-3">

                        <label class="form-label">

                            Email

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-envelope-fill"></i>

                            </span>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Masukkan Email">

                        </div>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">

                            Password

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-lock-fill"></i>

                            </span>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan Password">

                        </div>

                    </div>

                    <div class="login-option">

                        <label>

                            <input type="checkbox">

                            Ingat Saya

                        </label>

                        <a href="#">

                            Lupa Password?

                        </a>

                    </div>

                    <button class="btn-login">

                        <i class="bi bi-box-arrow-in-right"></i>

                        Masuk

                    </button>

                    <a href="{{ route('home') }}" class="btn-kembali">

                        <i class="bi bi-arrow-left"></i>

                        Kembali ke Beranda

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection