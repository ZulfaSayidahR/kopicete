<nav class="navbar navbar-expand-lg navbar-dark navbar-bnn">

    <div class="container">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="navbar-brand logo-group">

            <img src="{{ asset('images/bnn.webp') }}" class="logo-bnn" alt="BNN">
            <img src="{{ asset('images/warondrugs.jpg') }}" class="logo-war" alt="War On Drugs">
            <img src="{{ asset('images/kopicete.png') }}" class="logo-kopicete" alt="Kopicete">

        </a>

        {{-- Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
            aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pengaduan.create') }}">
                        Pengaduan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('permohonan.create') }}">
                        Permohonan
                    </a>
                </li>

                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                    <a href="{{ route('login') }}" class="btn btn-yellow w-100">
                        Masuk Admin
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const menu = document.getElementById('menu');
        const toggler = document.querySelector('.navbar-toggler');

        if (menu && toggler) {

            // Tutup menu saat salah satu link diklik
            document.querySelectorAll('#menu .nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        bootstrap.Collapse.getOrCreateInstance(menu).hide();
                    }
                });
            });

            // Sinkronkan atribut aria-expanded
            menu.addEventListener('shown.bs.collapse', () => {
                toggler.setAttribute('aria-expanded', 'true');
            });

            menu.addEventListener('hidden.bs.collapse', () => {
                toggler.setAttribute('aria-expanded', 'false');
            });

        }

    });
</script>