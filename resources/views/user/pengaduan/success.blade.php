@extends('layouts.app')

@section('title', 'Pengaduan Berhasil')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-card">

                {{-- =====================================================
                HEADER
                ====================================================== --}}

                <div class="pengaduan-header text-center">

                    <div class="mb-3">

                        <i class="bi bi-check-circle-fill" style="font-size: 70px; color: #198754;">
                        </i>

                    </div>

                    <h2>
                        Pengaduan Berhasil Dikirim
                    </h2>

                    <p>
                        Terima kasih, pengaduan Anda telah berhasil
                        dikirim dan masuk ke sistem BNNK Tulungagung.
                    </p>

                </div>


                {{-- =====================================================
                BODY
                ====================================================== --}}

                <div class="pengaduan-body">

                    <div class="text-center">


                        {{-- =================================================
                        PESAN UTAMA
                        ================================================== --}}

                        <p class="text-muted mb-2">

                            Pengaduan Anda telah berhasil direkam
                            oleh sistem.

                        </p>


                        {{-- =================================================
                        KODE PENGADUAN
                        ================================================== --}}

                        <div class="border rounded-4 p-4 bg-light mb-3">

                            <small class="text-muted d-block mb-2">

                                <i class="bi bi-upc-scan me-1"></i>

                                KODE PENGADUAN ANDA

                            </small>


                            <h2 class="fw-bold text-primary mb-3">

                                {{ $kode }}

                            </h2>


                            <div class="small text-muted">

                                <i class="bi bi-info-circle me-1"></i>

                                Kode ini digunakan untuk melacak
                                perkembangan pengaduan Anda.

                            </div>

                        </div>



                        {{-- =================================================
                        ALERT PENTING - SIMPAN KODE
                        ================================================== --}}

                        <div class="alert alert-warning text-start border-warning rounded-4 mb-4">

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



                        {{-- =================================================
                        BUTTON
                        ================================================== --}}

                        <div class="d-flex justify-content-center gap-2 flex-wrap">


                            {{-- BERANDA --}}

                            <a href="{{ route('home') }}" class="btn btn-primary">

                                <i class="bi bi-house-fill me-2"></i>

                                Kembali ke Beranda

                            </a>


                            {{-- TRACKING PENGADUAN --}}

                            @if(Route::has('pengaduan.tracking.detail'))

                                                    <a href="{{ route(
                                    'pengaduan.tracking.detail',
                                    ['kode' => $kode]
                                ) }}" class="btn btn-outline-primary">

                                                        <i class="bi bi-search me-2"></i>

                                                        Lacak Pengaduan

                                                    </a>

                            @endif


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection