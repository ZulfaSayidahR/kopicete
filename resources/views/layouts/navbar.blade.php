<nav class="navbar navbar-expand-lg navbar-bnn">


    <div class="container">


        <a class="navbar-brand" href="{{route('home')}}">


            <i class="bi bi-shield-check"></i>

            BNNK TULUNGAGUNG


        </a>



        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">


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



                <li class="nav-item">

                    <a class="nav-link" href="/tracking">

                        Lacak Aduan

                    </a>

                </li>


                <li class="nav-item ms-3">

                    <a href="{{ route('login') }}" class="btn btn-yellow">

                        Masuk Admin

                    </a>

                </li>



            </ul>



        </div>


    </div>


</nav>