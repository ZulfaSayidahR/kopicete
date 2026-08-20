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


                    {{-- =================================================
                    | RIWAYAT STATUS
                    ================================================== --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">

                            <h3>

                                <i class="bi bi-clock-history me-2"></i>

                                Riwayat Status

                            </h3>

                        </div>


                        <div class="p-4">

                            <div class="admin-tracking-timeline">


                                {{-- =================================================
                                | 1. DIAJUKAN
                                ================================================== --}}
                                <div class="admin-tracking-item selesai">

                                    <div class="admin-tracking-icon">

                                        <i class="bi bi-check-lg"></i>

                                    </div>


                                    <div class="admin-tracking-content">

                                        <h6>
                                            Pengaduan Diajukan
                                        </h6>

                                        <small>

                                            <i class="bi bi-calendar-event me-1"></i>

                                            @if($pengaduan->created_at)

                                                {{ $pengaduan->created_at->translatedFormat('d F Y H:i') }}
                                                WIB

                                            @else

                                                -

                                            @endif

                                        </small>

                                    </div>

                                </div>



                                {{-- =================================================
                                | 2. VERIFIKASI
                                ================================================== --}}
                                <div class="admin-tracking-item
                                                    {{ $pengaduan->tanggal_verifikasi ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">

                                        @if($pengaduan->tanggal_verifikasi)

                                            <i class="bi bi-check-lg"></i>

                                        @else

                                            <i class="bi bi-circle"></i>

                                        @endif

                                    </div>


                                    <div class="admin-tracking-content">

                                        <h6>
                                            Diverifikasi Admin
                                        </h6>


                                        @if($pengaduan->tanggal_verifikasi)

                                            <small>

                                                <i class="bi bi-calendar-event me-1"></i>

                                                {{ \Carbon\Carbon::parse($pengaduan->tanggal_verifikasi)->translatedFormat('d F Y H:i') }}

                                                WIB

                                            </small>


                                            <div class="mt-2">

                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#detailAdminModal">

                                                    <i class="bi bi-eye-fill me-1"></i>

                                                    Lihat Detail

                                                </button>

                                            </div>

                                        @else

                                            <small class="text-muted">

                                                Menunggu verifikasi.

                                            </small>

                                        @endif

                                    </div>

                                </div>



                                {{-- =================================================
                                | 3. DIPROSES
                                ================================================== --}}
                                <div class="admin-tracking-item
                                                    {{ $pengaduan->tanggal_proses ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">

                                        @if($pengaduan->tanggal_proses)

                                            <i class="bi bi-check-lg"></i>

                                        @else

                                            <i class="bi bi-hourglass-split"></i>

                                        @endif

                                    </div>


                                    <div class="admin-tracking-content">

                                        <h6>
                                            Diproses Lapangan
                                        </h6>


                                        @if($pengaduan->tanggal_proses)

                                            <small>

                                                <i class="bi bi-calendar-event me-1"></i>

                                                {{ \Carbon\Carbon::parse($pengaduan->tanggal_proses)->translatedFormat('d F Y H:i') }}

                                                WIB

                                            </small>


                                            <div class="mt-2">

                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#detailAdminModal">

                                                    <i class="bi bi-eye-fill me-1"></i>

                                                    Lihat Detail

                                                </button>

                                            </div>

                                        @else

                                            <small class="text-muted">

                                                Menunggu proses lapangan.

                                            </small>

                                        @endif

                                    </div>

                                </div>



                                {{-- =================================================
                                | 4. SELESAI
                                ================================================== --}}
                                <div class="admin-tracking-item
                                                    {{ $pengaduan->tanggal_selesai ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">

                                        @if($pengaduan->tanggal_selesai)

                                            <i class="bi bi-check-lg"></i>

                                        @else

                                            <i class="bi bi-flag"></i>

                                        @endif

                                    </div>


                                    <div class="admin-tracking-content">

                                        <h6>
                                            Selesai
                                        </h6>


                                        @if($pengaduan->tanggal_selesai)

                                            <small>

                                                <i class="bi bi-calendar-event me-1"></i>

                                                {{ \Carbon\Carbon::parse($pengaduan->tanggal_selesai)->translatedFormat('d F Y H:i') }}

                                                WIB

                                            </small>


                                            <div class="mt-2">

                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#detailAdminModal">

                                                    <i class="bi bi-eye-fill me-1"></i>

                                                    Lihat Detail

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
                                            Selesai / Diteruskan BNNK
                                        </option>

                                        <option value="Ditolak" {{ $pengaduan->status == 'Ditolak' ? 'selected' : '' }}>
                                            Ditolak
                                        </option>

                                    </select>

                                    @error('status')

                                        <div class="text-danger small mt-1">

                                            {{ $message }}

                                        </div>

                                    @enderror

                                </div>



                                {{-- CATATAN --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        Catatan Admin

                                    </label>


                                    <textarea name="catatan" class="form-control" rows="4"
                                        placeholder="Masukkan catatan tindak lanjut...">{{ old('catatan') }}</textarea>


                                    @error('catatan')

                                        <div class="text-danger small mt-1">

                                            {{ $message }}

                                        </div>

                                    @enderror

                                </div>



                                {{-- BUKTI --}}
                                <div class="mb-4">

                                    <label class="form-label fw-semibold">

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



                                {{-- BUTTON --}}
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


    <div class="modal fade" id="detailAdminModal" tabindex="-1" aria-labelledby="detailAdminModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg rounded-4">


                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="modal-title fw-bold" id="detailAdminModalLabel">

                        <i class="bi bi-file-earmark-medical me-2"></i>

                        Detail Tindak Lanjut Aduan

                    </h5>


                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>



                {{-- BODY --}}
                <div class="modal-body p-4">

                    <div class="row g-4">


                        {{-- FOTO --}}
                        <div class="col-md-5">

                            @if($foto)

                                <img src="{{ asset('storage/' . $foto) }}" class="img-fluid rounded-3 shadow-sm border w-100"
                                    style="max-height:350px; object-fit:cover;" alt="Bukti Tindak Lanjut">

                            @else

                                <div class="alert alert-warning text-center">

                                    <i class="bi bi-image"></i>

                                    <br>

                                    Belum ada bukti yang diunggah.

                                </div>

                            @endif

                        </div>



                        {{-- INFORMASI --}}
                        <div class="col-md-7">

                            <h4 class="fw-bold mb-3">

                                {{ $pengaduan->judul_aduan }}

                            </h4>


                            <hr>


                            {{-- STATUS --}}
                            <p class="mb-3">

                                <strong>
                                    Status :
                                </strong>


                                <span class="badge {{ $statusClass }} px-3 py-2">

                                    {{ $pengaduan->status }}

                                </span>

                            </p>



                            {{-- KODE --}}
                            <p class="mb-3">

                                <strong>
                                    Kode Aduan :
                                </strong>

                                {{ $pengaduan->kode_aduan }}

                            </p>



                            {{-- PELAPOR --}}
                            <p class="mb-3">

                                <strong>
                                    Pelapor :
                                </strong>

                                {{ $pengaduan->nama_lengkap ?? 'Anonim' }}

                            </p>



                            {{-- TANGGAL --}}
                            <p class="mb-3">

                                <strong>Tanggal Update :</strong>

                                @if($tanggal)

                                                        {{ \Carbon\Carbon::parse($tanggal)
                                    ->locale('id')
                                    ->translatedFormat('d F Y') }}

                                                        •

                                                        {{ \Carbon\Carbon::parse($tanggal)
                                    ->format('H:i') }}

                                                        WIB

                                @else

                                    <span class="text-muted">
                                        Belum ada update.
                                    </span>

                                @endif

                            </p>


                            {{-- CATATAN --}}
                            <label class="fw-bold mb-2">

                                <i class="bi bi-journal-text me-1"></i>

                                Catatan Admin

                            </label>


                            <div class="border rounded-3 bg-light p-3">

                                @if($catatan)

                                    {!! nl2br(e($catatan)) !!}

                                @else

                                    <span class="text-muted">

                                        Belum ada catatan admin.

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>



                {{-- FOOTER --}}
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