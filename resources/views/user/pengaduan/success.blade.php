@extends('layouts.app')

@section('title', 'Pengaduan Berhasil')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-card text-center">

                <div class="pengaduan-header">

                    <div class="header-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                    <h2>Pengaduan Berhasil Dikirim</h2>

                    <p>
                        Terima kasih, laporan Anda sudah berhasil
                        masuk ke sistem BNNK Tulungagung.
                    </p>

                </div>

                <div class="pengaduan-body">

                    <div class="mb-4">

                        <i class="bi bi-check-circle-fill text-success" style="font-size: 70px;">
                        </i>

                    </div>

                    <h4 class="fw-bold">
                        Pengaduan Anda telah berhasil dikirim
                    </h4>

                    <p class="text-muted">
                        Simpan kode pengaduan berikut untuk memantau
                        perkembangan laporan Anda.
                    </p>

                    <div class="card border-0 bg-light shadow-sm mt-4">

                        <div class="card-body">

                            <p class="mb-2 text-muted">
                                Kode Pengaduan
                            </p>

                            <h2 class="fw-bold text-primary">
                                {{ $kode }}
                            </h2>

                        </div>

                    </div>

                    {{-- =================================================
                    ALERT PENTING - SIMPAN KODE
                    ================================================== --}}

                    <div class="alert alert-warning text-start border-warning rounded-4 mt-4 mb-4">

                        <div class="d-flex align-items-start">

                            <div class="me-3">

                                <i class="bi bi-exclamation-triangle-fill" style="font-size: 28px;">
                                </i>

                            </div>

                            <div>

                                <strong class="d-block mb-2">

                                    Penting! Simpan Kode Pengaduan Anda

                                </strong>

                                <p class="mb-2">

                                    Mohon <strong>catat, screenshot, atau simpan</strong>
                                    kode pengaduan di tempat yang aman.
                                    Kode ini diperlukan untuk melihat
                                    perkembangan dan status pengaduan Anda
                                    melalui halaman tracking pengaduan.

                                </p>

                                <p class="mb-0">

                                    <strong>
                                        Jangan membagikan kode pengaduan
                                        kepada orang lain.
                                    </strong>

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                    ALERT JIKA LUPA KODE
                    ================================================== --}}

                    <div class="alert alert-danger text-start border-danger rounded-4 mb-4">

                        <div class="d-flex align-items-start">

                            <div class="me-3">

                                <i class="bi bi-shield-exclamation" style="font-size: 28px;">
                                </i>

                            </div>

                            <div>

                                <strong class="d-block mb-2">

                                    Lupa atau Kehilangan Kode?

                                </strong>

                                <p class="mb-2">

                                    Jika Anda lupa atau kehilangan
                                    kode pengaduan, silakan
                                    <strong>hubungi Admin BNNK Tulungagung</strong>
                                    untuk mendapatkan bantuan.

                                </p>

                                <p class="mb-0">

                                    <i class="bi bi-telephone-fill me-1"></i>

                                    Pastikan Anda memberikan informasi
                                    yang diperlukan kepada admin untuk
                                    membantu proses pencarian data
                                    pengaduan Anda.

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                    INFORMASI TRACKING
                    ================================================== --}}

                    <div class="alert alert-info text-start rounded-4 mb-4">

                        <i class="bi bi-info-circle-fill me-2"></i>

                        <strong>Informasi Pelacakan</strong>

                        <p class="mb-0 mt-2">

                            Gunakan kode pengaduan tersebut pada
                            halaman <strong>Tracking Pengaduan</strong>
                            untuk melihat status dan perkembangan
                            pengaduan Anda.

                        </p>

                    </div>

                    <div class="mt-4">

                        <a href="{{ route('home') }}" class="btn btn-primary">

                            <i class="bi bi-house-fill me-2"></i>

                            Kembali ke Beranda

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection@extends('layouts.app')

@section('title', 'Pengaduan Berhasil')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-card text-center">

                <div class="pengaduan-header">

                    <div class="header-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                    <h2>Pengaduan Berhasil Dikirim</h2>

                    <p>
                        Terima kasih, laporan Anda sudah berhasil
                        masuk ke sistem BNNK Tulungagung.
                    </p>

                </div>

                <div class="pengaduan-body">

                    <div class="mb-4">

                        <i class="bi bi-check-circle-fill text-success" style="font-size: 70px;">
                        </i>

                    </div>

                    <h4 class="fw-bold">
                        Pengaduan Anda telah berhasil dikirim
                    </h4>

                    <p class="text-muted">
                        Simpan kode pengaduan berikut untuk memantau
                        perkembangan laporan Anda.
                    </p>

                    <div class="card border-0 bg-light shadow-sm mt-4">

                        <div class="card-body">

                            <p class="mb-2 text-muted">
                                Kode Pengaduan
                            </p>

                            <h2 class="fw-bold text-primary">
                                {{ $kode }}
                            </h2>

                        </div>

                    </div>

                    <div class="alert alert-info mt-4 text-start">

                        <i class="bi bi-info-circle-fill me-2"></i>

                        <strong>Penting:</strong>

                        Simpan kode pengaduan ini karena kode tersebut
                        dapat digunakan untuk melihat status dan perkembangan
                        pengaduan Anda.

                    </div>

                    <div class="mt-4">

                        <a href="{{ route('home') }}" class="btn btn-primary">

                            <i class="bi bi-house-fill me-2"></i>

                            Kembali ke Beranda

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection