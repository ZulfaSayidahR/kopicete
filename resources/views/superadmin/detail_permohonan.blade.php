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

                    {{-- Informasi --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">
                            <h3>Informasi Permohonan</h3>
                        </div>

                        <div class="p-4">

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <strong>Kode Permohonan</strong>
                                    <p>PMH-001</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Jenis Permohonan</strong>
                                    <p>Permohonan Rehabilitasi</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Nama Pemohon</strong>
                                    <p>Ahmad Fauzi</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>No. Telepon</strong>
                                    <p>085612345678</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Email</strong>
                                    <p>ahmad@gmail.com</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Tanggal Permohonan</strong>
                                    <p>16 Juli 2026</p>
                                </div>

                            </div>

                            <hr>

                            <strong>Tujuan Permohonan</strong>

                            <p>

                                Pemohon mengajukan permohonan rehabilitasi bagi anggota keluarga
                                yang diduga mengalami ketergantungan narkotika agar mendapatkan
                                penanganan dan pendampingan dari BNNK Tulungagung.

                            </p>

                        </div>

                    </div>


                    {{-- Lampiran --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">
                            <h3>Lampiran Dokumen</h3>
                        </div>

                        <div class="p-4 text-center">

                            <img src="{{ asset('images/contoh.jpg') }}" class="img-fluid rounded shadow-sm"
                                style="max-height:350px;">

                            <p class="mt-3 text-muted">

                                Dokumen Pendukung / Surat Permohonan

                            </p>

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

                                <!-- Permohonan Diajukan -->
                                <div class="admin-tracking-item selesai">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-check-lg"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>Permohonan Diajukan</h6>

                                        <small>
                                            <i class="bi bi-calendar-event me-1"></i>
                                            16 Juli 2026 • 09:30 WIB
                                        </small>

                                        <button type="button" class="btn-detail-admin mt-2" data-bs-toggle="modal"
                                            data-bs-target="#detailPermohonanModal">

                                            <i class="bi bi-eye-fill me-1"></i>
                                            Lihat Bukti & Catatan

                                        </button>

                                    </div>

                                </div>

                                <!-- Diverifikasi -->
                                <div class="admin-tracking-item selesai">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-check-lg"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>Diverifikasi Admin BNNK</h6>

                                        <small>
                                            <i class="bi bi-calendar-event me-1"></i>
                                            16 Juli 2026 • 10:45 WIB
                                        </small>

                                        <button type="button" class="btn-detail-admin mt-2" data-bs-toggle="modal"
                                            data-bs-target="#detailPermohonanModal">

                                            <i class="bi bi-eye-fill me-1"></i>
                                            Lihat Bukti & Catatan

                                        </button>

                                    </div>

                                </div>

                                <!-- Diproses -->
                                <div class="admin-tracking-item proses">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-hourglass-split"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>Diproses Bidang Rehabilitasi</h6>

                                        <small>
                                            <i class="bi bi-calendar-event me-1"></i>
                                            Sedang Diproses
                                        </small>

                                        <button type="button" class="btn-detail-admin mt-2" data-bs-toggle="modal"
                                            data-bs-target="#detailPermohonanModal">

                                            <i class="bi bi-eye-fill me-1"></i>
                                            Lihat Bukti & Catatan

                                        </button>

                                    </div>

                                </div>

                                <!-- Selesai -->
                                <div class="admin-tracking-item pending">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-flag"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>Permohonan Selesai</h6>

                                        <small>
                                            <i class="bi bi-calendar-event me-1"></i>
                                            Menunggu
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

                            <form action="{{ route('superadmin.detail_permohonan.update') }}" method="POST">

                                @csrf

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