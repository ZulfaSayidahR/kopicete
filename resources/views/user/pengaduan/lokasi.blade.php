@extends('layouts.app')

@section('title', 'Portal Pengaduan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-wrapper">

                <!-- =========================================
                                FORM STEP 2
                        ========================================== -->

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
                                <div class="step-number">✓</div>
                                <div class="step-title">Data Aduan</div>
                            </div>

                            <div class="step active">
                                <div class="step-number">2</div>
                                <div class="step-title">Lokasi & Lampiran</div>
                            </div>

                            <div class="step">
                                <div class="step-number">3</div>
                                <div class="step-title">Data Pelapor</div>
                            </div>

                            <div class="step">
                                <div class="step-number">4</div>
                                <div class="step-title">Konfirmasi</div>
                            </div>

                        </div>

                        <form action="{{ route('pengaduan.lokasi') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">

                                    Alamat / Lokasi Lengkap

                                </label>

                                <input type="text" class="form-control" name="alamat"
                                    placeholder="Contoh : Jl. Raya BNN No.21 RT01/RW02">

                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Kecamatan

                                    </label>

                                    <select class="form-select" name="kecamatan">

                                        <option>Pilih Kecamatan</option>

                                        <option>Tulungagung</option>
                                        <option>Campurdarat</option>
                                        <option>Bandung</option>
                                        <option>Ngunut</option>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Desa

                                    </label>

                                    <input type="text" class="form-control" name="desa" placeholder="Masukkan Desa">

                                </div>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Lampiran Gambar

                                </label>

                                <input type="file" class="form-control" name="lampiran">

                                <div class="form-note">

                                    Maksimal 5MB.
                                    Format JPG, JPEG, PNG.

                                </div>

                            </div>

                            <div class="alert alert-warning">

                                <div class="form-check">

                                    <input class="form-check-input" type="checkbox" required>

                                    <label class="form-check-label">

                                        Saya menyatakan bahwa laporan ini benar
                                        dan dapat dipertanggungjawabkan.

                                    </label>

                                </div>

                            </div>

                            <div class="mb-4">

                                <label class="form-label">

                                    Verifikasi Keamanan

                                </label>

                                <div class="border rounded p-3">

                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" required>

                                        <label class="form-check-label">

                                            Saya bukan robot

                                        </label>

                                    </div>

                                </div>

                            </div>

                            <div class="form-navigation">

                                <a href="{{ route('pengaduan.create') }}" class="btn btn-secondary">

                                    Sebelumnya

                                </a>

                                <a href="{{ route('pengaduan.datapribadi') }}" class="btn-next">

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