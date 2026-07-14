@extends('layouts.app')

@section('title')
    Kopi CeTe - Portal Aduan
@endsection


@section('content')


    <main class="home-page">

        <div class="home-grid">

            {{-- =================================================
            PORTAL ADUAN DAN PERMOHONAN
            ================================================== --}}
            <section class="aduan-box">

                <span class="badge-layanan">
                    LAYANAN DIGITAL
                </span>

                <div class="aduan-main">

                    <div class="aduan-copy">

                        <p class="aduan-kicker">
                            PORTAL ADUAN DAN PERMOHONAN
                        </p>

                        <h1 class="aduan-title">
                            Pantau Aduan dan<br>
                            Permohonan Baru<br>
                            Dengan Cepat.
                        </h1>

                        <p class="description">
                            Lacak status, baca ringkasan permohonan terbaru,
                            dan buat aduan langsung.
                        </p>

                    </div>

                    <div class="aduan-actions">

                        <a href="{{ route('pengaduan.create') }}" class="action-button">

                            <i class="bi bi-file-earmark-plus-fill"></i>

                            <span>
                                Buat Aduan Cepat
                            </span>

                        </a>

                        <a href="{{ route('permohonan.create') }}" class="action-button">

                            <i class="bi bi-file-earmark-text-fill"></i>

                            <span>
                                Buat Permohonan Cepat
                            </span>

                        </a>
                        <p class="action-helper">
                            Klik tombol di atas untuk menyampaikan laporan Anda.
                            Pastikan data yang diisi lengkap dan benar!
                        </p>

                    </div>

                </div>

                <div class="info-card">

                    <div class="info-item">
                        <small>Total Aduan</small>
                        <h3>500</h3>
                    </div>

                    <div class="info-item">
                        <small>Total Aduan Selesai</small>
                        <h3>7</h3>
                    </div>

                    <div class="info-item">
                        <small>Total Aduan Proses</small>
                        <h3>1</h3>
                    </div>

                    <div class="info-item">
                        <small>Total Permohonan</small>
                        <h3>276</h3>
                    </div>

                </div>

            </section>

            {{-- =================================================
            LACAK ADUAN
            ================================================== --}}
            <section class="tracking-box">

                <h2 class="tracking-heading">
                    LACAK ADUAN
                </h2>

                <div class="tracking-image">

                    <img src="{{ asset('images/tracking.png') }}" alt="Ilustrasi pelacakan aduan">

                </div>

                <h3 class="tracking-title">
                    Cari dan lacak disini!
                </h3>

                <p class="tracking-description">
                    Masukkan kode token untuk membuka detail
                    dan progres penanganan.
                </p>

                <form action="{{ route('pengaduan.search') }}" method="GET" class="tracking-form">

                    <div class="tracking-input-wrapper">

                        <i class="bi bi-search"></i>

                        <input type="text" name="kode" class="tracking-input" placeholder="Masukkan kode aduan..." required>

                    </div>

                    <button type="submit" class="tracking-button">

                        Lacak

                    </button>

                </form>

                <div class="footer-text">

                    <i class="bi bi-ticket-fill"></i>

                    <span>
                        Kode token tertera setelah laporan berhasil terkirim.
                    </span>

                </div>

            </section>

        </div>

    </main>

@endsection