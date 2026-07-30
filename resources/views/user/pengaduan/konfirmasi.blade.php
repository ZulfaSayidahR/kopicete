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

                        <!-- RINGKASAN -->

                        <div class="summary-card">


                            <div class="summary-header">

                                <i class="bi bi-clipboard-data"></i>

                                Ringkasan Aduan

                            </div>



                            <div class="summary-body">


                                <div class="row">


                                    <!-- DATA ADUAN -->

                                    <div class="col-md-7">


                                        <h6>
                                            Data Aduan
                                        </h6>


                                        <p>

                                            <strong>Judul :</strong>

                                            {{ $step1['judul_aduan'] ?? '-' }}

                                        </p>



                                        <p>

                                            <strong>Topik :</strong>

                                            {{ $step1['topik_aduan'] ?? '-' }}

                                        </p>



                                        <p>

                                            <strong>Isi Aduan :</strong>

                                        </p>


                                        <div class="summary-detail">

                                            {{ $step1['detail_aduan'] ?? '-' }}

                                        </div>
                                    </div>




                                    <!-- DATA PRIBADI -->

                                    <div class="col-md-5">


                                        <h6>
                                            Data Pribadi
                                        </h6>



                                        <p>

                                            <strong>Nama :</strong>

                                            {{ $step3['nama'] ?? '-' }}

                                        </p>



                                        <p>

                                            <strong>No WhatsApp :</strong>

                                            {{ $step3['whatsapp'] ?? '-' }}

                                        </p>



                                        <p>

                                            <strong>Email :</strong>

                                            {{ $step3['email'] ?? '-' }}

                                        </p>



                                        <p>

                                            <strong>Alamat :</strong>

                                            {{ $step3['alamat'] ?? '-' }}

                                        </p>


                                    </div>


                                </div>




                                <hr>




                                <!-- DATA LOKASI -->


                                <div class="mt-4">


                                    <h6>
                                        Lokasi Kejadian
                                    </h6>



                                    <p>

                                        <strong>Alamat :</strong>

                                        {{ $step2['alamat'] ?? '-' }}

                                    </p>



                                    <p>
                                        <strong>Kecamatan :</strong>

                                        {{ $kecamatan->nama_kecamatan ?? '-' }}

                                    </p>


                                    <p>
                                        <strong>Desa :</strong>

                                        {{ $desa->nama_desa ?? '-' }}

                                    </p>

                                </div>




                                @if(isset($step2['lampiran']))


                                    <div class="mt-4">


                                        <h6>
                                            Lampiran
                                        </h6>


                                        <img src="{{ asset('storage/' . $step2['lampiran']) }}" class="img-fluid rounded"
                                            width="250">


                                    </div>


                                @endif



                            </div>


                        </div>

                        <!-- PERSETUJUAN -->

                        <div class="form-check mt-4">

                            <input class="form-check-input" type="checkbox" name="persetujuan" value="setuju" id="setuju"
                                required>


                            <label class="form-check-label" for="setuju">

                                Saya menyatakan bahwa seluruh data yang saya isi
                                adalah benar dan dapat dipertanggungjawabkan.

                            </label>


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

                        <!-- BUTTON -->

                        <form action="{{ route('pengaduan.kirimOtp') }}" method="POST">


                            @csrf

                            <div class="form-navigation">

                                <a href="{{ route('pengaduan.datapribadi') }}" class="btn btn-secondary">
                                    Sebelumnya
                                </a>


                                <button type="submit" class="btn-next">
                                    Daftar & Kirim Aduan
                                </button>

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