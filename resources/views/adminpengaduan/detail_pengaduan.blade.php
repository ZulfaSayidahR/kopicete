@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')

    <section class="sa-dashboard" id="superAdminDashboard">

        @include('layouts.sidebar_admin_pengaduan')

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

                    {{-- Informasi --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">
                            <h3>Informasi Pengaduan</h3>
                        </div>

                        <div class="p-4">

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <strong>Token</strong>

                                    <p>PHGSHJBJ</p>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Kategori</strong>

                                    <p>Penyalahgunaan Narkoba</p>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Kecamatan</strong>

                                    <p>Campurdarat</p>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Tanggal</strong>

                                    <p>4 Juli 2026</p>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Nomor Pelapor</strong>

                                    <p>085612345678</p>

                                </div>

                            </div>

                            <hr>

                            <strong>Kronologi</strong>

                            <p>

                                Pelapor melihat aktivitas yang diduga
                                merupakan transaksi narkoba di sekitar
                                wilayah Campurdarat.

                            </p>

                        </div>

                    </div>



                    {{-- Lampiran --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">

                            <h3>Lampiran Bukti</h3>

                        </div>

                        <div class="p-4 text-center">

                            <img src="{{ asset('images/contoh.jpg') }}" class="img-fluid rounded">

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

                                <!-- Diajukan -->
                                <div class="admin-tracking-item selesai">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-check-lg"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>Diajukan</h6>

                                        <small>
                                            <i class="bi bi-calendar-event me-1"></i>
                                            04 Juli 2026 • 09:40 WIB
                                        </small>



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
                                            04 Juli 2026 • 11:15 WIB
                                        </small>

                                        <button type="button" class="btn-detail-admin mt-2" data-bs-toggle="modal"
                                            data-bs-target="#detailAdminModal">

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

                                        <h6>Diproses Lapangan</h6>

                                        <small>
                                            <i class="bi bi-calendar-event me-1"></i>
                                            05 Juli 2026 • 14:30 WIB
                                        </small>


                                        <button type="button" class="btn-detail-admin mt-2" data-bs-toggle="modal"
                                            data-bs-target="#detailAdminModal">

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

                                        <h6>Selesai / Diteruskan BNNK</h6>

                                        <small>Menunggu</small>
                                        <button type="button" class="btn-detail-admin mt-2" data-bs-toggle="modal"
                                            data-bs-target="#detailAdminModal">

                                            <i class="bi bi-eye-fill me-1"></i>
                                            Lihat Bukti & Catatan

                                        </button>

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

                            <form action="{{ route('adminpengaduan.update_pengaduan') }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                {{-- Status --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Status
                                    </label>

                                    <select class="form-select" name="status">

                                        <option value="Diajukan">Diajukan</option>
                                        <option value="Diverifikasi">Diverifikasi</option>
                                        <option value="Diproses Lapangan">Diproses Lapangan</option>
                                        <option value="Selesai">Selesai</option>

                                    </select>

                                </div>

                                {{-- Catatan --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Catatan Admin
                                    </label>

                                    <textarea class="form-control" name="catatan" rows="4"
                                        placeholder="Masukkan catatan hasil verifikasi..."></textarea>

                                </div>

                                {{-- Upload Bukti --}}
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
                         MODAL DETAIL TINDAK LANJUT ADMIN
                    ========================================== -->
    <div class="modal fade" id="detailAdminModal" tabindex="-1" aria-labelledby="detailAdminModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg rounded-4">

                <!-- Header -->
                <div class="modal-header">

                    <h5 class="modal-title fw-bold" id="detailAdminModalLabel">
                        <i class="bi bi-file-earmark-medical me-2"></i>
                        Detail Tindak Lanjut Aduan
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <!-- Body -->
                <div class="modal-body p-4">

                    <div class="row g-4 align-items-start">

                        <!-- Bukti -->
                        <div class="col-md-5">

                            <img src="{{ asset('images/bukti-default.jpg') }}" class="img-fluid rounded-3 shadow-sm border"
                                alt="Bukti Tindak Lanjut">

                        </div>

                        <!-- Informasi -->
                        <div class="col-md-7">

                            <h4 class="fw-bold mb-3">
                                Dugaan Penyalahgunaan Narkotika
                            </h4>

                            <hr>

                            <p class="mb-3">

                                <strong>Status :</strong>

                                <span class="badge bg-warning text-dark px-3 py-2">
                                    Diverifikasi
                                </span>

                            </p>

                            <p class="mb-3">

                                <strong>Petugas/Admin :</strong>

                                Admin BNNK Tulungagung

                            </p>

                            <p class="mb-3">

                                <strong>Tanggal Penanganan :</strong>

                                10 Juli 2026 • 10:35 WIB

                            </p>

                            <label class="fw-bold mb-2">

                                <i class="bi bi-journal-text me-1"></i>

                                Catatan Admin

                            </label>

                            <div class="border rounded-3 bg-light p-3">

                                Tim telah melakukan verifikasi awal terhadap
                                laporan yang diterima.

                                <br><br>

                                Berdasarkan hasil pemeriksaan sementara,
                                laporan dinyatakan valid dan akan diteruskan
                                ke tim lapangan untuk dilakukan pendalaman
                                informasi.

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