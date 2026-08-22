@extends('layouts.app')

@section('title', 'Tentang Kopi Cete')

@section('content')

<section class="about-page">

    <div class="container">

        {{-- HERO ABOUT --}}
        <div class="about-hero">

            <div class="about-hero-content">

                <span class="about-badge">
                    TENTANG KAMI
                </span>

                <h1>
                    Mengenal <span>Kopi Cete</span>
                </h1>

                <p>
                    Kopi Cete merupakan website yang dikembangkan sebagai
                    bagian dari kegiatan magang mahasiswa Universitas
                    Bhinneka PGRI Tulungagung.
                </p>

            </div>

            <div class="about-hero-icon">
                <img src="{{ asset('images/kopicete.png') }}" alt="Kopi Cete">
            </div>

        </div>


        {{-- INFORMASI UTAMA --}}
        <div class="about-content">

            {{-- APA ITU KOPI CETE --}}
            <div class="about-info-card">

                <div class="about-icon">
                    <i class="bi bi-info-circle-fill"></i>
                </div>

                <h2>
    Apa itu Kopi Cete?
                </h2>

                <p>
                    <strong>Kopi Cete</strong> merupakan website kolaborasi yang
                    dirancang untuk mendukung peran instansi agar dapat memberikan
                    pelayanan kepada masyarakat secara lebih cepat, mudah, dan terarah.
                </p>

                <p>
                    Melalui website ini, masyarakat dapat menyampaikan
                    <strong>pengaduan maupun permohonan kepada BNNK Tulungagung</strong>
                    secara lebih mudah tanpa harus melalui proses yang rumit.
                    Setiap pengaduan dan permohonan yang disampaikan dapat dikelola
                    secara terarah sehingga membantu instansi dalam memberikan
                    tindak lanjut kepada masyarakat.
                </p>

                <p>
                    Kopi Cete hadir sebagai salah satu bentuk pemanfaatan teknologi
                    dalam mendukung pelayanan publik. Dengan adanya sistem ini,
                    diharapkan komunikasi antara masyarakat dan instansi dapat
                    berjalan lebih efektif, proses penyampaian pengaduan menjadi
                    lebih mudah, serta penanganan setiap laporan dapat dilakukan
                    secara lebih cepat dan terarah.
                </p>

            </div>


            {{-- TUJUAN --}}
            <div class="about-info-card">

                <div class="about-icon">
                    <i class="bi bi-bullseye"></i>
                </div>

                <div>

                    <h2>
                        Tujuan Pembuatan Website
                    </h2>

                    <p>
                        Website ini dibuat sebagai media untuk menerapkan
                        pengetahuan di bidang teknologi informasi dan
                        pengembangan website yang telah dipelajari selama
                        masa perkuliahan maupun kegiatan magang.
                    </p>

                    <div class="purpose-list">

                        <div class="purpose-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Menerapkan ilmu pengembangan website.
                            </span>
                        </div>

                        <div class="purpose-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Membuat sistem yang mudah dipahami masyarakat.
                            </span>
                        </div>

                        <div class="purpose-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Mengembangkan pengalaman mahasiswa dalam
                                membangun sistem berbasis web.
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- DEVELOPER --}}
        <div class="developer-wrapper">

            <div class="developer-heading">

                <span class="about-badge">
                    TIM PENGEMBANG
                </span>

                <h2>
                    Dikembangkan Oleh
                </h2>

                <p>
                    Website ini dikembangkan oleh mahasiswa
                    Universitas Bhinneka PGRI Tulungagung
                    sebagai bagian dari kegiatan magang.
                </p>

            </div>


            <div class="developer-grid">

                <div class="developer-card">

                    <div class="developer-number">
                        01
                    </div>

                    <div class="developer-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <h3>
                        Zulfa Sayidah Rohmah
                    </h3>

                    <span>
                        Mahasiswa
                    </span>

                </div>


                <div class="developer-card">

                    <div class="developer-number">
                        02
                    </div>

                    <div class="developer-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <h3>
                        Widiya Putri Rosmadi
                    </h3>

                    <span>
                        Mahasiswa
                    </span>

                </div>


                <div class="developer-card">

                    <div class="developer-number">
                        03
                    </div>

                    <div class="developer-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <h3>
                        Naufaltis'A Hadriyan Aryasatya
                    </h3>

                    <span>
                        Mahasiswa
                    </span>

                </div>

            </div>

        </div>


        {{-- PENUTUP --}}
        <div class="about-closing">

            <i class="bi bi-quote"></i>

            <p>
                Website ini merupakan bagian dari proses pembelajaran
                dan pengembangan kemampuan mahasiswa dalam menerapkan
                teknologi informasi di dunia kerja.
            </p>

            <strong>
                Universitas Bhinneka PGRI Tulungagung
            </strong>

            <small>
                2026
            </small>

        </div>

    </div>

</section>

@endsection