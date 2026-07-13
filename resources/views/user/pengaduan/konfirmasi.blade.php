@extends('layouts.app')

@section('title', 'Konfirmasi Pengaduan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-wrapper">

                <!-- ==========================================
                            FORM KONFIRMASI
                    =========================================== -->

                <div class="pengaduan-card">

                    <div class="pengaduan-header">

                        <h4>Form Pengaduan</h4>

                        <p>
                            Sampaikan keluhan atau saran Anda dengan lengkap.
                        </p>

                    </div>

                    <div class="pengaduan-body">

                        <!-- STEP -->

                        <div class="stepper">

                            <div class="step selesai">
                                <div class="step-number">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="step-title">
                                    Data Aduan
                                </div>
                            </div>

                            <div class="step selesai">
                                <div class="step-number">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="step-title">
                                    Lokasi & Lampiran
                                </div>
                            </div>

                            <div class="step selesai">
                                <div class="step-number">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="step-title">
                                    Data Pribadi
                                </div>
                            </div>

                            <div class="step active">
                                <div class="step-number">
                                    4
                                </div>
                                <div class="step-title">
                                    Konfirmasi
                                </div>
                            </div>

                        </div>

                        <!-- RINGKASAN -->

                        <div class="summary-card">

                            <div class="summary-header">

                                <i class="bi bi-clipboard-data"></i>

                                Ringkasan Aduan

                            </div>

                            <div class="summary-body">

                                <div class="row">

                                    <div class="col-md-7">

                                        <h6>Data Aduan</h6>

                                        <p>
                                            <strong>Judul :</strong>
                                            Dugaan Peredaran Narkotika di Sekitar Terminal
                                        </p>

                                        <p>
                                            <strong>Topik :</strong>
                                            Aduan Penyalahgunaan dan Peredaran Gelap Narkotika
                                        </p>

                                        <p>
                                            <strong>Lokasi :</strong>
                                            Terminal Gayatri, Tulungagung
                                        </p>

                                    </div>

                                    <div class="col-md-5">

                                        <h6>Data Pribadi</h6>

                                        <p>
                                            <strong>Nama :</strong>
                                            Supardi Supriyono
                                        </p>

                                        <p>
                                            <strong>No WhatsApp :</strong>
                                            089********
                                        </p>

                                    </div>

                                </div>

                                <div class="mt-4">

                                    <h6>Detail Aduan</h6>

                                    <div class="summary-detail">

                                        Pada tanggal 5 Juli 2026 sekitar pukul 21.30 WIB,
                                        saya melihat aktivitas yang mencurigakan di sekitar
                                        Terminal Gayatri, Tulungagung.

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- PERSETUJUAN -->

                        <div class="form-check mt-4">

                            <input class="form-check-input" type="checkbox" id="setuju">

                            <label class="form-check-label" for="setuju">

                                Saya setuju dengan syarat dan ketentuan
                                pengaduan BNNK Tulungagung.

                            </label>

                        </div>

                        <!-- BUTTON -->

                        <div class="form-navigation">

                            <a href="{{ route('pengaduan.datapribadi') }}" class="btn-prev">

                                Sebelumnya

                            </a>

                            <button type="submit" class="btn-next">

                                <i class="bi bi-send-fill"></i>

                                Daftar & Kirim Aduan

                            </button>

                        </div>

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

                        <h6>Dugaan Penyalahgunaan Narkotika</h6>

                        <small>
                            <i class="bi bi-geo-alt-fill"></i>
                            Terminal Gayatri
                        </small>

                        <small>
                            <i class="bi bi-calendar-event-fill"></i>
                            09 Juli 2026
                        </small>

                    </div>

                    <div class="aduan-item">

                        <span class="status selesai">
                            Selesai
                        </span>

                        <h6>Dugaan Peredaran Gelap</h6>

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

                        <h6>Dugaan Penyalahgunaan</h6>

                        <small>
                            <i class="bi bi-geo-alt-fill"></i>
                            Kecamatan Bandung
                        </small>

                        <small>
                            <i class="bi bi-calendar-event-fill"></i>
                            09 Juli 2026
                        </small>

                    </div>

                </aside>

            </div>

        </div>

    </section>

@endsection