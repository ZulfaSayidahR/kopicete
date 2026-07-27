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

                                <span class="badge bg-success">
                                    Diverifikasi
                                </span>

                            </div>

                            <div class="info-grid">

                                <div>

                                    <strong>
                                        <i class="bi bi-upc-scan"></i>
                                        Kode Aduan
                                    </strong>

                                    <p>P0001</p>

                                </div>

                                <div>

                                    <strong>
                                        <i class="bi bi-geo-alt-fill"></i>
                                        Kecamatan
                                    </strong>

                                    <p>Tulungagung</p>

                                </div>

                                <div>

                                    <strong>
                                        <i class="bi bi-tags-fill"></i>
                                        Topik Aduan
                                    </strong>

                                    <p>
                                        Penyalahgunaan dan
                                        Peredaran Gelap Narkotika
                                    </p>

                                </div>

                                <div>

                                    <strong>
                                        <i class="bi bi-whatsapp"></i>
                                        No WhatsApp
                                    </strong>

                                    <p>089********</p>

                                </div>

                            </div>

                            <div class="kronologi">

                                <h6>

                                    <i class="bi bi-file-text-fill"></i>

                                    Kronologi

                                </h6>

                                <div class="kronologi-box">

                                    Pada tanggal 5 Juli 2026 sekitar pukul
                                    21.30 WIB saya melihat aktivitas
                                    mencurigakan di sekitar Terminal
                                    Gayatri Tulungagung yang diduga
                                    berkaitan dengan penyalahgunaan
                                    narkotika.

                                </div>

                            </div>

                        </div>

                        <!-- LAMPIRAN -->

                        <div class="tracking-card">

                            <h5>

                                <i class="bi bi-paperclip"></i>

                                Lampiran Bukti

                            </h5>

                            <div class="lampiran">

                                <div class="lampiran-item">

                                    <i class="bi bi-folder-fill"></i>

                                </div>

                                <div class="lampiran-item">

                                    <i class="bi bi-image-fill"></i>

                                </div>

                                <div class="lampiran-item">

                                    <i class="bi bi-camera-fill"></i>

                                </div>

                            </div>

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

                            <!-- =========================
                 DIAJUKAN
            ========================== -->
                            <div class="tracking-item selesai">

                                <div class="tracking-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>

                                <div class="tracking-content">

                                    <h6>Diajukan</h6>

                                    <small>
                                        <i class="bi bi-calendar-event me-1"></i>
                                        05 Juli 2026
                                    </small>

                                </div>

                            </div>

                            <!-- =========================
                 DIVERIFIKASI
            ========================== -->
                            <div class="tracking-item selesai">

                                <div class="tracking-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>

                                <div class="tracking-content">

                                    <h6>Diverifikasi Admin BNNK</h6>

                                    <small>
                                        <i class="bi bi-calendar-event me-1"></i>
                                        06 Juli 2026
                                    </small>

                                    <button type="button" class="btn-detail-admin" data-bs-toggle="modal"
                                        data-bs-target="#detailLaporanModal">

                                        <i class="bi bi-eye-fill"></i>
                                        Lihat Bukti & Catatan

                                    </button>

                                </div>

                            </div>

                            <!-- =========================
                 DITINDAKLANJUTI
            ========================== -->
                            <div class="tracking-item proses">

                                <div class="tracking-icon">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>

                                <div class="tracking-content">

                                    <h6>Ditindaklanjuti BNNK</h6>

                                    <small>
                                        <i class="bi bi-calendar-event me-1"></i>
                                        10 Juli 2026
                                    </small>

                                    <button type="button" class="btn-detail-admin" data-bs-toggle="modal"
                                        data-bs-target="#detailLaporanModal">

                                        <i class="bi bi-eye-fill"></i>
                                        Lihat Bukti & Catatan

                                    </button>

                                </div>

                            </div>

                            <!-- =========================
                 SELESAI
            ========================== -->
                            <div class="tracking-item selesai">

                                <div class="tracking-icon">
                                    <i class="bi bi-flag-fill"></i>
                                </div>

                                <div class="tracking-content">

                                    <h6>Selesai</h6>

                                    <small>
                                        <i class="bi bi-calendar-event me-1"></i>
                                        15 Juli 2026
                                    </small>

                                    <button type="button" class="btn-detail-admin" data-bs-toggle="modal"
                                        data-bs-target="#detailLaporanModal">

                                        <i class="bi bi-eye-fill"></i>
                                        Lihat Bukti & Catatan

                                    </button>

                                </div>

                            </div>

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

    <!-- Modal Bukti & Catatan -->
    <div class="modal fade" id="detailLaporanModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content shadow">

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-folder2-open me-2"></i>

                        Detail Tindak Lanjut Aduan

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row g-4">

                        <!-- Foto -->
                        <div class="col-md-5">

                            <img src="{{ asset('images/bukti-default.jpg') }}" class="img-fluid rounded shadow-sm border"
                                alt="Bukti">

                        </div>

                        <!-- Informasi -->
                        <div class="col-md-7">

                            <h4 class="fw-bold">

                                Dugaan Penyalahgunaan Narkotika

                            </h4>

                            <hr>

                            <p>

                                <strong>Status :</strong>

                                <span class="badge bg-warning text-dark">

                                    Diverifikasi

                                </span>

                            </p>

                            <p>

                                <strong>Admin :</strong>

                                Admin BNNK Tulungagung

                            </p>

                            <p>

                                <strong>Tanggal Penanganan :</strong>

                                10 Juli 2026

                            </p>

                            <div class="mt-3">

                                <label class="fw-bold mb-2">

                                    Catatan Admin

                                </label>

                                <div class="border rounded p-3 bg-light">

                                    Tim telah melakukan verifikasi awal
                                    terhadap laporan yang diterima.
                                    Saat ini laporan sedang dalam proses
                                    pendalaman informasi sebelum dilakukan
                                    tindak lanjut lapangan.

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