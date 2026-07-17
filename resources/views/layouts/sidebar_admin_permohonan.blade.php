<aside class="sa-sidebar" id="superAdminSidebar">

    <div class="sa-sidebar-header">

        <div class="sa-brand-logo">
            <img src="{{ asset('images/bnn.webp') }}" alt="Logo BNNK Tulungagung">
        </div>

        <div class="sa-brand-text">
            <h4> ADMIN PERMOHONAN</h4>
            <small>BNNK Tulungagung</small>
        </div>
    </div>

    <nav class="sa-navigation">

        <ul class="sa-menu">

            {{-- Dashboard --}}
            <li class="sa-menu-item
                {{ request()->routeIs('adminpermohonan.dashboard') ? 'active' : '' }}">

                <a href="{{ route('adminpermohonan.dashboard') }}">

                    <i class="bi bi-grid-fill"></i>

                    <span>Dashboard</span>

                </a>

            </li>

            {{-- permohonan --}}
            <li class="sa-menu-item {{ request()->routeIs('adminpermohonan.data_permohonan') ? 'active' : '' }}">
                <a href="{{ route('adminpermohonan.data_permohonan') }}">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Data permohonan</span>
                </a>
            </li>
        </ul>

    </nav>

    <div class="sa-sidebar-footer">

        @if (Route::has('logout'))

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit" class="sa-logout">

                    <i class="bi bi-box-arrow-left"></i>

                    <span>Keluar</span>

                </button>

            </form>

        @else

            <a href="{{ url('/') }}" class="sa-logout">

                <i class="bi bi-box-arrow-left"></i>

                <span>Keluar</span>

            </a>

        @endif

    </div>

</aside>

{{-- Overlay sidebar untuk perangkat mobile --}}
<button type="button" class="sa-sidebar-overlay" id="sidebarOverlay" aria-label="Tutup sidebar">
</button>

{{-- Script sidebar hanya dimuat satu kali --}}
@once

    @push('scripts')

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const dashboard = document.getElementById(
                    'superAdminDashboard'
                );

                const toggleButton = document.getElementById(
                    'toggleSidebar'
                );

                const overlay = document.getElementById(
                    'sidebarOverlay'
                );

                if (!dashboard || !toggleButton || !overlay) {
                    return;
                }

                const storageKey = 'superadmin-sidebar-collapsed';

                // Mengembalikan posisi sidebar terakhir
                if (
                    window.innerWidth > 991 &&
                    localStorage.getItem(storageKey) === 'true'
                ) {
                    dashboard.classList.add('sidebar-collapsed');
                }

                toggleButton.addEventListener('click', function () {

                    if (window.innerWidth <= 991) {
                        dashboard.classList.toggle(
                            'mobile-sidebar-open'
                        );

                        return;
                    }

                    dashboard.classList.toggle(
                        'sidebar-collapsed'
                    );

                    localStorage.setItem(
                        storageKey,
                        dashboard.classList.contains(
                            'sidebar-collapsed'
                        )
                    );
                });

                overlay.addEventListener('click', function () {
                    dashboard.classList.remove(
                        'mobile-sidebar-open'
                    );
                });

                window.addEventListener('resize', function () {
                    if (window.innerWidth > 991) {
                        dashboard.classList.remove(
                            'mobile-sidebar-open'
                        );
                    }
                });
            });
        </script>

    @endpush

@endonce