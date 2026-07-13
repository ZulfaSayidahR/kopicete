@extends('layouts.app')

@section('title', 'Detail Lacak Aduan')

@section('content')

    <section class="tracking-page">

        <div class="container">

            <!-- HEADER -->
            <div class="tracking-header">

                <div class="logo-box">

                    <img src="{{ asset('images/logo-bnn.png') }}" alt="Logo BNN">

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

                        <div class="timeline">

                            <div class="timeline-item selesai">

                                <span></span>

                                <h6>Diajukan</h6>

                                <small>05 Juli 2026</small>

                            </div>

                            <div class="timeline-item selesai">

                                <span></span>

                                <h6>Diverifikasi Admin BNNK</h6>

                                <small>06 Juli 2026</small>

                            </div>

                            <div class="timeline-item proses">

                                <span></span>

                                <h6>Ditindaklanjuti BNNK</h6>

                                <small>Menunggu Proses</small>

                            </div>

                            <div class="timeline-item proses">

                                <span></span>

                                <h6>Selesai</h6>

                                <small>Belum tersedia</small>

                            </div>

                        </div>

                        <div class="mt-auto pt-4">

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

@endsection