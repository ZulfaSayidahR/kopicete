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

                                                'Diproses Lapangan' =>
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

                                {{-- =====================================================
                                1. DIAJUKAN
                                ====================================================== --}}
                                <div class="admin-tracking-item selesai">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-check-lg"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>Diajukan</h6>

                                        <small>
                                            <i class="bi bi-calendar-event me-1"></i>

                                            @if($pengaduan->created_at)

                                                {{ $pengaduan->created_at->translatedFormat('d F Y • H:i') }}
                                                WIB

                                            @else

                                                -

                                            @endif

                                        </small>

                                    </div>

                                </div>



                                {{-- =====================================================
                                2. DIVERIFIKASI
                                ====================================================== --}}
                                @php
                                    $verifikasiAktif = !empty($pengaduan->tanggal_verifikasi);
                                @endphp

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

                                                                            <small>
                                                                                <i class="bi bi-calendar-event me-1"></i>

                                                                                {{ \Carbon\Carbon::parse(
                                                $pengaduan->tanggal_verifikasi
                                            )->translatedFormat('d F Y • H:i') }}

                                                                                WIB
                                                                            </small>


                                                                            <div>

                                                                                <button type="button" class="btn-detail-admin mt-2" data-bs-toggle="modal"
                                                                                    data-bs-target="#detailAdminModal">

                                                                                    <i class="bi bi-eye-fill me-1"></i>

                                                                                    Lihat Bukti & Catatan

                                                                                </button>

                                                                            </div>

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
                                @php
                                    $prosesAktif = in_array(
                                        $pengaduan->status,
                                        [
                                            'Diproses',
                                            'Selesai'
                                        ]
                                    );
                                @endphp

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

                                                                            <small>

                                                                                <i class="bi bi-calendar-event me-1"></i>

                                                                                {{ \Carbon\Carbon::parse(
                                                $pengaduan->tanggal_proses
                                            )->translatedFormat('d F Y • H:i') }}

                                                                                WIB

                                                                            </small>


                                                                            <div>

                                                                                <button type="button" class="btn-detail-admin mt-2" data-bs-toggle="modal"
                                                                                    data-bs-target="#detailAdminModal">

                                                                                    <i class="bi bi-eye-fill me-1"></i>

                                                                                    Lihat Bukti & Catatan

                                                                                </button>

                                                                            </div>

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
                                @php
                                    $selesaiAktif = $pengaduan->status == 'Selesai';
                                @endphp

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

                                                                            <small>

                                                                                <i class="bi bi-calendar-event me-1"></i>

                                                                                {{ \Carbon\Carbon::parse(
                                                $pengaduan->tanggal_selesai
                                            )->translatedFormat('d F Y • H:i') }}

                                                                                WIB

                                                                            </small>


                                                                            <div>

                                                                                <button type="button" class="btn-detail-admin mt-2" data-bs-toggle="modal"
                                                                                    data-bs-target="#detailAdminModal">

                                                                                    <i class="bi bi-eye-fill me-1"></i>

                                                                                    Lihat Bukti & Catatan

                                                                                </button>

                                                                            </div>

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

                                {{-- STATUS --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Status
                                    </label>

                                    <select class="form-select" name="status" required>


                                        <option value="Diverifikasi" {{ $pengaduan->status == 'Diverifikasi' ? 'selected' : '' }}>
                                            Diverifikasi
                                        </option>


                                        <option value="Diproses" {{ $pengaduan->status == 'Diproses' ? 'selected' : '' }}>
                                            Diproses Lapangan
                                        </option>


                                        <option value="Selesai" {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>


                                        <option value="Ditolak" {{ $pengaduan->status == 'Ditolak' ? 'selected' : '' }}>
                                            Ditolak
                                        </option>


                                    </select>

                                </div>

                                {{-- CATATAN --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Catatan Admin
                                    </label>

                                    <textarea class="form-control" name="catatan" rows="4"
                                        placeholder="Masukkan catatan hasil tindak lanjut...">{{ old('catatan') }}</textarea>

                                </div>

                                {{-- BUKTI --}}
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Upload Bukti Tindak Lanjut
                                    </label>

                                    <input type="file" name="bukti" class="form-control" accept=".jpg,.jpeg,.png">

                                    <small class="text-muted">
                                        Format JPG, JPEG, PNG. Maksimal 2 MB.
                                    </small>

                                </div>

                                <div class="d-grid">

                                    <button type="submit" class="btn btn-primary">

                                        <i class="bi bi-check-circle-fill"></i>
                                        Simpan Perubahan

                                    </button>

                                </div>

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

    @php

        $status = $pengaduan->status ?? 'Menunggu';

        $warna = 'secondary';
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

                break;

        }

    @endphp


    <div class="modal fade" id="detailAdminModal" tabindex="-1" aria-labelledby="detailAdminModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg rounded-4">


                {{-- =====================================================
                HEADER
                ====================================================== --}}

                <div class="modal-header bg-{{ $warna }}
                                                                        @if($warna != 'warning')
                                                                            text-white
                                                                        @endif
                                                                    ">

                    <h5 class="modal-title fw-bold" id="detailAdminModalLabel">

                        <i class="bi bi-file-earmark-medical me-2"></i>

                        Detail Tindak Lanjut Aduan

                    </h5>


                    <button type="button" class="btn-close
                                                                                @if($warna != 'warning')
                                                                                    btn-close-white
                                                                                @endif
                                                                            " data-bs-dismiss="modal" aria-label="Close">
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

                            @if($foto)

                                <div class="text-center">

                                    <img src="{{ asset('storage/' . $foto) }}" alt="Bukti Tindak Lanjut"
                                        class="img-fluid rounded-3 shadow-sm border"
                                        style="
                                                                                                                                    max-width: 100%;
                                                                                                                                    max-height: 350px;
                                                                                                                                    object-fit: contain;
                                                                                                                                ">

                                    <div class="mt-3">

                                        <a href="{{ asset('storage/' . $foto) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye-fill me-1"></i>
                                            Lihat Foto
                                        </a>

                                    </div>

                                </div>

                            @else

                                <div class="border rounded-3 bg-light d-flex flex-column justify-content-center align-items-center text-muted"
                                    style="height:300px;">

                                    <i class="bi bi-image" style="font-size:60px;"></i>

                                    <span class="mt-2">
                                        Belum ada foto tindak lanjut
                                    </span>

                                </div>

                            @endif


                        </div>



                        {{-- =================================================
                        INFORMASI TINDAK LANJUT
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



                            {{-- STATUS --}}
                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Status
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>


                                <div class="detail-value">

                                    @php

                                        $status = $pengaduan->status;


                                        $warnaStatus = match ($status) {

                                            'Diverifikasi' => 'success',

                                            'Diproses' => 'warning',

                                            'Selesai' => 'primary',

                                            'Ditolak' => 'danger',

                                            default => 'secondary'

                                        };


                                        $labelStatus = match ($status) {

                                            'Diverifikasi' =>
                                            'Diverifikasi Admin BNNK',

                                            'Diproses' =>
                                            'Sedang Diproses Lapangan',

                                            'Selesai' =>
                                            'Selesai / Diteruskan BNNK',

                                            'Ditolak' =>
                                            'Pengaduan Ditolak',

                                            default =>
                                            'Belum Diproses'

                                        };

                                    @endphp



                                    <span class="badge bg-{{ $warnaStatus }} px-3 py-2">

                                        <i class="bi 
                        @if($status == 'Diverifikasi')
                            bi-check-circle
                        @elseif($status == 'Diproses')
                            bi-hourglass-split
                        @elseif($status == 'Selesai')
                            bi-check-all
                        @elseif($status == 'Ditolak')
                            bi-x-circle
                        @else
                            bi-clock
                        @endif
                    me-1">
                                        </i>


                                        {{ $labelStatus }}


                                    </span>


                                </div>

                            </div>


                            {{-- TOPIK --}}

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



                            {{-- KECAMATAN --}}

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



                            {{-- TANGGAL PENANGANAN --}}

                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Tanggal Penanganan
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>

                                <div class="detail-value">

                                    @if($tanggal)

                                        {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y H:i') }}

                                    @else

                                        -

                                    @endif

                                </div>

                            </div>



                            {{-- ADMIN --}}

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


                                <div class="border rounded-3 bg-light p-3">

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
    document.getElementById('bukti').addEventListener('change', function (e) {

        const file = e.target.files[0];
        const preview = document.getElementById('previewBukti');

        if (file) {

            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';

        } else {

            preview.style.display = 'none';

        }

    });
</script>