@extends('layouts.admin')

@section('title', 'Detail Permohonan')

@section('content')

    <section class="sa-dashboard">

        @include('layouts.sidebar')

        <main class="sa-main">

            {{-- Header --}}
            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button class="sa-toggle-sidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="sa-page-heading">

                        <h1>Detail Permohonan</h1>

                        <p>Informasi lengkap permohonan masyarakat.</p>

                    </div>

                </div>

            </header>


            <div class="row mt-4">

                {{-- ================= KIRI ================= --}}
                <div class="col-lg-7">

                    {{-- =================================================
                    INFORMASI PERMOHONAN
                    ================================================= --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">

                            <h3>
                                Informasi Permohonan
                            </h3>

                        </div>


                        @php

                            /*
                            |--------------------------------------------------------------------------
                            | NORMALISASI JENIS PERMOHONAN
                            |--------------------------------------------------------------------------
                            | Database bisa berisi:
                            | - Rehabilitasi
                            | - Permohonan Rehabilitasi
                            | - Sosialisasi
                            | - Permohonan Sosialisasi
                            |--------------------------------------------------------------------------
                            */

                            $jenisPermohonan = trim(
                                $permohonan->jenis_permohonan ?? ''
                            );

                            $jenisLower = strtolower(
                                $jenisPermohonan
                            );

                            $isRehabilitasi = str_contains(
                                $jenisLower,
                                'rehabilitasi'
                            );

                            $isSosialisasi = str_contains(
                                $jenisLower,
                                'sosialisasi'
                            );


                            /*
                            |--------------------------------------------------------------------------
                            | STATUS
                            |--------------------------------------------------------------------------
                            */

                            $status = trim(
                                $permohonan->status ?? '-'
                            );


                            /*


                            /*
                            |--------------------------------------------------------------------------
                            | WARNA STATUS
                            |--------------------------------------------------------------------------
                            */

                            $warnaStatus = match ($status) {

                                'Diajukan',
                                'Menunggu',
                                'Menunggu Verifikasi'
                                => 'secondary',

                                'Diverifikasi'
                                => 'primary',

                                'Diproses',
                                'Diproses Lapangan'
                                => 'warning',

                                'Selesai'
                                => 'success',

                                'Ditolak'
                                => 'danger',

                                default
                                => 'secondary',

                            };

                        @endphp

                        <div class="p-4">

                            {{-- =================================================
                            INFORMASI UMUM
                            ================================================== --}}
                            <div class="row">


                                {{-- KODE PERMOHONAN --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Kode Permohonan
                                    </strong>

                                    <p>
                                        {{ $permohonan->kode_permohonan ?? '-' }}
                                    </p>

                                </div>


                                {{-- JENIS PERMOHONAN --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Jenis Permohonan
                                    </strong>

                                    <p>

                                        @if($isRehabilitasi)

                                            Permohonan Rehabilitasi

                                        @elseif($isSosialisasi)

                                            Permohonan Sosialisasi

                                        @else

                                            {{ $jenisPermohonan ?: '-' }}

                                        @endif

                                    </p>

                                </div>


                            </div>


                            {{-- =================================================
                            REHABILITASI
                            ================================================== --}}
                            @if($isRehabilitasi)

                                <div class="mt-2">

                                    <div class="d-flex align-items-center mb-3">

                                        <i class="bi bi-person-check-fill me-2 text-primary"></i>

                                        <strong>
                                            Data Pemohon Rehabilitasi
                                        </strong>

                                    </div>


                                    <div class="row">


                                        {{-- NAMA PEMOHON --}}
                                        <div class="col-md-6 mb-3">

                                            <strong>
                                                Nama Pemohon
                                            </strong>

                                            <p>
                                                {{ $permohonan->nama_pemohon ?? '-' }}
                                            </p>

                                        </div>


                                        {{-- NIK --}}
                                        <div class="col-md-6 mb-3">

                                            <strong>
                                                NIK
                                            </strong>

                                            <p>
                                                {{ $permohonan->nik ?? '-' }}
                                            </p>

                                        </div>


                                        {{-- NO HP --}}
                                        <div class="col-md-6 mb-3">

                                            <strong>
                                                No. HP / WhatsApp
                                            </strong>

                                            <p>
                                                {{ $permohonan->no_hp ?? '-' }}
                                            </p>

                                        </div>


                                        <!-- {{-- JENIS REHABILITASI --}}
                                                                                <div class="col-md-6 mb-3">

                                                                                    <strong>
                                                                                        Jenis Rehabilitasi
                                                                                    </strong>

                                                                                    <p>
                                                                                        {{ $permohonan->jenis_rehabilitasi ?? '-' }}
                                                                                    </p>

                                                                                </div> -->


                                        {{-- ALAMAT --}}
                                        <div class="col-md-6 mb-3">

                                            <strong>
                                                Alamat Pemohon
                                            </strong>

                                            <p>
                                                {{ $permohonan->alamat_pemohon ?? '-' }}
                                            </p>

                                        </div>


                                    </div>

                                </div>


                                {{-- =================================================
                                SOSIALISASI
                                ================================================== --}}
                            @elseif($isSosialisasi)

                                <div class="mt-2">

                                    <div class="d-flex align-items-center mb-3">

                                        <i class="bi bi-megaphone-fill me-2 text-primary"></i>

                                        <strong>
                                            Detail Kegiatan Sosialisasi
                                        </strong>

                                    </div>


                                    <div class="row">


                                        {{-- NAMA PENYELENGGARA --}}
                                        <div class="col-md-6 mb-3">

                                            <strong>
                                                Nama Penyelenggara
                                            </strong>

                                            <p>
                                                {{ $permohonan->nama_penyelenggara ?? '-' }}
                                            </p>

                                        </div>


                                        {{-- PENANGGUNG JAWAB --}}
                                        <div class="col-md-6 mb-3">

                                            <strong>
                                                Penanggung Jawab
                                            </strong>

                                            <p>
                                                {{ $permohonan->penanggung_jawab ?? '-' }}
                                            </p>

                                        </div>


                                        {{-- NO HP --}}
                                        <div class="col-md-6 mb-3">

                                            <strong>
                                                No. HP / WhatsApp
                                            </strong>

                                            <p>
                                                {{ $permohonan->no_hp ?? '-' }}
                                            </p>

                                        </div>


                                        {{-- JUMLAH PESERTA --}}
                                        <div class="col-md-6 mb-3">

                                            <strong>
                                                Jumlah Peserta
                                            </strong>

                                            <p>

                                                @if($permohonan->jumlah_peserta !== null)

                                                                                    {{ number_format(
                                                        $permohonan->jumlah_peserta,
                                                        0,
                                                        ',',
                                                        '.'
                                                    ) }}

                                                                                    orang

                                                @else

                                                    -

                                                @endif

                                            </p>

                                        </div>


                                        {{-- TANGGAL KEGIATAN --}}
                                        <div class="col-md-6 mb-3">

                                            <strong>
                                                Tanggal Kegiatan
                                            </strong>

                                            <p>

                                                @if($permohonan->tanggal_kegiatan)

                                                                                    {{ \Carbon\Carbon::parse(
                                                        $permohonan->tanggal_kegiatan
                                                    )->translatedFormat('d F Y') }}

                                                @else

                                                    -

                                                @endif

                                            </p>

                                        </div>


                                        {{-- WAKTU KEGIATAN --}}
                                        <div class="col-md-6 mb-3">

                                            <strong>
                                                Waktu Kegiatan
                                            </strong>

                                            <p>

                                                @if($permohonan->waktu_kegiatan)

                                                                                    {{ \Carbon\Carbon::parse(
                                                        $permohonan->waktu_kegiatan
                                                    )->format('H:i') }}

                                                                                    WIB

                                                @else

                                                    -

                                                @endif

                                            </p>

                                        </div>


                                        {{-- TEMPAT --}}
                                        <div class="col-md-12 mb-3">

                                            <strong>
                                                Tempat Kegiatan
                                            </strong>

                                            <p>
                                                {{ $permohonan->tempat ?? '-' }}
                                            </p>

                                        </div>


                                    </div>

                                </div>


                                {{-- =================================================
                                JENIS TIDAK DIKENALI
                                ================================================== --}}
                            @else

                                <div class="alert alert-warning mt-3">

                                    <i class="bi bi-exclamation-triangle me-2"></i>

                                    Jenis permohonan tidak dikenali.

                                    <br>

                                    <small>
                                        Nilai database:
                                        <strong>
                                            {{ $jenisPermohonan ?: '-' }}
                                        </strong>
                                    </small>

                                </div>

                            @endif



                            {{-- =================================================
                            STATUS & TANGGAL PENGAJUAN
                            ================================================== --}}
                            <hr>


                            <div class="row">


                                {{-- STATUS --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Status Permohonan
                                    </strong>

                                    <div class="mt-2">

                                        <span class="badge bg-{{ $warnaStatus }}">
                                            {{ $status }}
                                        </span>
                                    </div>

                                </div>



                                {{-- TANGGAL PENGAJUAN --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Tanggal Pengajuan
                                    </strong>

                                    <p>

                                        @if($permohonan->created_at)

                                                                        {{ $permohonan->created_at
                                            ->translatedFormat('d F Y • H:i') }}

                                                                        WIB

                                        @else

                                            -

                                        @endif

                                    </p>

                                </div>

                            </div>



                            {{-- =================================================
                            KETERANGAN
                            ================================================== --}}
                            <hr>


                            <strong>
                                Keterangan / Tujuan Permohonan
                            </strong>


                            <p class="mb-0">

                                {{ $permohonan->keterangan ?? '-' }}

                            </p>


                        </div>

                    </div>

                    {{-- Lampiran --}}
                    {{-- =====================================================
                    LAMPIRAN DOKUMEN
                    ====================================================== --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">
                            <h3>Lampiran Dokumen</h3>
                        </div>

                        <div class="p-4 text-center">

                            @if($permohonan->lampiran)

                                @php
                                    $lampiranUrl = asset('storage/' . $permohonan->lampiran);
                                    $extension = strtolower(
                                        pathinfo($permohonan->lampiran, PATHINFO_EXTENSION)
                                    );
                                @endphp


                                {{-- =================================================
                                JIKA LAMPIRAN GAMBAR
                                ================================================== --}}
                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))

                                    <img src="{{ $lampiranUrl }}" alt="Lampiran Permohonan" class="img-fluid rounded shadow-sm"
                                        style="max-height:350px;">

                                    <p class="mt-3 text-muted">
                                        Dokumen Pendukung / Surat Permohonan
                                    </p>


                                    {{-- =================================================
                                    JIKA LAMPIRAN PDF
                                    ================================================== --}}
                                @elseif($extension === 'pdf')

                                    <div class="mb-3">

                                        <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size:70px;"></i>

                                    </div>

                                    <p class="mb-3 text-muted">
                                        Dokumen PDF
                                    </p>

                                @endif


                                {{-- =================================================
                                BUTTON LIHAT / BUKA LAMPIRAN
                                ================================================== --}}
                                <div class="mt-3">

                                    <a href="{{ $lampiranUrl }}" target="_blank" class="btn btn-primary">

                                        <i class="bi bi-paperclip"></i>

                                        Lihat Lampiran

                                    </a>

                                </div>


                            @else

                                {{-- =================================================
                                TIDAK ADA LAMPIRAN
                                ================================================== --}}

                                <div class="py-4">

                                    <i class="bi bi-file-earmark-x text-muted" style="font-size:60px;"></i>

                                    <p class="mt-3 mb-0 text-muted">
                                        Tidak ada lampiran dokumen.
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>





                {{-- ================= KANAN ================= --}}
                <div class="col-lg-5">


                 {{-- =================================================
RIWAYAT STATUS
================================================= --}}
<div class="sa-panel">

    <div class="sa-panel-header">

        <h3>
            <i class="bi bi-clock-history me-2"></i>
            Riwayat Status
        </h3>

    </div>


    <div class="p-4">

        @php

            $status = trim($permohonan->status ?? 'Diajukan');

            /*
            |--------------------------------------------------------------------------
            | STATUS TIMELINE
            |--------------------------------------------------------------------------
            */

            $diajukanAktif = in_array($status, [
                'Diajukan',
                'Diverifikasi',
                'Diproses',
                'Selesai'
            ]);

            $verifikasiAktif = in_array($status, [
                'Diverifikasi',
                'Diproses',
                'Selesai'
            ]);

            $prosesAktif = in_array($status, [
                'Diproses',
                'Selesai'
            ]);

            $selesaiAktif = $status === 'Selesai';


            /*
            |--------------------------------------------------------------------------
            | URL LAMPIRAN
            |--------------------------------------------------------------------------
            */

            $lampiranPengajuan = $permohonan->lampiran
                ? asset('storage/' . $permohonan->lampiran)
                : null;

            $lampiranVerifikasi = $permohonan->file_verifikasi
                ? asset('storage/' . $permohonan->file_verifikasi)
                : null;

            $lampiranProses = $permohonan->file_proses
                ? asset('storage/' . $permohonan->file_proses)
                : null;

            $lampiranSelesai = $permohonan->file_selesai
                ? asset('storage/' . $permohonan->file_selesai)
                : null;

        @endphp


        <div class="admin-tracking-timeline">


            {{-- =================================================
            1. PERMOHONAN DIAJUKAN
            ================================================== --}}
            <div class="admin-tracking-item
                {{ $diajukanAktif ? 'selesai' : 'pending' }}">

                <div class="admin-tracking-icon">

                    @if($diajukanAktif)

                        <i class="bi bi-check-lg"></i>

                    @else

                        <i class="bi bi-circle"></i>

                    @endif

                </div>


                <div class="admin-tracking-content">

                    <h6>
                        Permohonan Diajukan
                    </h6>


                    {{-- TANGGAL --}}
                    @if($permohonan->created_at)

                        <small>

                            <i class="bi bi-calendar-event me-1"></i>

                            {{ $permohonan->created_at->translatedFormat('d F Y • H:i') }}

                            WIB

                        </small>

                    @else

                        <small class="text-muted">
                            -
                        </small>

                    @endif


                    {{-- LAMPIRAN --}}
                    <div class="mt-3">

                        @if($lampiranPengajuan)

                            <a href="{{ $lampiranPengajuan }}"
                               target="_blank"
                               class="btn btn-sm btn-primary">

                                <i class="bi bi-paperclip me-1"></i>

                                Lihat Lampiran

                            </a>

                        @else

                            <button type="button"
                                    class="btn btn-sm btn-secondary"
                                    disabled>

                                <i class="bi bi-paperclip me-1"></i>

                                Belum Ada Lampiran

                            </button>

                        @endif

                    </div>

                </div>

            </div>



            {{-- =================================================
            2. DIVERIFIKASI
            ================================================== --}}
            <div class="admin-tracking-item
                {{ $verifikasiAktif ? 'selesai' : 'pending' }}">

                <div class="admin-tracking-icon">

                    @if($verifikasiAktif)

                        <i class="bi bi-check-lg"></i>

                    @else

                        <i class="bi bi-circle"></i>

                    @endif

                </div>


                <div class="admin-tracking-content">

                    <h6>
                        Diverifikasi Admin BNNK
                    </h6>


                    @if($verifikasiAktif)

                        {{-- TANGGAL --}}
                        @if($permohonan->tanggal_verifikasi)

                            <small>

                                <i class="bi bi-calendar-event me-1"></i>

                                {{ \Carbon\Carbon::parse(
                                    $permohonan->tanggal_verifikasi
                                )->translatedFormat('d F Y • H:i') }}

                                WIB

                            </small>

                        @else

                            <small class="text-muted">

                                <i class="bi bi-check-circle me-1"></i>

                                Permohonan telah diverifikasi.

                            </small>

                        @endif


                        {{-- CATATAN --}}
                        @if($permohonan->catatan_verifikasi)

                            <div class="mt-2">

                                <strong>
                                    Catatan:
                                </strong>

                                <br>

                                {{ $permohonan->catatan_verifikasi }}

                            </div>

                        @endif


                    @endif


                    {{-- LAMPIRAN VERIFIKASI --}}
                    <div class="mt-3">

                        @if($lampiranVerifikasi)

                            <a href="{{ $lampiranVerifikasi }}"
                               target="_blank"
                               class="btn btn-sm btn-primary">

                                <i class="bi bi-paperclip me-1"></i>

                                Lihat Lampiran

                            </a>

                        @else

                            <button type="button"
                                    class="btn btn-sm btn-secondary"
                                    disabled>

                                <i class="bi bi-paperclip me-1"></i>

                                Belum Ada Lampiran

                            </button>

                        @endif

                    </div>


                    @if(!$verifikasiAktif)

                        <small class="text-muted d-block mt-2">

                            Menunggu verifikasi admin.

                        </small>

                    @endif

                </div>

            </div>



            {{-- =================================================
            3. DIPROSES
            ================================================== --}}
            <div class="admin-tracking-item
                {{ $prosesAktif ? 'selesai' : 'pending' }}">

                <div class="admin-tracking-icon">

                    @if($prosesAktif)

                        <i class="bi bi-check-lg"></i>

                    @else

                        <i class="bi bi-hourglass-split"></i>

                    @endif

                </div>


                <div class="admin-tracking-content">

                    <h6>
                        Diproses BNNK
                    </h6>


                    @if($prosesAktif)

                        {{-- TANGGAL --}}
                        @if($permohonan->tanggal_proses)

                            <small>

                                <i class="bi bi-calendar-event me-1"></i>

                                {{ \Carbon\Carbon::parse(
                                    $permohonan->tanggal_proses
                                )->translatedFormat('d F Y • H:i') }}

                                WIB

                            </small>

                        @else

                            <small class="text-muted">

                                <i class="bi bi-check-circle me-1"></i>

                                Permohonan sedang diproses.

                            </small>

                        @endif


                        {{-- CATATAN --}}
                        @if($permohonan->catatan_proses)

                            <div class="mt-2">

                                <strong>
                                    Catatan:
                                </strong>

                                <br>

                                {{ $permohonan->catatan_proses }}

                            </div>

                        @endif

                    @endif


                    {{-- LAMPIRAN PROSES --}}
                    <div class="mt-3">

                        @if($lampiranProses)

                            <a href="{{ $lampiranProses }}"
                               target="_blank"
                               class="btn btn-sm btn-primary">

                                <i class="bi bi-paperclip me-1"></i>

                                Lihat Lampiran

                            </a>

                        @else

                            <button type="button"
                                    class="btn btn-sm btn-secondary"
                                    disabled>

                                <i class="bi bi-paperclip me-1"></i>

                                Belum Ada Lampiran

                            </button>

                        @endif

                    </div>


                    @if(!$prosesAktif)

                        <small class="text-muted d-block mt-2">

                            Menunggu proses BNNK.

                        </small>

                    @endif

                </div>

            </div>



            {{-- =================================================
            4. PERMOHONAN SELESAI
            ================================================== --}}
            <div class="admin-tracking-item
                {{ $selesaiAktif ? 'selesai' : 'pending' }}">

                <div class="admin-tracking-icon">

                    @if($selesaiAktif)

                        <i class="bi bi-check-lg"></i>

                    @else

                        <i class="bi bi-flag"></i>

                    @endif

                </div>


                <div class="admin-tracking-content">

                    <h6>
                        Permohonan Selesai
                    </h6>


                    @if($selesaiAktif)

                        {{-- TANGGAL --}}
                        @if($permohonan->tanggal_selesai)

                            <small>

                                <i class="bi bi-calendar-event me-1"></i>

                                {{ \Carbon\Carbon::parse(
                                    $permohonan->tanggal_selesai
                                )->translatedFormat('d F Y • H:i') }}

                                WIB

                            </small>

                        @else

                            <small class="text-muted">

                                <i class="bi bi-check-circle me-1"></i>

                                Permohonan telah selesai.

                            </small>

                        @endif


                        {{-- CATATAN --}}
                        @if($permohonan->catatan_selesai)

                            <div class="mt-2">

                                <strong>
                                    Catatan:
                                </strong>

                                <br>

                                {{ $permohonan->catatan_selesai }}

                            </div>

                        @endif

                    @endif


                    {{-- LAMPIRAN SELESAI --}}
                    <div class="mt-3">

                        @if($lampiranSelesai)

                            <a href="{{ $lampiranSelesai }}"
                               target="_blank"
                               class="btn btn-sm btn-primary">

                                <i class="bi bi-paperclip me-1"></i>

                                Lihat Lampiran

                            </a>

                        @else

                            <button type="button"
                                    class="btn btn-sm btn-secondary"
                                    disabled>

                                <i class="bi bi-paperclip me-1"></i>

                                Belum Ada Lampiran

                            </button>

                        @endif

                    </div>


                    @if(!$selesaiAktif)

                        <small class="text-muted d-block mt-2">

                            Belum selesai.

                        </small>

                    @endif

                </div>

            </div>


        </div>

    </div>

</div>



                    {{-- =====================================================
                    UPDATE STATUS PERMOHONAN
                    ====================================================== --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">

                            <h3>
                                Verifikasi Permohonan
                            </h3>

                        </div>

                        <div class="p-4">

                            <form action="{{ route('superadmin.update_permohonan', $permohonan->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')


                                {{-- =================================================
                                STATUS
                                ================================================== --}}
                                <div class="mb-3">

                                    <label for="status" class="form-label">
                                        Status Permohonan
                                    </label>

                                    <select name="status" id="status" class="form-control" required>

                                        {{-- =========================================
                                        Diajukan
                                        HANYA BOLEH → DIVERIFIKASI / DITOLAK
                                        ========================================== --}}
                                        @if($permohonan->status === 'Diajukan')

                                            <option value="Diverifikasi">
                                                Diverifikasi
                                            </option>

                                            <option value="Ditolak">
                                                Ditolak
                                            </option>


                                            {{-- =========================================
                                            Diverifikasi
                                            HANYA BOLEH → DIPROSES / DITOLAK
                                            ========================================== --}}
                                        @elseif($permohonan->status === 'Diverifikasi')

                                            <option value="Diproses">
                                                Diproses
                                            </option>

                                            <option value="Ditolak">
                                                Ditolak
                                            </option>


                                            {{-- =========================================
                                            Diproses
                                            HANYA BOLEH → SELESAI
                                            ========================================== --}}
                                        @elseif($permohonan->status === 'Diproses')

                                            <option value="Selesai">
                                                Selesai
                                            </option>


                                            {{-- =========================================
                                            Selesai
                                            TIDAK BOLEH KEMBALI
                                            ========================================== --}}
                                        @elseif($permohonan->status === 'Selesai')

                                            <option value="Selesai">
                                                Selesai
                                            </option>


                                            {{-- =========================================
                                            Ditolak
                                            TIDAK BOLEH KEMBALI
                                            ========================================== --}}
                                        @elseif($permohonan->status === 'Ditolak')

                                            <option value="Ditolak">
                                                Ditolak
                                            </option>


                                            {{-- =========================================
                                            FALLBACK
                                            ========================================== --}}
                                        @else

                                            <option value="Diverifikasi">
                                                Diverifikasi
                                            </option>

                                        @endif

                                    </select>

                                </div>


                                {{-- =================================================
                                CATATAN
                                ================================================== --}}
                                <div class="mb-3">

                                    <label for="catatan" class="form-label">
                                        Catatan Admin
                                    </label>

                                    <textarea name="catatan" id="catatan" class="form-control" rows="4"
                                        placeholder="Masukkan catatan verifikasi atau tindak lanjut...">{{ old('catatan') }}</textarea>

                                </div>


                                {{-- =================================================
                                FILE BUKTI
                                ================================================== --}}
                                <div class="mb-4">

                                    <label for="bukti" class="form-label">
                                        Upload Bukti Tindak Lanjut
                                    </label>

                                    <input type="file" name="bukti" id="bukti" class="form-control"
                                        accept=".jpg,.jpeg,.png,.pdf">

                                    <small class="text-muted">
                                        Format JPG, JPEG, PNG, PDF. Maksimal 2 MB.
                                    </small>


                                    {{-- =========================
                                    PREVIEW
                                    ========================== --}}
                                    <div id="previewContainer" class="mt-3" style="display: none;">

                                        {{-- Preview Gambar --}}
                                        <img id="previewBukti" src="" alt="Preview Bukti" class="img-fluid rounded shadow"
                                            style="
                                                                                display: none;
                                                                                max-height: 400px;
                                                                                width: auto;
                                                                            ">


                                        {{-- Preview PDF --}}
                                        <iframe id="previewPdf" src="" style="
                                                                                display: none;
                                                                                width: 100%;
                                                                                height: 500px;
                                                                                border: 1px solid #ddd;
                                                                                border-radius: 8px;
                                                                            "></iframe>

                                    </div>

                                </div>


                                {{-- =================================================
                                BUTTON
                                ================================================== --}}
                                <div class="d-grid">

                                    <button type="submit" class="btn btn-primary">

                                        <i class="bi bi-check-circle-fill me-1"></i>

                                        Simpan Perubahan

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>


            </div>

        </main>

    </section>

    <!-- ==========================================
                                                                                                                     MODAL DETAIL TINDAK LANJUT PERMOHONAN
                                                                                                                ========================================== -->
    <div class="modal fade" id="detailPermohonanModal" tabindex="-1" aria-labelledby="detailPermohonanModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg rounded-4">

                <!-- Header -->
                <div class="modal-header">

                    <h5 class="modal-title fw-bold" id="detailPermohonanModalLabel">
                        <i class="bi bi-file-earmark-text-fill me-2"></i>
                        Detail Tindak Lanjut Permohonan
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <!-- Body -->
                <div class="modal-body p-4">

                    <div class="row g-4 align-items-start">

                        <!-- Dokumen / Bukti -->
                        <div class="col-md-5">

                            <img src="{{ asset('images/bukti-default.jpg') }}" class="img-fluid rounded-3 shadow-sm border"
                                alt="Dokumen Permohonan">

                        </div>

                        <!-- Informasi -->
                        <div class="col-md-7">

                            <h4 class="fw-bold mb-3">
                                Permohonan Rehabilitasi
                            </h4>

                            <hr>

                            <p class="mb-3">

                                <strong>Status :</strong>

                                <span class="badge bg-primary px-3 py-2">
                                    Diproses
                                </span>

                            </p>

                            <p class="mb-3">

                                <strong>Petugas/Admin :</strong>

                                Admin BNNK Tulungagung

                            </p>

                            <p class="mb-3">

                                <strong>Tanggal Penanganan :</strong>

                                16 Juli 2026 • 10:45 WIB

                            </p>

                            <label class="fw-bold mb-2">

                                <i class="bi bi-journal-text me-1"></i>

                                Catatan Admin

                            </label>

                            <div class="border rounded-3 bg-light p-3">

                                Dokumen permohonan telah diterima dan
                                diverifikasi oleh Admin BNNK Tulungagung.

                                <br><br>

                                Selanjutnya permohonan diteruskan ke
                                Bidang Rehabilitasi untuk dilakukan
                                pemeriksaan kelengkapan administrasi dan
                                penjadwalan proses layanan.

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">

                        <i class="bi bi-x-circle me-1"></i>
                        Tutup

                    </button>

                </div>

            </div>

        </div>

    </div>
    <script>
        document.getElementById('bukti').addEventListener('change', function (event) {

            const file = event.target.files[0];

            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('previewBukti');
            const previewPdf = document.getElementById('previewPdf');

            // Reset preview
            previewImage.style.display = 'none';
            previewPdf.style.display = 'none';

            previewImage.src = '';
            previewPdf.src = '';

            if (!file) {
                previewContainer.style.display = 'none';
                return;
            }

            const fileType = file.type;

            // Tampilkan gambar
            if (fileType.startsWith('image/')) {

                const reader = new FileReader();

                reader.onload = function (e) {

                    previewImage.src = e.target.result;

                    previewImage.style.display = 'block';

                    previewContainer.style.display = 'block';
                };

                reader.readAsDataURL(file);

            }

            // Tampilkan PDF
            else if (fileType === 'application/pdf') {

                const fileURL = URL.createObjectURL(file);

                previewPdf.src = fileURL;

                previewPdf.style.display = 'block';

                previewContainer.style.display = 'block';

            }

        });
    </script>
@endsection