@extends('layouts.app')

@section('title', 'Detail Lacak Aduan')

@section('content')

        <section class="tracking-page">

            <div class="container">

                <!-- HEADER -->
                <div class="tracking-header">

                    <div class="logo-box">

                        <div>

                            <h4>BNNK Tulungagung</h4>

                            <small class="text-white">
                                Sistem Pelacakan Pengaduan Masyarakat
                            </small>

                        </div>

                    </div>

                </div>

                <!-- BODY -->
                <div class="tracking-body">

                    <div class="tracking-grid">

                        <!-- ==============================
                                                                                                                                                                                            KOLOM KIRI
                                                                                                                                                                                    =============================== -->

                        <div class="tracking-left">

                            <!-- INFORMASI -->
                            <div class="tracking-card mb-4">

                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <h5 class="mb-0">
                                        Informasi Pengaduan
                                    </h5>

                                    <span class="badge
                @if($pengaduan->status == 'Diajukan')
                    bg-secondary
                @elseif($pengaduan->status == 'Diverifikasi')
                    bg-primary
                @elseif($pengaduan->status == 'Diproses')
                    bg-warning text-dark
                @elseif($pengaduan->status == 'Selesai')
                    bg-success
                @elseif($pengaduan->status == 'Ditolak')
                    bg-danger
                @else
                    bg-secondary
                @endif">

                                        {{ $pengaduan->status }}

                                    </span>

                                </div>

                                <div class="info-grid">

                                    <div>

                                        <strong>
                                            <i class="bi bi-upc-scan"></i>
                                            Kode Aduan
                                        </strong>

                                        <p>
                                            {{ $pengaduan->kode_aduan ?? '-' }}
                                        </p>

                                    </div>
                                    <div>

                                        <strong>
                                            <i class="bi bi-geo-alt-fill"></i>
                                            Kecamatan
                                        </strong>

                                        <p>
                                            {{ $pengaduan->kecamatan->nama_kecamatan ?? '-' }}
                                        </p>

                                    </div>
                                    <div>

                                        <strong>
                                            <i class="bi bi-tags-fill"></i>
                                            Topik Aduan
                                        </strong>

                                        <p>{{ $pengaduan->topik_aduan }}</p>

                                    </div>

                                    <div>

                                        <strong>
                                            <i class="bi bi-whatsapp"></i>
                                            No WhatsApp
                                        </strong>

                                        <p>
                                            {{ $pengaduan->no_whatsapp ?? '-' }}
                                        </p>

                                    </div>

                                </div>

                                <div class="kronologi">

                                    <h6>

                                        <i class="bi bi-file-text-fill"></i>

                                        Kronologi

                                    </h6>

                                    <div class="kronologi-box">

                                        {{ $pengaduan->detail_aduan }}

                                    </div>

                                </div>

                            </div>

                            <!-- LAMPIRAN -->

                            <div class="tracking-card">

                                <h5>

                                    <i class="bi bi-paperclip"></i>

                                    Lampiran Bukti

                                </h5>

                                @if($pengaduan->lampiran)

                                    <div class="text-center mt-3">

                                        <img src="{{ asset('storage/' . $pengaduan->lampiran) }}" class="img-fluid rounded shadow"
                                            style="max-height:350px;">

                                    </div>

                                @else

                                    <div class="alert alert-light text-center mt-3">

                                        <i class="bi bi-image fs-2 d-block mb-2"></i>

                                        Tidak ada lampiran yang diunggah.

                                    </div>

                                @endif

                            </div>

                        </div>

                        <!-- ==============================
                                                                                                                                                                                            KOLOM KANAN
                                                                                                                                                                                    =============================== -->

                        <aside class="tracking-card status-card">

                            <h5>
                                <i class="bi bi-clock-history"></i>
                                Riwayat Status
                            </h5>

                         <div class="tracking-timeline">

        @php

            $status = trim($pengaduan->status ?? 'Diajukan');

            /*
            |--------------------------------------------------------------------------
            | STATUS NORMAL
            |--------------------------------------------------------------------------
            */

            $verifikasiSelesai = in_array($status, [
                'Diverifikasi',
                'Diproses',
                'Selesai',
                'Ditolak'
            ]);

            $prosesSelesai = in_array($status, [
                'Diproses',
                'Selesai'
            ]);

            $selesai = $status === 'Selesai';

            $ditolak = $status === 'Ditolak';

        @endphp


        {{-- =========================================================
        1. DIAJUKAN
        ========================================================== --}}

        <div class="tracking-item selesai">

            <div class="tracking-icon">

                <i class="bi bi-check-lg"></i>

            </div>

            <div class="tracking-content">

                <h6>
                    Pengaduan Diajukan
                </h6>

                <small class="d-block">

                    <i class="bi bi-calendar-event me-1"></i>

                    {{ $pengaduan->created_at
    ? $pengaduan->created_at->translatedFormat('d F Y H:i')
    : '-' }}

                    WIB

                </small>

            </div>

        </div>



        {{-- =========================================================
        2. DIVERIFIKASI
        ========================================================== --}}

        <div class="tracking-item {{ $verifikasiSelesai ? 'selesai' : '' }}">

            <div class="tracking-icon">

                @if($verifikasiSelesai)

                    <i class="bi bi-check-lg"></i>

                @else

                    <i class="bi bi-circle"></i>

                @endif

            </div>

            <div class="tracking-content">

                <h6>
                    Diverifikasi Admin
                </h6>


                @if($pengaduan->tanggal_verifikasi)

                                                <small class="d-block mb-2">

                                                    <i class="bi bi-calendar-event me-1"></i>

                                                    {{ \Carbon\Carbon::parse(
                        $pengaduan->tanggal_verifikasi
                    )->translatedFormat('d F Y H:i') }}

                                                    WIB

                                                </small>


                                                {{-- Jangan tampilkan tombol jika ditolak
                                                     karena detail penolakan akan ditampilkan
                                                     pada tahap Ditolak --}}
