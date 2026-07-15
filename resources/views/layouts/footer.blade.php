<footer class="footer-bnn">

    <div class="container">

        <div class="row gy-5">

            <!-- Brand -->
            <div class="col-lg-5">

                <div class="footer-brand">

                    <img src="{{ asset('images/logo-bnn.png') }}" alt="BNNK Tulungagung">

                    <div>

                        <h4>Kopi CeTe</h4>

                        <p>
                            Portal Pengaduan dan Permohonan Digital
                            BNNK Tulungagung. Memberikan layanan
                            pengaduan masyarakat dan permohonan
                            secara cepat, mudah, aman dan transparan.
                        </p>

                    </div>

                </div>

            </div>

            <!-- Menu -->
            <div class="col-lg-3">

                <h5>Menu</h5>

                <ul class="footer-menu">

                    <li>
                        <a href="{{ route('home') }}">
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pengaduan.create') }}">
                            Pengaduan
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('permohonan.create') }}">
                            Permohonan
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('home') }}">
                            Lacak Aduan
                        </a>
                    </li>

                </ul>

            </div>

            <!-- Kontak -->
            <div class="col-lg-4">

                <h5>Kontak</h5>

                <ul class="footer-contact">

                    <li>
                        <i class="bi bi-geo-alt-fill"></i>

                        <span>
                            Jl. Sultan Agung No.1A,
                            Dusun Kedungsingkal,
                            Ketanon,
                            Kec. Kedungwaru,
                            Kabupaten Tulungagung,
                            Jawa Timur 66229
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-telephone-fill"></i>

                        <span>0821-5224-9911</span>
                    </li>

                    <li>
                        <i class="bi bi-envelope-fill"></i>

                        <span>info@bnnktulungagung.go.id</span>
                    </li>

                </ul>

                <div class="footer-social">

                    <a href="https://www.facebook.com/" target="_blank">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="https://www.instagram.com/" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="https://twitter.com/" target="_blank">
                        <i class="bi bi-twitter-x"></i>
                    </a>

                </div>

            </div>

        </div>

        <hr>

        <div class="footer-bottom">

            <span>
                © {{ date('Y') }} BNNK Tulungagung
            </span>

            <span>
                Dikembangkan oleh Tim Kopi CeTe
            </span>

        </div>

    </div>

</footer>