@extends('layouts.admin')

@section('title', 'Detail Permohonan')

@section('content')

    <section class="sa-dashboard">

        @include('layouts.sidebar_admin_permohonan')

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

                    {{-- Informasi --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">
                            <h3>Informasi Permohonan</h3>
                        </div>

                        <div class="p-4">

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <strong>Kode Permohonan</strong>
                                    <p>{{ $permohonan->kode_permohonan }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Jenis Permohonan</strong>
                                    <p>{{ $permohonan->jenis_permohonan }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Nama Pemohon</strong>
                                    <p>{{ $permohonan->nama_penyelenggara }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Penanggung Jawab</strong>
                                    <p>{{ $permohonan->penanggung_jawab }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>No. Telepon</strong>
                                    <p>{{ $permohonan->no_hp }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Tanggal Permohonan</strong>
                                    <p>
                                        {{ \Carbon\Carbon::parse($permohonan->created_at)->translatedFormat('d F Y') }}
                                    </p>
                                </div>

                                @if(isset($permohonan->email))
                                    <div class="col-md-6 mb-3">
                                        <strong>Email</strong>
                                        <p>{{ $permohonan->email }}</p>
                                    </div>
                                @endif

                                <div class="col-md-6 mb-3">
                                    <strong>Tanggal Kegiatan</strong>
                                    <p>
                                        {{ \Carbon\Carbon::parse($permohonan->tanggal_kegiatan)->translatedFormat('d F Y') }}
                                    </p>
                                </div>

                            </div>

                            <hr>

                            <strong>Tujuan Permohonan</strong>

                            <p>
                                {{ $permohonan->keterangan }}
                            </p>

                        </div>

                    </div>


                    {{-- Lampiran --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">
                            <h3>Lampiran Dokumen</h3>
                        </div>

                        <div class="p-4 text-center">

                            @if($permohonan->lampiran)

                                <img src="{{ asset('storage/' . $permohonan->lampiran) }}" class="img-fluid rounded shadow-sm"
                                    style="max-height:350px;">

                                <p class="mt-3 text-muted">
                                    Dokumen Pendukung / Surat Permohonan
                                </p>

                            @else

                                <div class="alert alert-warning">
                                    Belum ada dokumen yang diunggah.
                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- ================= KANAN ================= --}}
                <div class="col-lg-5">

                    {{-- Timeline --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">
                            <h3>
                                <i class="bi bi-clock-history me-2"></i>
                                Riwayat Status
                            </h3>
                        </div>

                        <div class="p-4">

                            <div class="admin-tracking-timeline">

                                {{-- DIAJUKAN --}}
                                <div class="admin-tracking-item selesai">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-check-lg"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>Permohonan Diajukan</h6>

                                        <small>
                                            <i class="bi bi-calendar-event me-1"></i>

                                            {{ \Carbon\Carbon::parse($permohonan->created_at)->translatedFormat('d F Y H:i') }}
                                            WIB
                                        </small>

                                    </div>

                                </div>

                                {{-- DIVERIFIKASI --}}
                                <div
                                    class="admin-tracking-item {{ $permohonan->tanggal_verifikasi ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-check-lg"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>Diverifikasi Admin BNNK</h6>

                                        <small>

                                            @if($permohonan->tanggal_verifikasi)

                                                <i class="bi bi-calendar-event me-1"></i>

                                                {{ \Carbon\Carbon::parse($permohonan->tanggal_verifikasi)->translatedFormat('d F Y H:i') }}
                                                WIB

                                            @else

                                                Menunggu Verifikasi

                                            @endif

                                        </small>

                                    </div>

                                </div>

                                {{-- DIPROSES --}}
                                <div class="admin-tracking-item {{ $permohonan->tanggal_proses ? 'proses' : 'pending' }}">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-hourglass-split"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>Diproses Bidang Rehabilitasi</h6>

                                        <small>

                                            @if($permohonan->tanggal_proses)

                                                <i class="bi bi-calendar-event me-1"></i>

                                                {{ \Carbon\Carbon::parse($permohonan->tanggal_proses)->translatedFormat('d F Y H:i') }}
                                                WIB

                                            @else

                                                Menunggu Proses

                                            @endif

                                        </small>

                                    </div>

                                </div>

                                {{-- SELESAI --}}
                                <div class="admin-tracking-item {{ $permohonan->tanggal_selesai ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-flag"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>Permohonan Selesai</h6>

                                        <small>

                                            @if($permohonan->tanggal_selesai)

                                                <i class="bi bi-calendar-event me-1"></i>

                                                {{ \Carbon\Carbon::parse($permohonan->tanggal_selesai)->translatedFormat('d F Y H:i') }}
                                                WIB

                                            @else

                                                Menunggu

                                            @endif

                                        </small>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Verifikasi --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">

                            <h3>Verifikasi Permohonan</h3>

                        </div>

                        <div class="p-4">

                            <form action="{{ route('adminpermohonan.update_permohonan', $permohonan->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="mb-3">

                                    <label class="form-label">

                                        Status Permohonan

                                    </label>

                                    <select class="form-select" name="status">

                                        <option>Menunggu Verifikasi</option>

                                        <option>Diverifikasi</option>

                                        <option>Diproses</option>

                                        <option>Ditolak</option>

                                        <option>Selesai</option>

                                    </select>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">

                                        Catatan Admin

                                    </label>

                                    <textarea class="form-control" rows="4" name="catatan"
                                        placeholder="Masukkan catatan verifikasi..."></textarea>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Upload Bukti Tindak Lanjut
                                    </label>

                                    <input type="file" name="bukti" id="bukti" class="form-control file-upload"
                                        accept="image/*">

                                    <small class="text-muted">
                                        Format: JPG, JPEG, PNG. Maksimal 2 MB.
                                    </small>

                                    {{-- Preview --}}
                                    <div class="mt-3">

                                        <img id="previewBukti" src="#" alt="Preview Bukti" class="img-fluid rounded shadow"
                                            style="display:none; max-height:250px;">

                                    </div>

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

@endsection