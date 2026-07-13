@extends('layouts.app')

@section('title', 'Portal Pengaduan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-wrapper">

                <!-- ==========================================
                        FORM STEP 3
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

                            <div class="step active">
                                <div class="step-number">
                                    3
                                </div>
                                <div class="step-title">
                                    Data Pribadi
                                </div>
                            </div>

                            <div class="step">
                                <div class="step-number">
                                    4
                                </div>
                                <div class="step-title">
                                    Konfirmasi
                                </div>
                            </div>

                        </div>

                        <!-- FORM -->

                        

                            @csrf

                            <div class="row">

                                <div class="col-md-12 mb-3">

                                    <label class="form-label">

                                        Nama Lengkap

                                    </label>

                                    <input type="text" name="nama" class="form-control"
                                        placeholder="Masukkan nama lengkap Anda">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Nomor WhatsApp

                                    </label>

                                    <input type="text" name="whatsapp" class="form-control" placeholder="08xxxxxxxxxx">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Email (Opsional)

                                    </label>

                                    <input type="email" name="email" class="form-control" placeholder="email@gmail.com">

                                </div>

                                <div class="col-md-12 mb-3">

                                    <label class="form-label">

                                        Alamat Domisili

                                    </label>

                                    <textarea name="alamat" rows="4" class="form-control"
                                        placeholder="Masukkan alamat lengkap"></textarea>

                                </div>

                            </div>

                            <div class="form-note">

                                <i class="bi bi-info-circle-fill"></i>

                                Data pribadi akan dijaga kerahasiaannya dan hanya
                                digunakan untuk proses verifikasi laporan.

                            </div>

                            <div class="form-navigation">

                                <a href="{{ route('pengaduan.lokasi') }}" class="btn-prev">

                                    Sebelumnya

                                </a>

                               <a href="{{ route('pengaduan.konfirmasi') }}" class="btn-next">

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
            </div>

        </div>

    </section>

@endsection