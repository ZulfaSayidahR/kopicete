@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')

    <section class="sa-dashboard" id="superAdminDashboard">

        {{-- =========================================================
        | SIDEBAR
        ========================================================== --}}
        @include('layouts.sidebar_admin_pengaduan')


        <main class="sa-main">

            {{-- =========================================================
            | HEADER
            ========================================================== --}}
            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button type="button" class="sa-toggle-sidebar" id="toggleSidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="sa-page-heading">

                        <h1>
                            Detail Pengaduan
                        </h1>

                        <p>
                            Informasi lengkap dan tindak lanjut pengaduan masyarakat.
                        </p>

                    </div>

                </div>

            </header>


            {{-- =========================================================
            | ALERT SUCCESS
            ========================================================== --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show mt-4">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                </div>

            @endif


            {{-- =========================================================
            | ALERT ERROR
            ========================================================== --}}
            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show mt-4">

                    <i class="bi bi-exclamation-triangle-fill me-2"></i>

                    {{ session('error') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                </div>

            @endif


            {{-- =========================================================
            | VALIDATION ERROR
            ========================================================== --}}
            @if($errors->any())

                <div class="alert alert-danger mt-4">

                    <strong>
                        Terjadi kesalahan:
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="row mt-4">


                {{-- =====================================================
                | KOLOM KIRI
                ====================================================== --}}
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

                                            $status = $pengaduan->status ?? 'Diajukan';

                                            $statusClass = match ($status) {

                                                'Diajukan',
                                                'Menunggu',
                                                'Menunggu Verifikasi'
                                                => 'bg-secondary',

                                                'Diverifikasi'
                                                => 'bg-primary',

                                                'Diproses',
                                                'Diproses Lapangan'
                                                => 'bg-warning text-dark',

                                                'Selesai'
                                                => 'bg-success',

                                                'Ditolak'
                                                => 'bg-danger',

                                                default
                                                => 'bg-secondary',

                                            };

                                        @endphp


                                        <span class="badge {{ $statusClass }} px-3 py-2">

                                            {{ $status }}

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



                    {{-- =================================================
                    | LAMPIRAN
                    ================================================== --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">

                            <h3>
                                Lampiran Bukti
                            </h3>

                        </div>


                        <div class="p-4 text-center">

                            @if($pengaduan->lampiran)

                                <img src="{{ asset('storage/' . $pengaduan->lampiran) }}" class="img-fluid rounded shadow"
                                    style="max-height:500px; object-fit:contain;" alt="Lampiran Pengaduan">


                                <div class="mt-3">

                                    <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" target="_blank"
                                        class="btn btn-primary">

                                        <i class="bi bi-eye-fill me-1"></i>

                                        Lihat Lampiran

                                    </a>

                                </div>

                            @else

                                <div class="alert alert-warning mb-0">

                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>

                                    Tidak ada lampiran yang diunggah.

                                </div>

                            @endif

                        </div>

                    </div>

                </div>



                {{-- =====================================================
                | KOLOM KANAN
                ====================================================== --}}
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


                                            @if($pengaduan->foto_verifikasi)

                                                <div class="mt-2">

                                                    <button type="button" class="btn-detail-admin" data-bs-toggle="modal"
                                                        data-bs-target="#detailAdminModal">

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


                                            @if($pengaduan->foto_proses)

                                                <div class="mt-2">

                                                    <button type="button" class="btn-detail-admin" data-bs-toggle="modal"
                                                        data-bs-target="#detailAdminModal">

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


                                            @if($pengaduan->foto_selesai)

                                                <div class="mt-2">

                                                    <button type="button" class="btn-detail-admin" data-bs-toggle="modal"
                                                        data-bs-target="#detailAdminModal">

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


                    {{-- =================================================
                    | FORM UPDATE
                    ================================================== --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">

                            <h3>
                                Verifikasi Pengaduan
                            </h3>

                        </div>

                        <div class="p-4">

                            <form action="{{ route('adminpengaduan.update_pengaduan', $pengaduan->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')


                                {{-- =================================================
                                | STATUS
                                ================================================== --}}
                                <div class="mb-3">

                                    <label for="status" class="form-label fw-semibold">
                                        Status Pengaduan
                                    </label>

                                    <select name="status" id="status" class="form-select" required>

                                        {{-- =========================================
                                        STATUS SAAT INI : DIAJUKAN
                                        ========================================== --}}
                                        @if($pengaduan->status === 'Diajukan')

                                            <option value="Diverifikasi">
                                                Diverifikasi
                                            </option>

                                            <option value="Ditolak">
                                                Ditolak
                                            </option>


                                            {{-- =========================================
                                            STATUS SAAT INI : DIVERIFIKASI
                                            ========================================== --}}
                                        @elseif($pengaduan->status === 'Diverifikasi')

                                            <option value="Diproses">
                                                Diproses
                                            </option>

                                            <option value="Ditolak">
                                                Ditolak
                                            </option>


                                            {{-- =========================================
                                            STATUS SAAT INI : DIPROSES
                                            ========================================== --}}
                                        @elseif($pengaduan->status === 'Diproses')

                                            <option value="Selesai">
                                                Selesai
                                            </option>


                                            {{-- =========================================
                                            STATUS SAAT INI : SELESAI
                                            ========================================== --}}
                                        @elseif($pengaduan->status === 'Selesai')

                                            <option value="Selesai" selected>
                                                Selesai
                                            </option>


                                            {{-- =========================================
                                            STATUS SAAT INI : DITOLAK
                                            ========================================== --}}
                                        @elseif($pengaduan->status === 'Ditolak')

                                            <option value="Ditolak" selected>
                                                Ditolak
                                            </option>

                                        @endif

                                    </select>

                                    @error('status')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- =================================================
                                | CATATAN
                                ================================================== --}}
                                <div class="mb-3">

                                    <label for="catatan" class="form-label fw-semibold">
                                        Catatan Admin
                                    </label>

                                    <textarea name="catatan" id="catatan" class="form-control" rows="4"
                                        placeholder="Masukkan catatan tindak lanjut...">{{ old('catatan') }}</textarea>

                                    @error('catatan')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- =================================================
                                | BUKTI
                                ================================================== --}}
                                <div class="mb-4">

                                    <label for="bukti" class="form-label fw-semibold">
                                        Upload Bukti Tindak Lanjut
                                    </label>

                                    <input type="file" name="bukti" id="bukti" class="form-control"
                                        accept=".jpg,.jpeg,.png">

                                    <small class="text-muted">
                                        JPG, JPEG, PNG maksimal 2 MB.
                                    </small>

                                    @error('bukti')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror


                                    {{-- PREVIEW --}}
                                    <div class="mt-3">

                                        <img id="previewBukti" src="#" class="img-fluid rounded shadow"
                                            style="display:none; max-height:250px;" alt="Preview Bukti">

                                    </div>

                                </div>


                                {{-- =================================================
                                | BUTTON
                                ================================================== --}}
                                @if(
                                        $pengaduan->status !== 'Selesai' &&
                                        $pengaduan->status !== 'Ditolak'
                                    )

                                    <div class="d-grid">

                                        <button type="submit" class="btn btn-primary">

                                            <i class="bi bi-check-circle-fill me-1"></i>

                                            Simpan Perubahan

                                        </button>

                                    </div>

                                @else

                                    <div class="alert alert-secondary mb-0">

                                        <i class="bi bi-lock-fill me-1"></i>

                                        Status pengaduan sudah
                                        <strong>{{ $pengaduan->status }}</strong>
                                        dan tidak dapat diubah kembali.

                                    </div>

                                @endif

                            </form>

                        </div>

                    </div>
                </div>

            </div>

        </main>

    </section>



    {{-- =========================================================
    | MODAL DETAIL TINDAK LANJUT
    ========================================================= --}}

    @php

        $foto = null;
        $catatan = null;
        $tanggal = null;
        $statusClass = 'bg-secondary';

        if ($pengaduan->status == 'Diverifikasi') {

            $foto = $pengaduan->foto_verifikasi;
            $catatan = $pengaduan->catatan_verifikasi;
            $tanggal = $pengaduan->tanggal_verifikasi;
            $statusClass = 'bg-primary';

        } elseif ($pengaduan->status == 'Diproses') {

            $foto = $pengaduan->foto_proses;
            $catatan = $pengaduan->catatan_proses;
            $tanggal = $pengaduan->tanggal_proses;
            $statusClass = 'bg-warning text-dark';

        } elseif ($pengaduan->status == 'Selesai') {

            $foto = $pengaduan->foto_selesai;
            $catatan = $pengaduan->catatan_selesai;
            $tanggal = $pengaduan->tanggal_selesai;
            $statusClass = 'bg-success';

        } elseif ($pengaduan->status == 'Ditolak') {

            $foto = $pengaduan->foto_verifikasi;
            $catatan = $pengaduan->catatan_verifikasi;
            $tanggal = $pengaduan->tanggal_verifikasi;
            $statusClass = 'bg-danger';

        }

    @endphp


    {{-- =========================================================
    MODAL DETAIL TINDAK LANJUT
    ========================================================= --}}

    <div class="modal fade" id="detailAdminModal" tabindex="-1" aria-labelledby="detailAdminModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg rounded-4">


                {{-- =====================================================
                HEADER
                ====================================================== --}}

                <div class="modal-header
                                            {{ $statusClass }}">

                    <h5 class="modal-title fw-bold
                                                @if($statusClass != 'bg-warning text-dark')
                                                    text-white
                                                @endif" id="detailAdminModalLabel">

                        <i class="bi bi-file-earmark-medical me-2"></i>

                        Detail Tindak Lanjut Aduan

                    </h5>


                    <button type="button" class="btn-close
                                                        @if($statusClass != 'bg-warning text-dark')
                                                            btn-close-white
                                                        @endif" data-bs-dismiss="modal" aria-label="Close">
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
                                        class="img-fluid rounded-3 shadow-sm border" style="
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

                                <div class="border rounded-3 bg-light
                                                                            d-flex flex-column
                                                                            justify-content-center
                                                                            align-items-center
                                                                            text-muted" style="height: 300px;">

                                    <i class="bi bi-image" style="font-size: 60px;"></i>

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

                                    <span class="badge
                                                                {{ $statusClass }}
                                                                px-3 py-2">

                                        {{ $pengaduan->status }}

                                    </span>

                                </div>

                            </div>



                            {{-- =================================================
                            TOPIK ADUAN
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
                            TANGGAL PENANGANAN
                            ================================================== --}}

                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Tanggal Penanganan
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>

                                <div class="detail-value">

                                    @if($tanggal)

                                                                {{ \Carbon\Carbon::parse($tanggal)
                                        ->locale('id')
                                        ->translatedFormat('d F Y H:i') }}

                                    @else

                                        -

                                    @endif

                                </div>

                            </div>



                            {{-- =================================================
                            ADMIN / PETUGAS
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



{{-- =========================================================
| PREVIEW FOTO
========================================================= --}}

@push('scripts')

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const input = document.getElementById('bukti');

            const preview = document.getElementById('previewBukti');


            if (input && preview) {

                input.addEventListener('change', function (event) {

                    const file = event.target.files[0];


                    if (file) {

                        preview.src = URL.createObjectURL(file);

                        preview.style.display = 'block';

                    } else {

                        preview.src = '#';

                        preview.style.display = 'none';

                    }

                });

            }

        });

    </script>

@endpush