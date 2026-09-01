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
                                                        data-bs-target="#detailLaporanModal">

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
                                                        data-bs-target="#detailLaporanModal">

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
                                                        data-bs-target="#detailLaporanModal">

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
                                        data-bs-target="#detailLaporanModal">

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


        {{-- =========================
        MODAL DETAIL TINDAK LANJUT
        ========================== --}}
        @php

            $warna = 'secondary';
            $status = $pengaduan->status;

            $foto = null;
            $catatan = null;
            $tanggal = null;

            switch ($status) {

                case 'Diverifikasi':
                    $warna = 'primary';
                    $foto = $pengaduan->foto_verifikasi;
                    $catatan = $pengaduan->catatan_verifikasi;
                    $tanggal = $pengaduan->tanggal_verifikasi;
                    break;

                case 'Diproses':
                    $warna = 'warning';
                    $foto = $pengaduan->foto_proses;
                    $catatan = $pengaduan->catatan_proses;
                    $tanggal = $pengaduan->tanggal_proses;
                    break;

                case 'Selesai':
                    $warna = 'success';
                    $foto = $pengaduan->foto_selesai;
                    $catatan = $pengaduan->catatan_selesai;
                    $tanggal = $pengaduan->tanggal_selesai;
                    break;
                case 'Ditolak':

                    $warna = 'danger';

                    $foto = $pengaduan->foto_ditolak;

                    $catatan = $pengaduan->catatan_ditolak;

                    $tanggal = $pengaduan->tanggal_ditolak;

                    break;

            }

        @endphp

        <div class="modal fade" id="detailLaporanModal" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-xl modal-dialog-centered">

                <div class="modal-content border-0 shadow-lg rounded-4">

                    {{-- HEADER --}}
                    <div class="modal-header bg-{{ $warna }}
                                                                                                    @if($warna != 'warning')
                                                                                                        text-white
                                                                                                    @endif">

                        <h5 class="modal-title fw-bold">

                            <i class="bi bi-info-circle-fill me-2"></i>

                            Detail Tindak Lanjut Pengaduan

                        </h5>

                        <button class="btn-close
                                                                                                @if($warna != 'warning')
                                                                                                    btn-close-white
                                                                                                @endif"
                            data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body p-4">

                        <div class="row">

                            {{-- FOTO --}}
                            <div class="col-lg-5 mb-4">

                                @if($foto)

                                    <img src="{{ asset('storage/' . $foto) }}" class="img-fluid rounded-4 shadow border w-100"
                                        style="height:330px;object-fit:cover;">

                                @else

                                    <div class="border rounded-4 bg-light d-flex flex-column justify-content-center align-items-center"
                                        style="height:330px;">

                                        <i class="bi bi-image display-3 text-secondary"></i>

                                        <h6 class="mt-3 text-muted">

                                            Belum ada foto tindak lanjut

                                        </h6>

                                    </div>

                                @endif

                            </div>

                            {{-- INFORMASI --}}
                            <div class="col-lg-7">

                                {{-- JUDUL --}}
                                <h3 class="fw-bold mb-1">
                                    {{ $pengaduan->judul_aduan }}
                                </h3>

                                {{-- KODE --}}
                                <span class="text-muted">
                                    {{ $pengaduan->kode_aduan }}
                                </span>

                                <hr>

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
                                            <span class="badge bg-{{ $warna }} px-3 py-2">
                                                {{ $status }}
                                            </span>
                                        </div>
                                    </div>


                                    {{-- TOPIK --}}
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


                                    {{-- TANGGAL UPDATE --}}
                                    <div class="detail-row">
                                        <div class="detail-label">
                                            Tanggal Update
                                        </div>

                                        <div class="detail-separator">
                                            :
                                        </div>

                                        <div class="detail-value">

                                            @if($tanggal)

                                                                                                                                                        {{ \Carbon\Carbon::parse($tanggal)
                                                ->translatedFormat('d F Y H:i') }}

                                            @else

                                                -

                                            @endif

                                        </div>
                                    </div>


                                    {{-- ADMIN --}}
                                    <div class="detail-row">
                                        <div class="detail-label">
                                            Diupdate Oleh
                                        </div>

                                        <div class="detail-separator">
                                            :
                                        </div>

                                        <div class="detail-value">
                                            {{ $pengaduan->admin->nama
    ?? 'Admin BNNK Tulungagung' }}
                                        </div>
                                    </div>

                                </div>


                                {{-- CATATAN ADMIN --}}
                                <div class="mt-4">

                                    <h6 class="fw-bold">
                                        Catatan Admin
                                    </h6>

                                    <div class="border rounded-4 bg-light p-3">

                                        @if($catatan)

                                            {!! nl2br(e($catatan)) !!}

                                        @else

                                            <span class="text-muted">
                                                Belum ada catatan dari admin.
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-secondary" data-bs-dismiss="modal">

                            Tutup

                        </button>

                    </div>

                </div>

            </div>

        </div>
@endsection