@if(!$ditolak)

    <button
        type="button"
        class="btn btn-sm btn-outline-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalDetailVerifikasi">

        <i class="bi bi-eye-fill me-1"></i>

        Lihat Detail

    </button>

@endif
                                           


                @else

                    <small class="text-muted">

                        Menunggu verifikasi admin

                    </small>

                @endif

            </div>

        </div>



        {{-- =========================================================
        3. DIPROSES
        ========================================================== --}}

        @if(!$ditolak)

            <div class="tracking-item {{ $prosesSelesai ? 'selesai' : '' }}">

                <div class="tracking-icon">

                    @if($prosesSelesai)

                        <i class="bi bi-check-lg"></i>

                    @else

                        <i class="bi bi-hourglass-split"></i>

                    @endif

                </div>

                <div class="tracking-content">

                    <h6>
                        Diproses BNNK
                    </h6>


                    @if($pengaduan->tanggal_proses)

                                                    <small class="d-block mb-2">

                                                        <i class="bi bi-calendar-event me-1"></i>

                                                        {{ \Carbon\Carbon::parse(
                            $pengaduan->tanggal_proses
                        )->translatedFormat('d F Y H:i') }}

                                                        WIB

                                                    </small>


                                                   <button
    type="button"
    class="btn btn-sm btn-outline-warning"
    data-bs-toggle="modal"
    data-bs-target="#modalDetailProses">

    <i class="bi bi-eye-fill me-1"></i>

    Lihat Detail

</button>

                    @else

                        <small class="text-muted">

                            Menunggu proses BNNK

                        </small>

                    @endif

                </div>

            </div>



            {{-- =====================================================
            4. SELESAI
            ====================================================== --}}

            <div class="tracking-item {{ $selesai ? 'selesai' : '' }}">

                <div class="tracking-icon">

                    @if($selesai)

                        <i class="bi bi-check-circle-fill"></i>

                    @else

                        <i class="bi bi-flag"></i>

                    @endif

                </div>

                <div class="tracking-content">

                    <h6>
                        Selesai
                    </h6>


                    @if($pengaduan->tanggal_selesai)

                                                    <small class="d-block mb-2">

                                                        <i class="bi bi-calendar-event me-1"></i>

                                                        {{ \Carbon\Carbon::parse(
                            $pengaduan->tanggal_selesai
                        )->translatedFormat('d F Y H:i') }}

                                                        WIB

                                                    </small>


                                                 <button
    type="button"
    class="btn btn-sm btn-outline-success"
    data-bs-toggle="modal"
    data-bs-target="#modalDetailSelesai">

    <i class="bi bi-eye-fill me-1"></i>

    Lihat Detail

