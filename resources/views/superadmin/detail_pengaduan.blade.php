@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')

    <section class="sa-dashboard" id="superAdminDashboard">

        @include('layouts.sidebar')

        <main class="sa-main">

            {{-- Header --}}
            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button class="sa-toggle-sidebar">
                        <i class="bi bi-list" id="toggleSidebar"></i>
                    </button>

                    <div class="sa-page-heading">

                        <h1>Detail Pengaduan</h1>

                        <p>Informasi lengkap pengaduan masyarakat.</p>

                    </div>

                </div>

            </header>



            <div class="row mt-4">

                {{-- KIRI --}}
                <div class="col-lg-7">
                    {{-- =================================================
                    | INFORMASI PENGADUAN
                    ================================================== --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">

                            <h3>
                                Informasi Pengaduan
                            </h3>

                        </div>


                        <div class="p-4">

                            <div class="row">


                                {{-- KODE --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Kode Aduan
                                    </strong>

                                    <p>
                                        {{ $pengaduan->kode_aduan ?? '-' }}
                                    </p>

                                </div>


                                {{-- JUDUL --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Judul Aduan
                                    </strong>

                                    <p>
                                        {{ $pengaduan->judul_aduan ?? '-' }}
                                    </p>

                                </div>


                                {{-- KATEGORI --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Kategori
                                    </strong>

                                    <p>
                                        {{ $pengaduan->topik_aduan ?? '-' }}
                                    </p>

                                </div>

                                {{-- STATUS --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Status
                                    </strong>

                                    <p>

                                        @php

                                            $statusClass = match ($pengaduan->status) {

                                                'Diajukan' =>
                                                'bg-secondary',

                                                'Diverifikasi' =>
                                                'bg-primary',

                                                'Diproses' =>
                                                'bg-warning text-dark',

                                                'Selesai' =>
                                                'bg-success',

                                                'Ditolak' =>
                                                'bg-danger',

                                                default =>
                                                'bg-secondary',

                                            };

                                        @endphp


                                        <span class="badge {{ $statusClass }} px-3 py-2">

                                            {{ $pengaduan->status ?? 'Diajukan' }}

                                        </span>

                                    </p>

                                </div>


                                {{-- NAMA --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Nama Pelapor
                                    </strong>

                                    <p>
                                        {{ $pengaduan->nama_lengkap ?? 'Anonim' }}
                                    </p>

                                </div>


                                {{-- WHATSAPP --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        No. WhatsApp
                                    </strong>

                                    <p>
                                        {{ $pengaduan->no_whatsapp ?? '-' }}
                                    </p>

                                </div>


                                {{-- EMAIL --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Email
                                    </strong>

                                    <p>
                                        {{ $pengaduan->email ?? '-' }}
                                    </p>

                                </div>


                                {{-- KECAMATAN --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Kecamatan
                                    </strong>

                                    <p>
                                        {{ $pengaduan->kecamatan->nama_kecamatan ?? '-' }}
                                    </p>

                                </div>


                                {{-- DESA --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Desa
                                    </strong>

                                    <p>
                                        {{ $pengaduan->desa->nama_desa ?? '-' }}
                                    </p>

                                </div>


                                {{-- TANGGAL --}}
                                <div class="col-md-6 mb-3">

                                    <strong>
                                        Tanggal Pengaduan
                                    </strong>

                                    <p>

                                        @if($pengaduan->created_at)

                                            {{ $pengaduan->created_at->translatedFormat('d F Y H:i') }}
                                            WIB

                                        @else

                                            -

                                        @endif

                                    </p>

                                </div>


                                {{-- ALAMAT --}}
                                <div class="col-md-12 mb-3">

                                    <strong>
                                        Alamat Kejadian
                                    </strong>

                                    <p>
                                        {{ $pengaduan->alamat_kejadian ?? '-' }}
                                    </p>

                                </div>

                            </div>


                            <hr>


                            {{-- DETAIL --}}
                            <div class="mb-2">

                                <strong>
                                    Detail Pengaduan
                                </strong>

                            </div>

                            <p class="mb-0">

                                {{ $pengaduan->detail_aduan ?? '-' }}

                            </p>

                        </div>

                    </div>


                    {{-- Lampiran --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">

                            <h3>Lampiran Bukti</h3>

                        </div>

                        <div class="p-4 text-center">

                            @if($pengaduan->lampiran)

                                <img src="{{ asset('storage/' . $pengaduan->lampiran) }}" alt="Lampiran Bukti Pengaduan"
                                    class="img-fluid rounded shadow"
                                    style="max-height: 500px; max-width: 100%; object-fit: contain;">

                                <div class="mt-3">

                                    <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" target="_blank"
                                        class="btn btn-primary">
                                        <i class="bi bi-eye-fill"></i>
                                        Lihat Lampiran
                                    </a>

                                </div>

                            @else

                                <div class="py-5 text-muted">

                                    <i class="bi bi-image" style="font-size: 50px;"></i>

                                    <p class="mt-3 mb-0">
                                        Tidak ada lampiran bukti.
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>
                </div>



                {{-- KANAN --}}
                <div class="col-lg-5">

                    {{-- ================= RIWAYAT STATUS ================= --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">
                            <h3>
                                <i class="bi bi-clock-history me-2"></i>
                                Riwayat Status
                            </h3>
                        </div>

                        <div class="p-4">

                            <div class="admin-tracking-timeline">

                                @php

                                    /*
                                    |--------------------------------------------------------------------------
                                    | STATUS PERMOHONAN / PENGADUAN
                                    |--------------------------------------------------------------------------
                                    */

                                    $status = trim($pengaduan->status ?? 'Diajukan');


                                    /*
                                    |--------------------------------------------------------------------------
                                    | TENTUKAN TAHAP BERDASARKAN STATUS DATABASE
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

                                @endphp



                                {{-- =====================================================
                                1. DIAJUKAN
                                ====================================================== --}}

                                <div class="admin-tracking-item {{ $diajukanAktif ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">

                                        @if($diajukanAktif)

                                            <i class="bi bi-check-lg"></i>

                                        @else

                                            <i class="bi bi-circle"></i>

                                        @endif

                                    </div>


                                    <div class="admin-tracking-content">

                                        <h6>
                                            Diajukan
                                        </h6>


                                        @if($pengaduan->created_at)

                                            <small>

                                                <i class="bi bi-calendar-event me-1"></i>

                                                {{ $pengaduan->created_at->translatedFormat('d F Y • H:i') }}

                                                WIB

                                            </small>

                                        @else

                                            <small class="text-muted">
                                                -
                                            </small>

                                        @endif

                                    </div>

                                </div>



                                {{-- =====================================================
                                2. DIVERIFIKASI
                                ====================================================== --}}

                                <div class="admin-tracking-item {{ $verifikasiAktif ? 'selesai' : 'pending' }}">

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

                                            @if($pengaduan->tanggal_verifikasi)

                                                                            <small>

                                                                                <i class="bi bi-calendar-event me-1"></i>

                                                                                {{ \Carbon\Carbon::parse(
                                                    $pengaduan->tanggal_verifikasi
                                                )->translatedFormat('d F Y • H:i') }}

                                                                                WIB

                                                                            </small>

                                            @else

                                                <small>

                                                    <i class="bi bi-check-circle me-1"></i>

                                                    Pengaduan telah diverifikasi.

                                                </small>

                                            @endif


                                            @if($pengaduan->catatan_verifikasi)

                                                <div class="mt-2">

                                                    <strong>
                                                        Catatan:
                                                    </strong>

                                                    <br>

                                                    {{ $pengaduan->catatan_verifikasi }}

                                                </div>

                                            @endif


                                            @if($pengaduan->tanggal_verifikasi)

                                                                        <div class="mt-2">

                                                                            <button type="button" class="btn-detail-admin" data-bs-toggle="modal"
                                                                                data-bs-target="#detailAdminModal" data-status="Diverifikasi" data-foto="{{ $pengaduan->foto_verifikasi
                                                ? asset('storage/' . $pengaduan->foto_verifikasi)
                                                : '' }}" data-catatan="{{ $pengaduan->catatan_verifikasi ?? '' }}"
                                                                                data-tanggal="{{ $pengaduan->tanggal_verifikasi
                                                ? \Carbon\Carbon::parse($pengaduan->tanggal_verifikasi)->translatedFormat('d F Y • H:i')
                                                : '' }}">

                                                                                <i class="bi bi-eye-fill me-1"></i>

                                                                                Lihat Bukti & Catatan

                                                                            </button>

                                                                        </div>

                                            @endif

                                        @else

                                            <small class="text-muted">

                                                Menunggu verifikasi admin.

                                            </small>

                                        @endif

                                    </div>

                                </div>



                                {{-- =====================================================
                                3. DIPROSES LAPANGAN
                                ====================================================== --}}

                                <div class="admin-tracking-item {{ $prosesAktif ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">

                                        @if($prosesAktif)

                                            <i class="bi bi-check-lg"></i>

                                        @else

                                            <i class="bi bi-hourglass-split"></i>

                                        @endif

                                    </div>


                                    <div class="admin-tracking-content">

                                        <h6>
                                            Diproses Lapangan
                                        </h6>


                                        @if($prosesAktif)

                                            @if($pengaduan->tanggal_proses)

                                                                            <small>

                                                                                <i class="bi bi-calendar-event me-1"></i>

                                                                                {{ \Carbon\Carbon::parse(
                                                    $pengaduan->tanggal_proses
                                                )->translatedFormat('d F Y • H:i') }}

                                                                                WIB

                                                                            </small>

                                            @else

                                                <small>

                                                    <i class="bi bi-check-circle me-1"></i>

                                                    Pengaduan sedang diproses.

                                                </small>

                                            @endif


                                            @if($pengaduan->catatan_proses)

                                                <div class="mt-2">

                                                    <strong>
                                                        Catatan:
                                                    </strong>

                                                    <br>

                                                    {{ $pengaduan->catatan_proses }}

                                                </div>

                                            @endif


                                            @if($pengaduan->tanggal_proses)

                                                                        <div class="mt-2">

                                                                            <button type="button" class="btn-detail-admin" data-bs-toggle="modal"
                                                                                data-bs-target="#detailAdminModal" data-status="Diproses" data-foto="{{ $pengaduan->foto_proses
                                                ? asset('storage/' . $pengaduan->foto_proses)
                                                : '' }}" data-catatan="{{ $pengaduan->catatan_proses ?? '' }}"
                                                                                data-tanggal="{{ $pengaduan->tanggal_proses
                                                ? \Carbon\Carbon::parse($pengaduan->tanggal_proses)->translatedFormat('d F Y • H:i')
                                                : '' }}">

                                                                                <i class="bi bi-eye-fill me-1"></i>

                                                                                Lihat Bukti & Catatan

                                                                            </button>

                                                                        </div>

                                            @endif

                                        @else

                                            <small class="text-muted">

                                                Menunggu proses lapangan.

                                            </small>

                                        @endif

                                    </div>

                                </div>



                                {{-- =====================================================
                                4. SELESAI
                                ====================================================== --}}

                                <div class="admin-tracking-item {{ $selesaiAktif ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">

                                        @if($selesaiAktif)

                                            <i class="bi bi-check-lg"></i>

                                        @else

                                            <i class="bi bi-flag"></i>

                                        @endif

                                    </div>


                                    <div class="admin-tracking-content">

                                        <h6>
                                            Selesai / Diteruskan BNNK
                                        </h6>


                                        @if($selesaiAktif)

                                            @if($pengaduan->tanggal_selesai)

                                                                            <small>

                                                                                <i class="bi bi-calendar-event me-1"></i>

                                                                                {{ \Carbon\Carbon::parse(
                                                    $pengaduan->tanggal_selesai
                                                )->translatedFormat('d F Y • H:i') }}

                                                                                WIB

                                                                            </small>

                                            @else

                                                <small>

                                                    <i class="bi bi-check-circle me-1"></i>

                                                    Pengaduan telah selesai.

                                                </small>

                                            @endif


                                            @if($pengaduan->catatan_selesai)

                                                <div class="mt-2">

                                                    <strong>
                                                        Catatan:
                                                    </strong>

                                                    <br>

                                                    {{ $pengaduan->catatan_selesai }}

                                                </div>

                                            @endif


                                            @if($pengaduan->tanggal_selesai)

                                                                        <div class="mt-2">

                                                                            <button type="button" class="btn-detail-admin" data-bs-toggle="modal"
                                                                                data-bs-target="#detailAdminModal" data-status="Selesai" data-foto="{{ $pengaduan->foto_selesai
                                                ? asset('storage/' . $pengaduan->foto_selesai)
                                                : '' }}" data-catatan="{{ $pengaduan->catatan_selesai ?? '' }}"
                                                                                data-tanggal="{{ $pengaduan->tanggal_selesai
                                                ? \Carbon\Carbon::parse($pengaduan->tanggal_selesai)->translatedFormat('d F Y • H:i')
                                                : '' }}">

                                                                                <i class="bi bi-eye-fill me-1"></i>

                                                                                Lihat Bukti & Catatan

                                                                            </button>

                                                                        </div>

                                            @endif

                                        @else

                                            <small class="text-muted">

                                                Belum selesai.

                                            </small>

                                        @endif

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>



                    {{-- Update Status --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">

                            <h3>Verifikasi</h3>

                        </div>

                        <div class="p-4">

                            <form action="{{ route('superadmin.update_pengaduan', $pengaduan->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="mb-3">

                                    <label for="status" class="form-label">
                                        Status Pengaduan
                                    </label>

                                    <select name="status" id="status" class="form-control" required>

                                        @if($pengaduan->status === 'Diajukan')

                                            <option value="Diverifikasi">
                                                Diverifikasi
                                            </option>

                                            <option value="Ditolak">
                                                Ditolak
                                            </option>


                                        @elseif($pengaduan->status === 'Diverifikasi')

                                            <option value="Diproses">
                                                Diproses
                                            </option>

                                            <option value="Ditolak">
                                                Ditolak
                                            </option>


                                        @elseif($pengaduan->status === 'Diproses')

                                            <option value="Selesai">
                                                Selesai
                                            </option>


                                        @elseif($pengaduan->status === 'Selesai')

                                            <option value="Selesai">
                                                Selesai
                                            </option>


                                        @elseif($pengaduan->status === 'Ditolak')

                                            <option value="Ditolak">
                                                Ditolak
                                            </option>

                                        @endif

                                    </select>

                                </div>


                                <div class="mb-3">

                                    <label for="catatan" class="form-label">
                                        Catatan
                                    </label>

                                    <textarea name="catatan" id="catatan" class="form-control" rows="4"
                                        placeholder="Masukkan catatan..."></textarea>

                                </div>


                                <div class="mb-3">

                                    <label for="bukti" class="form-label">
                                        Bukti / Foto
                                    </label>

                                    <input type="file" name="bukti" id="bukti" class="form-control"
                                        accept=".jpg,.jpeg,.png">

                                </div>


                                <button type="submit" class="btn btn-primary">

                                    Simpan Perubahan

                                </button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            </div>

        </main>

    </section>

    {{-- =========================================================
    MODAL DETAIL TINDAK LANJUT ADUAN
    ========================================================= --}}
    {{-- =========================================================
    MODAL DETAIL TINDAK LANJUT ADUAN
    ========================================================= --}}

    <div class="modal fade" id="detailAdminModal" tabindex="-1" aria-labelledby="detailAdminModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg rounded-4">

                {{-- =====================================================
                HEADER
                ====================================================== --}}

                <div class="modal-header" id="detailAdminModalHeader" style="background:#0d6efd;">

                    <h5 class="modal-title fw-bold text-white" id="detailAdminModalLabel">

                        <i class="bi bi-file-earmark-medical me-2"></i>

                        Detail Tindak Lanjut Aduan

                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>

                </div>


                {{-- =====================================================
                BODY
                ====================================================== --}}

                <div class="modal-body p-4">

                    <div class="row g-4 align-items-start">


                        {{-- =================================================
                        FOTO TINDAK LANJUT
                        ================================================== --}}

                        <div class="col-md-5">

                            <div class="text-center">

                                {{-- FOTO --}}
                                <img id="modalFoto" src="" alt="Bukti Tindak Lanjut"
                                    class="img-fluid rounded-3 shadow-sm border" style="
                                                                max-width:100%;
                                                                max-height:350px;
                                                                object-fit:contain;
                                                                display:none;
                                                            ">


                                {{-- TOMBOL LIHAT FOTO --}}
                                <div class="mt-3" id="modalFotoButtonContainer" style="display:none;">

                                    <a id="modalFotoLink" href="#" target="_blank" class="btn btn-sm btn-outline-primary">

                                        <i class="bi bi-eye-fill me-1"></i>

                                        Lihat Foto

                                    </a>

                                </div>


                            </div>

                        </div>



                        {{-- =================================================
                        INFORMASI
                        ================================================== --}}

                        <div class="col-md-7">


                            {{-- JUDUL ADUAN --}}

                            <h4 class="fw-bold mb-1">

                                {{ $pengaduan->judul_aduan ?? '-' }}

                            </h4>


                            {{-- KODE ADUAN --}}

                            <span class="text-muted">

                                {{ $pengaduan->kode_aduan ?? '-' }}

                            </span>


                            <hr>


                            {{-- =================================================
                            STATUS
                            ================================================== --}}

                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Status
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>

                                <div class="detail-value">

                                    <span id="modalStatus" class="badge px-3 py-2">

                                        <i id="modalStatusIcon" class="bi me-1">
                                        </i>

                                        <span id="modalStatusText">
                                            -
                                        </span>

                                    </span>

                                </div>

                            </div>


                            {{-- =================================================
                            TOPIK
                            ================================================== --}}

                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Topik Aduan
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->topik_aduan ?? '-' }}

                                </div>

                            </div>


                            {{-- =================================================
                            KECAMATAN
                            ================================================== --}}

                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Kecamatan
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->kecamatan->nama_kecamatan ?? '-' }}

                                </div>

                            </div>


                            {{-- =================================================
                            TANGGAL
                            ================================================== --}}

                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Tanggal Penanganan
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>

                                <div class="detail-value">

                                    <span id="modalTanggal">
                                        -
                                    </span>

                                </div>

                            </div>


                            {{-- =================================================
                            ADMIN
                            ================================================== --}}

                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Petugas/Admin
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $pengaduan->admin->nama ?? 'Admin BNNK Tulungagung' }}

                                </div>

                            </div>


                            {{-- =================================================
                            CATATAN ADMIN
                            ================================================== --}}

                            <div class="mt-4">

                                <label class="fw-bold mb-2">

                                    <i class="bi bi-journal-text me-1"></i>

                                    Catatan Admin

                                </label>


                                <div id="modalCatatan" class="border rounded-3 bg-light p-3">

                                    <span class="text-muted">
                                        Belum ada catatan dari admin.
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                FOOTER
                ====================================================== --}}

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        <i class="bi bi-x-circle me-1"></i>

                        Tutup

                    </button>

                </div>

            </div>

        </div>

    </div>




@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('detailAdminModal');

        if (!modal) {
            return;
        }

        modal.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;

            if (!button) {
                return;
            }

            // =====================================================
            // DATA DARI TIMELINE YANG DIKLIK
            // =====================================================

            const status =
                button.getAttribute('data-status') || '';

            const foto =
                button.getAttribute('data-foto') || '';

            const catatan =
                button.getAttribute('data-catatan') || '';

            const tanggal =
                button.getAttribute('data-tanggal') || '';


            // =====================================================
            // ELEMENT MODAL
            // =====================================================

            const header =
                document.getElementById('detailAdminModalHeader');

            const statusBadge =
                document.getElementById('modalStatus');

            const statusIcon =
                document.getElementById('modalStatusIcon');

            const statusText =
                document.getElementById('modalStatusText');

            const tanggalElement =
                document.getElementById('modalTanggal');

            const catatanElement =
                document.getElementById('modalCatatan');

            const fotoElement =
                document.getElementById('modalFoto');

            const fotoLink =
                document.getElementById('modalFotoLink');

            const fotoButtonContainer =
                document.getElementById('modalFotoButtonContainer');

            const noFoto =
                document.getElementById('modalNoFoto');


            // =====================================================
            // DEFAULT
            // =====================================================

            let warna = '#6c757d';

            let icon = 'bi-clock';

            let label = 'Belum Diproses';


            // =====================================================
            // DIVERIFIKASI
            // =====================================================

            if (status === 'Diverifikasi') {

                warna = '#0d6efd';

                icon = 'bi-check-circle';

                label = 'Diverifikasi Admin BNNK';

            }


            // =====================================================
            // DIPROSES
            // =====================================================

            else if (status === 'Diproses') {

                warna = '#ffc107';

                icon = 'bi-hourglass-split';

                label = 'Sedang Diproses Lapangan';

            }


            // =====================================================
            // SELESAI
            // =====================================================

            else if (status === 'Selesai') {

                warna = '#198754';

                icon = 'bi-check-all';

                label = 'Selesai / Diteruskan BNNK';

            }


            // =====================================================
            // DITOLAK
            // =====================================================

            else if (status === 'Ditolak') {

                warna = '#dc3545';

                icon = 'bi-x-circle';

                label = 'Pengaduan Ditolak';

            }


            // =====================================================
            // HEADER
            // =====================================================

            header.style.backgroundColor = warna;


            // =====================================================
            // STATUS
            // =====================================================

            statusBadge.style.backgroundColor = warna;

            statusBadge.classList.remove(
                'text-dark',
                'text-white'
            );

            if (status === 'Diproses') {

                statusBadge.classList.add('text-dark');

            } else {

                statusBadge.classList.add('text-white');

            }


            statusIcon.className =
                'bi ' + icon + ' me-1';

            statusText.textContent =
                label;


            // =====================================================
            // TANGGAL
            // =====================================================

            tanggalElement.textContent =
                tanggal || '-';


            // =====================================================
            // CATATAN
            // =====================================================

            if (catatan) {

                catatanElement.innerHTML =
                    catatan.replace(/\n/g, '<br>');

            } else {

                catatanElement.innerHTML =
                    '<span class="text-muted">' +
                    'Belum ada catatan dari admin.' +
                    '</span>';

            }


            // =====================================================
            // FOTO
            // =====================================================

            if (foto) {

                fotoElement.src = foto;

                fotoElement.style.display = 'block';

                fotoLink.href = foto;

                fotoButtonContainer.style.display = 'block';

                noFoto.style.display = 'none';

            } else {

                fotoElement.src = '';

                fotoElement.style.display = 'none';

                fotoLink.href = '#';

                fotoButtonContainer.style.display = 'none';

                noFoto.style.display = 'flex';

            }

        });

    });
</script>