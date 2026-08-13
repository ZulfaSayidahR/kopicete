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