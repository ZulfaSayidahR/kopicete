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
                        <!-- FORM -->

                        <form action="{{ route('pengaduan.storeStep3') }}" method="POST">

                            @csrf
                            @if ($errors->any())

                                <div class="alert alert-danger">

                                    <ul class="mb-0">

                                        @foreach ($errors->all() as $error)

                                            <li>{{ $error }}</li>

                                        @endforeach

                                    </ul>

                                </div>

                            @endif

                            <div class="mb-3">

                                <label class="form-label">
                                    Nama Lengkap
                                </label>

                                <input type="text" class="form-control" name="nama_lengkap"
                                    placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap') }}" required>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">
                                    Nomor WhatsApp
                                </label>

                                <input type="text" class="form-control" name="no_whatsapp"
                                    placeholder="Contoh : 081234567890" value="{{ old('no_whatsapp') }}" required>


                                <div class="form-note">

                                    Pastikan nomor WhatsApp yang diberikan aktif,
                                    karena petugas dapat menghubungi Anda melalui nomor tersebut
                                    untuk proses verifikasi atau tindak lanjut laporan.

                                </div>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email" class="form-control" name="email"
                                    placeholder="Masukkan email aktif (opsional)" value="{{ old('email') }}">


                                <div class="form-note">

                                    Email bersifat opsional dan digunakan apabila diperlukan
                                    untuk informasi tambahan terkait laporan.

                                </div>

                            </div>



                            <div class="mb-4">

                                <label class="form-label">
                                    Alamat Domisili
                                </label>


                                <textarea class="form-control" name="alamat_domisili" rows="4"
                                    placeholder="Masukkan alamat lengkap">{{ old('alamat_domisili') }}</textarea>


                            </div>



                            <div class="alert alert-info">

                                <div class="form-check">

                                    <input class="form-check-input" type="checkbox" name="konfirmasi_data" value="setuju"
                                        required>


                                    <label class="form-check-label">

                                        Saya memastikan data pribadi yang saya masukkan
                                        adalah benar dan dapat dipertanggungjawabkan.

                                    </label>

                                </div>

                            </div>



                            <div class="form-navigation">


                                <a href="{{ route('pengaduan.lokasi') }}" class="btn btn-secondary">

                                    Sebelumnya

                                </a>



                                <button type="submit" class="btn-next">

                                    Selanjutnya

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