</button>

                    @else

                        <small class="text-muted">

                            Belum selesai

                        </small>

                    @endif

                </div>

            </div>

        @endif



        {{-- =========================================================
        5. DITOLAK
        ========================================================== --}}

        @if($ditolak)

            <div class="tracking-item ditolak">

                <div class="tracking-icon">

                    <i class="bi bi-x-lg"></i>

                </div>

                <div class="tracking-content">

                    <h6 class="text-danger">

                        Pengaduan Ditolak

                    </h6>


                    @if($pengaduan->tanggal_ditolak)

                                                    <small class="d-block mb-2">

                                                        <i class="bi bi-calendar-event me-1"></i>

                                                        {{ \Carbon\Carbon::parse(
                            $pengaduan->tanggal_ditolak
                        )->translatedFormat('d F Y H:i') }}

                                                        WIB

                                                    </small>

                    @else

                        <small class="d-block mb-2">

                            <i class="bi bi-x-circle me-1"></i>

                            Pengaduan tidak dapat diproses.

                        </small>

                    @endif


                    {{-- ALASAN PENOLAKAN --}}

                    @if($pengaduan->catatan_ditolak)

                        <div
                            class="mt-2 p-3 rounded"
                            style="
                                background:#fff1f2;
                                border:1px solid #f5c2c7;
                            ">

                            <strong class="text-danger">

                                <i class="bi bi-exclamation-triangle-fill me-1"></i>

                                Alasan Penolakan

                            </strong>

                            <div class="mt-2">

                                {!! nl2br(e($pengaduan->catatan_ditolak)) !!}

                            </div>

                        </div>

                    @endif


                    {{-- DETAIL PENOLAKAN --}}

                    @if(
                            $pengaduan->foto_ditolak ||
                            $pengaduan->catatan_ditolak
                        )

                                <div class="mt-3">

                                    <button
    type="button"
    class="btn btn-sm btn-outline-danger"
    data-bs-toggle="modal"
    data-bs-target="#modalDetailDitolak">

    <i class="bi bi-eye-fill me-1"></i>

    Lihat Detail Penolakan

</button>

                                </div>

                    @endif

                </div>

            </div>

        @endif

    </div>

                            <div class="mt-4">

                                <a href="{{ route('home') }}" class="btn btn-light w-100">

                                    <i class="bi bi-house-door-fill"></i>

                                    Kembali ke Beranda

                                </a>

                            </div>

                        </aside>

                    </div>

                </div>

            </div>

        </section>

{{-- =========================================================
MODAL DETAIL VERIFIKASI
========================================================= --}}

