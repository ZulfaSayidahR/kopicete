@extends('layouts.app')

@section('title', 'Permohonan Berhasil')

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
                        Permohonan Berhasil Dikirim
                    </h2>

                    <p>
                        Terima kasih, permohonan Anda telah berhasil
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

                            Permohonan Anda telah berhasil direkam
                            oleh sistem.

                        </p>


                        {{-- =================================================
                        KODE PERMOHONAN
                        ================================================== --}}

                        <div class="border rounded-4 p-4 bg-light mb-3">

                            <small class="text-muted d-block mb-2">

                                <i class="bi bi-upc-scan me-1"></i>

                                KODE PERMOHONAN ANDA

                            </small>


                            <h2 class="fw-bold text-primary mb-3">

                                {{ $permohonan->kode_permohonan }}

                            </h2>


                            <div class="small text-muted">

                                <i class="bi bi-info-circle me-1"></i>

                                Kode ini digunakan untuk melacak
                                perkembangan permohonan Anda.

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

                                        Penting! Simpan Kode Permohonan Anda

                                    </strong>


                                    <p class="mb-2">

                                        Mohon <strong>catat, screenshot, atau simpan</strong>
                                        kode permohonan di tempat yang aman.
                                        Kode ini diperlukan untuk melihat
                                        perkembangan dan status permohonan Anda
                                        melalui halaman pencarian pelayanan.

                                    </p>


                                    <p class="mb-0">

                                        <strong>
                                            Jangan membagikan kode permohonan
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
                                        kode permohonan, silakan
                                        <strong>hubungi Admin BNNK Tulungagung</strong>
                                        untuk mendapatkan bantuan.

                                    </p>


                                    <p class="mb-0">

                                        <i class="bi bi-telephone-fill me-1"></i>

                                        Pastikan Anda memberikan informasi
                                        yang diperlukan kepada admin untuk
                                        membantu proses pencarian data
                                        permohonan Anda.

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

                                Gunakan kode permohonan tersebut pada
                                halaman <strong>Pencarian Pelayanan</strong>
                                untuk melihat status permohonan Anda.

                            </p>

                        </div>



                        {{-- =================================================
                        DETAIL SINGKAT
                        ================================================== --}}

                        <div class="text-start border rounded-4 p-4 mb-4">

                            <h5 class="fw-bold mb-4">

                                <i class="bi bi-file-earmark-text-fill me-2"></i>

                                Detail Permohonan

                            </h5>


                            {{-- JENIS PERMOHONAN --}}

                            <div class="row mb-3">

                                <div class="col-md-5">

                                    <strong>
                                        Jenis Permohonan
                                    </strong>

                                </div>

                                <div class="col-md-7">

                                    {{ $permohonan->jenis_permohonan ?? '-' }}

                                </div>

                            </div>


                            {{-- NAMA PENYELENGGARA --}}

                            <div class="row mb-3">

                                <div class="col-md-5">

                                    <strong>
                                        Nama Penyelenggara
                                    </strong>

                                </div>

                                <div class="col-md-7">

                                    {{ $permohonan->nama_penyelenggara ?? '-' }}

                                </div>

                            </div>


                            {{-- TANGGAL KEGIATAN --}}

                            @if($permohonan->tanggal_kegiatan)

                                <div class="row mb-3">

                                    <div class="col-md-5">

                                        <strong>
                                            Tanggal Kegiatan
                                        </strong>

                                    </div>

                                    <div class="col-md-7">

                                        {{ \Carbon\Carbon::parse($permohonan->tanggal_kegiatan)->translatedFormat('d F Y') }}

                                    </div>

                                </div>

                            @endif


                            {{-- TEMPAT --}}

                            @if($permohonan->tempat)

                                <div class="row mb-3">

                                    <div class="col-md-5">

                                        <strong>
                                            Tempat
                                        </strong>

                                    </div>

                                    <div class="col-md-7">

                                        {{ $permohonan->tempat }}

                                    </div>

                                </div>

                            @endif


                            {{-- STATUS --}}

                            <div class="row">

                                <div class="col-md-5">

                                    <strong>
                                        Status
                                    </strong>

                                </div>

                                <div class="col-md-7">

                                    <span class="badge bg-secondary px-3 py-2">

                                        {{ $permohonan->status }}

                                    </span>

                                </div>

                            </div>

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



                            {{-- TRACKING --}}

                            @if(Route::has('permohonan.tracking.detail'))

                                                    <a href="{{ route(
                                    'permohonan.tracking.detail',
                                    $permohonan->kode_permohonan
                                ) }}" class="btn btn-outline-primary">

                                                        <i class="bi bi-search me-2"></i>

                                                        Lacak Permohonan

                                                    </a>

                            @endif


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection