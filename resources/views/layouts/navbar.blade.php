<nav class="navbar navbar-expand-lg navbar-bnn">


    <div class="container px-5">


        <div class="d-flex justify-content-between align-items-center w-100">

        <a href="{{ route('home') }}" class="d-flex align-items-center logo-group">
            <img src="{{ asset('images/bnn.webp') }}" class="logo-bnn">
            <img src="{{ asset('images/warondrugs.jpg') }}" class="logo-war">
            <img src="{{ asset('images/kopicete.png') }}" class="logo-kopicete">
        </a>

        <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu"
            aria-controls="menu"
            aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>



        <div class="collapse navbar-collapse" id="menu">


            <ul class="navbar-nav ms-auto">


                <li class="nav-item">

                    <a class="nav-link" href="/">
                        Beranda
                    </a>

                </li>



                <li class="nav-item">

                    <a class="nav-link" href="/pengaduan">

                        Pengaduan

                    </a>

                </li>



                <li class="nav-item">

                    <a class="nav-link" href="/permohonan">

                        Permohonan

                    </a>

                </li>



                {{-- <li class="nav-item">

                    <a class="nav-link" href="/tracking">

                        Lacak Aduan

                    </a>

                </li> --}}


                <li class="nav-item ms-3">

                    <a href="{{ route('login') }}" class="btn btn-yellow">

                        Masuk Admin

                    </a>

                </li>



            </ul>



        </div>


    </div>


</nav>