<div class="modal fade"
    id="modalDetailVerifikasi"
    tabindex="-1"
    aria-labelledby="modalDetailVerifikasiLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">


            {{-- =====================================================
            HEADER
            ====================================================== --}}

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title fw-bold"
                    id="modalDetailVerifikasiLabel">

                    <i class="bi bi-shield-check-fill me-2"></i>

                    Detail Verifikasi Pengaduan

                </h5>


                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>



            {{-- =====================================================
            BODY
            ====================================================== --}}

            <div class="modal-body p-4">

                <div class="row g-4 align-items-start">


                    {{-- =================================================
                    KOLOM KIRI - FOTO VERIFIKASI
                    ================================================== --}}

                    <div class="col-lg-5">

                        @if($pengaduan->foto_verifikasi)

                            {{-- FOTO --}}
                            <div class="text-center">

                                <img
                                    src="{{ asset('storage/' . $pengaduan->foto_verifikasi) }}"
                                    class="img-fluid rounded-4 shadow border w-100"
                                    style="height:330px; object-fit:cover;"
                                    alt="Foto Verifikasi">

                            </div>


                            {{-- TOMBOL BUKA LAMPIRAN --}}
                            <div class="text-center mt-3">

                                <a
                                    href="{{ asset('storage/' . $pengaduan->foto_verifikasi) }}"
                                    target="_blank"
                                    class="btn btn-primary">

                                    <i class="bi bi-box-arrow-up-right me-1"></i>

                                    Buka Lampiran

                                </a>

                            </div>

                        @else

                            {{-- JIKA TIDAK ADA FOTO --}}
                            <div
                                class="border rounded-4 bg-light d-flex flex-column justify-content-center align-items-center"
                                style="height:330px;">

                                <i class="bi bi-image display-3 text-secondary"></i>

                                <h6 class="mt-3 text-muted">

                                    Tidak ada foto verifikasi

                                </h6>

                            </div>

                        @endif

                    </div>



                    {{-- =================================================
                    KOLOM KANAN - INFORMASI VERIFIKASI
                    ================================================== --}}

                    <div class="col-lg-7">


                        {{-- JUDUL --}}
                        <h3 class="fw-bold mb-1">

                            {{ $pengaduan->judul_aduan ?? '-' }}

                        </h3>


                        {{-- KODE ADUAN --}}
                        <span class="text-muted">

                            {{ $pengaduan->kode_aduan ?? '-' }}

                        </span>


                        <hr>



                        {{-- =================================================
                        INFORMASI VERIFIKASI
                        ================================================== --}}

                        <div class="detail-info">


                            {{-- STATUS --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Status
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    <span class="badge bg-primary px-3 py-2">

                                        <i class="bi bi-shield-check me-1"></i>

                                        Diverifikasi

                                    </span>

                                </div>

                            </div>



                            {{-- TANGGAL VERIFIKASI --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Tanggal Verifikasi
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    @if($pengaduan->tanggal_verifikasi)

                                        {{ \Carbon\Carbon::parse(
                                            $pengaduan->tanggal_verifikasi
                                        )->translatedFormat('d F Y H:i') }}

                                        WIB

                                    @else

                                        -

                                    @endif

                                </div>

                            </div>



                            {{-- TOPIK ADUAN --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Topik Aduan
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->topik_aduan ?? '-' }}

                                </div>

                            </div>



                            {{-- KECAMATAN --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Kecamatan
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->kecamatan->nama_kecamatan ?? '-' }}

                                </div>

                            </div>



                            {{-- DIUPDATE OLEH --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Diupdate Oleh
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->admin->nama ?? 'Admin BNNK Tulungagung' }}

                                </div>

                            </div>


                        </div>



                        {{-- =================================================
                        CATATAN VERIFIKASI
                        ================================================== --}}

                        <div class="mt-4">

                            <h6 class="fw-bold">

                                <i class="bi bi-chat-left-text me-1"></i>

                                Catatan Verifikasi

                            </h6>


                            <div class="border rounded-4 bg-light p-3">

                                @if($pengaduan->catatan_verifikasi)

                                    {!! nl2br(e($pengaduan->catatan_verifikasi)) !!}

                                @else

                                    <span class="text-muted">

                                        Tidak ada catatan verifikasi.

                                    </span>

                                @endif

                            </div>

                        </div>


                    </div>

                </div>

            </div>



            {{-- =====================================================
            FOOTER
            ====================================================== --}}

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    <i class="bi bi-x-circle me-1"></i>

                    Tutup

                </button>

            </div>


        </div>

    </div>

</div>

{{-- =========================================================
MODAL DETAIL PROSES
========================================================= --}}

<div class="modal fade"
    id="modalDetailProses"
    tabindex="-1"
    aria-labelledby="modalDetailProsesLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">


            {{-- =====================================================
            HEADER
            ====================================================== --}}

            <div class="modal-header bg-warning">

                <h5 class="modal-title fw-bold"
                    id="modalDetailProsesLabel">

                    <i class="bi bi-hourglass-split me-2"></i>

                    Detail Proses BNNK

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>



            {{-- =====================================================
            BODY
            ====================================================== --}}

            <div class="modal-body p-4">

                <div class="row g-4 align-items-start">


                    {{-- =================================================
                    KOLOM KIRI - FOTO PROSES
                    ================================================== --}}

                    <div class="col-lg-5">

                        @if($pengaduan->foto_proses)

                            {{-- FOTO --}}
                            <div class="text-center">

                                <img
                                    src="{{ asset('storage/' . $pengaduan->foto_proses) }}"
                                    class="img-fluid rounded-4 shadow border w-100"
                                    style="height:330px; object-fit:cover;"
                                    alt="Foto Proses">

                            </div>


                            {{-- TOMBOL BUKA LAMPIRAN --}}
                            <div class="text-center mt-3">

                                <a
                                    href="{{ asset('storage/' . $pengaduan->foto_proses) }}"
                                    target="_blank"
                                    class="btn btn-warning">

                                    <i class="bi bi-box-arrow-up-right me-1"></i>

                                    Buka Lampiran

                                </a>

                            </div>

                        @else

                            {{-- JIKA TIDAK ADA FOTO --}}
                            <div
                                class="border rounded-4 bg-light d-flex flex-column justify-content-center align-items-center"
                                style="height:330px;">

                                <i class="bi bi-image display-3 text-secondary"></i>

                                <h6 class="mt-3 text-muted">

                                    Tidak ada foto proses

                                </h6>

                            </div>

                        @endif

                    </div>



                    {{-- =================================================
                    KOLOM KANAN - INFORMASI PROSES
                    ================================================== --}}

                    <div class="col-lg-7">


                        {{-- JUDUL --}}
                        <h3 class="fw-bold mb-1">

                            {{ $pengaduan->judul_aduan ?? '-' }}

                        </h3>


                        {{-- KODE ADUAN --}}
                        <span class="text-muted">

                            {{ $pengaduan->kode_aduan ?? '-' }}

                        </span>


                        <hr>



                        {{-- =================================================
                        INFORMASI PROSES
                        ================================================== --}}

                        <div class="detail-info">


                            {{-- STATUS --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Status
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    <span class="badge bg-warning text-dark px-3 py-2">

                                        <i class="bi bi-hourglass-split me-1"></i>

                                        Diproses

                                    </span>

                                </div>

                            </div>



                            {{-- TANGGAL PROSES --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Tanggal Proses
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    @if($pengaduan->tanggal_proses)

                                        {{ \Carbon\Carbon::parse(
                                            $pengaduan->tanggal_proses
                                        )->translatedFormat('d F Y H:i') }}

                                        WIB

                                    @else

                                        -

                                    @endif

                                </div>

                            </div>



                            {{-- TOPIK ADUAN --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Topik Aduan
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->topik_aduan ?? '-' }}

                                </div>

                            </div>



                            {{-- KECAMATAN --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Kecamatan
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->kecamatan->nama_kecamatan ?? '-' }}

                                </div>

                            </div>



                            {{-- DIUPDATE OLEH --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Diupdate Oleh
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->admin->nama ?? 'Admin BNNK Tulungagung' }}

                                </div>

                            </div>


                        </div>



                        {{-- =================================================
                        CATATAN PROSES
                        ================================================== --}}

                        <div class="mt-4">

                            <h6 class="fw-bold">

                                <i class="bi bi-chat-left-text me-1"></i>

                                Catatan Proses

                            </h6>


                            <div class="border rounded-4 bg-light p-3">

                                @if($pengaduan->catatan_proses)

                                    {!! nl2br(e($pengaduan->catatan_proses)) !!}

                                @else

                                    <span class="text-muted">

                                        Tidak ada catatan proses.

                                    </span>

                                @endif

                            </div>

                        </div>


                    </div>

                </div>

            </div>



            {{-- =====================================================
            FOOTER
            ====================================================== --}}

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    <i class="bi bi-x-circle me-1"></i>

                    Tutup

                </button>

            </div>


        </div>

    </div>

</div>



{{-- =========================================================
MODAL DETAIL SELESAI
========================================================= --}}

<div class="modal fade"
    id="modalDetailSelesai"
    tabindex="-1"
    aria-labelledby="modalDetailSelesaiLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">


            {{-- =====================================================
            HEADER
            ====================================================== --}}

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title fw-bold"
                    id="modalDetailSelesaiLabel">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    Detail Penyelesaian Pengaduan

                </h5>


                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>



            {{-- =====================================================
            BODY
            ====================================================== --}}

            <div class="modal-body p-4">

                <div class="row g-4 align-items-start">


                    {{-- =================================================
                    KOLOM KIRI - FOTO SELESAI
                    ================================================== --}}

                    <div class="col-lg-5">

                        @if($pengaduan->foto_selesai)

                            {{-- FOTO --}}
                            <div class="text-center">

                                <img
                                    src="{{ asset('storage/' . $pengaduan->foto_selesai) }}"
                                    class="img-fluid rounded-4 shadow border w-100"
                                    style="height:330px; object-fit:cover;"
                                    alt="Foto Penyelesaian">

                            </div>


                            {{-- TOMBOL BUKA LAMPIRAN --}}
                            <div class="text-center mt-3">

                                <a
                                    href="{{ asset('storage/' . $pengaduan->foto_selesai) }}"
                                    target="_blank"
                                    class="btn btn-success">

                                    <i class="bi bi-box-arrow-up-right me-1"></i>

                                    Buka Lampiran

                                </a>

                            </div>

                        @else

                            {{-- JIKA TIDAK ADA FOTO --}}
                            <div
                                class="border rounded-4 bg-light d-flex flex-column justify-content-center align-items-center"
                                style="height:330px;">

                                <i class="bi bi-image display-3 text-secondary"></i>

                                <h6 class="mt-3 text-muted">

                                    Tidak ada foto penyelesaian

                                </h6>

                            </div>

                        @endif

                    </div>



                    {{-- =================================================
                    KOLOM KANAN - INFORMASI SELESAI
                    ================================================== --}}

                    <div class="col-lg-7">


                        {{-- JUDUL --}}
                        <h3 class="fw-bold mb-1">

                            {{ $pengaduan->judul_aduan ?? '-' }}

                        </h3>


                        {{-- KODE ADUAN --}}
                        <span class="text-muted">

                            {{ $pengaduan->kode_aduan ?? '-' }}

                        </span>


                        <hr>



                        {{-- =================================================
                        INFORMASI PENYELESAIAN
                        ================================================== --}}

                        <div class="detail-info">


                            {{-- STATUS --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Status
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    <span class="badge bg-success px-3 py-2">

                                        <i class="bi bi-check-circle me-1"></i>

                                        Selesai

                                    </span>

                                </div>

                            </div>



                            {{-- TANGGAL SELESAI --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Tanggal Selesai
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    @if($pengaduan->tanggal_selesai)

                                        {{ \Carbon\Carbon::parse(
                                            $pengaduan->tanggal_selesai
                                        )->translatedFormat('d F Y H:i') }}

                                        WIB

                                    @else

                                        -

                                    @endif

                                </div>

                            </div>



                            {{-- TOPIK ADUAN --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Topik Aduan
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->topik_aduan ?? '-' }}

                                </div>

                            </div>



                            {{-- KECAMATAN --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Kecamatan
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->kecamatan->nama_kecamatan ?? '-' }}

                                </div>

                            </div>



                            {{-- DIUPDATE OLEH --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Diupdate Oleh
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->admin->nama ?? 'Admin BNNK Tulungagung' }}

                                </div>

                            </div>


                        </div>



                        {{-- =================================================
                        CATATAN PENYELESAIAN
                        ================================================== --}}

                        <div class="mt-4">

                            <h6 class="fw-bold">

                                <i class="bi bi-chat-left-text me-1"></i>

                                Catatan Penyelesaian

                            </h6>


                            <div class="border rounded-4 bg-light p-3">

                                @if($pengaduan->catatan_selesai)

                                    {!! nl2br(e($pengaduan->catatan_selesai)) !!}

                                @else

                                    <span class="text-muted">

                                        Tidak ada catatan penyelesaian.

                                    </span>

                                @endif

                            </div>

                        </div>


                    </div>

                </div>

            </div>



            {{-- =====================================================
            FOOTER
            ====================================================== --}}

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    <i class="bi bi-x-circle me-1"></i>

                    Tutup

                </button>

            </div>


        </div>

    </div>

</div>



{{-- =========================================================
MODAL DETAIL PENOLAKAN
========================================================= --}}

<div class="modal fade"
    id="modalDetailDitolak"
    tabindex="-1"
    aria-labelledby="modalDetailDitolakLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">


            {{-- =====================================================
            HEADER
            ====================================================== --}}

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title fw-bold"
                    id="modalDetailDitolakLabel">

                    <i class="bi bi-x-circle-fill me-2"></i>

                    Detail Penolakan Pengaduan

                </h5>


                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>



            {{-- =====================================================
            BODY
            ====================================================== --}}

            <div class="modal-body p-4">

                <div class="row g-4 align-items-start">


                    {{-- =================================================
                    KOLOM KIRI - FOTO PENOLAKAN
                    ================================================== --}}

                    <div class="col-lg-5">

                        @if($pengaduan->foto_ditolak)

                            {{-- FOTO --}}
                            <div class="text-center">

                                <img
                                    src="{{ asset('storage/' . $pengaduan->foto_ditolak) }}"
                                    class="img-fluid rounded-4 shadow border w-100"
                                    style="height:330px; object-fit:cover;"
                                    alt="Foto Penolakan">

                            </div>


                            {{-- TOMBOL BUKA LAMPIRAN --}}
                            <div class="text-center mt-3">

                                <a
                                    href="{{ asset('storage/' . $pengaduan->foto_ditolak) }}"
                                    target="_blank"
                                    class="btn btn-danger">

                                    <i class="bi bi-box-arrow-up-right me-1"></i>

                                    Buka Lampiran

                                </a>

                            </div>

                        @else

                            {{-- JIKA TIDAK ADA FOTO --}}
                            <div
                                class="border rounded-4 bg-light d-flex flex-column justify-content-center align-items-center"
                                style="height:330px;">

                                <i class="bi bi-x-circle display-3 text-danger"></i>

                                <h6 class="mt-3 text-muted">

                                    Tidak ada lampiran penolakan

                                </h6>

                            </div>

                        @endif

                    </div>



                    {{-- =================================================
                    KOLOM KANAN - INFORMASI PENOLAKAN
                    ================================================== --}}

                    <div class="col-lg-7">


                        {{-- JUDUL --}}
                        <h3 class="fw-bold mb-1">

                            {{ $pengaduan->judul_aduan ?? '-' }}

                        </h3>


                        {{-- KODE ADUAN --}}
                        <span class="text-muted">

                            {{ $pengaduan->kode_aduan ?? '-' }}

                        </span>


                        <hr>



                        {{-- =================================================
                        INFORMASI PENOLAKAN
                        ================================================== --}}

                        <div class="detail-info">


                            {{-- STATUS --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Status
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    <span class="badge bg-danger px-3 py-2">

                                        <i class="bi bi-x-circle me-1"></i>

                                        Ditolak

                                    </span>

                                </div>

                            </div>



                            {{-- TANGGAL DITOLAK --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Tanggal Ditolak
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    @if($pengaduan->tanggal_ditolak)

                                        {{ \Carbon\Carbon::parse(
                                            $pengaduan->tanggal_ditolak
                                        )->translatedFormat('d F Y H:i') }}

                                        WIB

                                    @else

                                        -

                                    @endif

                                </div>

                            </div>



                            {{-- TOPIK ADUAN --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Topik Aduan
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->topik_aduan ?? '-' }}

                                </div>

                            </div>



                            {{-- KECAMATAN --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Kecamatan
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->kecamatan->nama_kecamatan ?? '-' }}

                                </div>

                            </div>



                            {{-- DIUPDATE OLEH --}}
                            <div class="detail-row">

                                <div class="detail-label">
                                    Diupdate Oleh
                                </div>

                                <div class="detail-separator">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->admin->nama ?? 'Admin BNNK Tulungagung' }}

                                </div>

                            </div>


                        </div>



                        {{-- =================================================
                        ALASAN PENOLAKAN
                        ================================================== --}}

                        <div class="mt-4">

                            <h6 class="fw-bold text-danger">

                                <i class="bi bi-exclamation-triangle-fill me-1"></i>

                                Alasan Penolakan

                            </h6>


                            <div
                                class="border rounded-4 p-3"
                                style="
                                    background:#fff1f2;
                                    border-color:#f5c2c7 !important;
                                ">

                                @if($pengaduan->catatan_ditolak)

                                    {!! nl2br(e($pengaduan->catatan_ditolak)) !!}

                                @else

                                    <span class="text-muted">

                                        Tidak ada alasan penolakan.

                                    </span>

                                @endif

                            </div>

                        </div>


                    </div>

                </div>

            </div>



            {{-- =====================================================
            FOOTER
            ====================================================== --}}

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    <i class="bi bi-x-circle me-1"></i>

                    Tutup

                </button>

            </div>


        </div>

    </div>

</div>
@endsection