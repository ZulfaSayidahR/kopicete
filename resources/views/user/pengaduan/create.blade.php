@extends('layouts.app')

@section('title', 'Portal Pengaduan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-wrapper">

                <!-- ==========================================
                                                            FORM PENGADUAN
                                                    =========================================== -->

                <div class="pengaduan-card">

                    <div class="pengaduan-header">

                        <h4>Form Pengaduan</h4>

                        <p>
                            Sampaikan keluhan atau laporan Anda dengan lengkap.
                        </p>

                    </div>

                    <div class="pengaduan-body">

                        <!-- STEP -->

                        <div class="stepper">

                            <div class="step active">

                                <div class="step-number">1</div>

                                <div class="step-title">
                                    Data Aduan
                                </div>

                            </div>

                            <div class="step">

                                <div class="step-number">2</div>

                                <div class="step-title">
                                    Lokasi
                                </div>

                            </div>

                            <div class="step">

                                <div class="step-number">3</div>

                                <div class="step-title">
                                    Data Pelapor
                                </div>

                            </div>

                            <div class="step">

                                <div class="step-number">4</div>

                                <div class="step-title">
                                    Konfirmasi
                                </div>

                            </div>

                        </div>

                        <!-- FORM -->

                        <form>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Judul Aduan
                                    </label>

                                    <input type="text" class="form-control" placeholder="Ringkasan masalah">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Topik Aduan
                                    </label>

                                    <select class="form-select">

                                        <option>Pilih kategori</option>

                                        <option>Aduan Penyalahgunaan Narkoba dan Peredaran Gelap Narkotika</option>

                                        <option>Aduan Pelanggaran Grativikasi (WBS) </option>

                                    </select>

                                </div>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Detail Aduan
                                </label>

                                <textarea class="form-control" placeholder="Jelaskan kronologi kejadian..."></textarea>

                                <div class="form-note">

                                    Semakin lengkap informasi yang diberikan,
                                    semakin mudah laporan diproses.

                                </div>

                            </div>

                            <div class="form-navigation">

                                <a href="{{ route('home') }}" class="btn-prev">
                                    Sebelumnya
                                </a>

                                <a href="{{ route('pengaduan.lokasi') }}" class="btn-next">
                                    Selanjutnya
                                </a>


                            </div>

                        </form>

                    </div>

                </div>

                <!-- ==========================================
                                                            SIDEBAR
                                                    =========================================== -->

                <aside class="sidebar-aduan">

                    <div class="sidebar-header">

                        <h5>Aduan Terbaru</h5>

                        <button class="btn-sidebar">

                            <i class="bi bi-search"></i>

                            Jelajah

                        </button>

                    </div>

                    <div class="aduan-item">

                        <span class="status verifikasi">
                            Verifikasi
                        </span>

                        <h6>
                            Dugaan Penyalahgunaan Narkotika
                        </h6>

                        <small>

                            <i class="bi bi-geo-alt-fill"></i>

                            Terminal Gayatri

                        </small>
                        <small>
    <i class="bi bi-calendar-event-fill"></i>
    09 Juli 2026
</small>

<button
    class="btn-detail-laporan"
    data-bs-toggle="modal"
    data-bs-target="#detailLaporanModal">

    <i class="bi bi-eye-fill"></i>
    Lihat Detail

</button>

                    </div>

                    <div class="aduan-item">

                        <span class="status selesai">
                            Selesai
                        </span>

                        <h6>
                            Dugaan Peredaran Gelap
                        </h6>

                        <small>

                            <i class="bi bi-geo-alt-fill"></i>

                            Kecamatan Campurdarat

                        </small>
                        <small>
                            <i class="bi bi-calendar-event-fill"></i>
                            01 Juli 2026
                        </small>

                    </div>

                    <div class="aduan-item">

                        <span class="status proses">
                            Diproses
                        </span>

                        <h6>
                            Dugaan Penyalahgunaan
                        </h6>

                        <small>

                            <small>
                                <i class="bi bi-geo-alt-fill"></i>
                                Kecamatan Bandung
                            </small>

                            <small>
                                <i class="bi bi-calendar-event-fill"></i>
                                09 Juli 2026
                            </small>

                        </small>

                    </div>

                </aside>

                <!-- Modal Detail Aduan -->
<div class="modal fade"
     id="detailLaporanModal"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Detail Tindak Lanjut Aduan
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <!-- Gambar -->
                    <div class="col-md-5">

                        <img
                            src="{{ asset('images/bukti-default.jpg') }}"
                            class="img-fluid rounded shadow"
                            alt="Bukti">

                    </div>

                    <!-- Informasi -->
                    <div class="col-md-7">

                        <h5>
                            Dugaan Penyalahgunaan Narkotika
                        </h5>

                        <hr>

                        <p>

                            <strong>Status :</strong>

                            <span class="badge bg-warning text-dark">

                                Verifikasi

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

                        <label class="fw-bold">

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

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>
            </div>

        </div>

    </section>

@endsection