<aside class="sa-sidebar" id="superAdminSidebar">

    <div class="sa-sidebar-header">
        <div class="sa-brand-logo">
            <img src="{{ asset('images/logo-bnn.png') }}" alt="Logo BNNK">
        </div>

        <div class="sa-brand-text">
            <h4>SUPER ADMIN</h4>
            <small>BNNK Tulungagung</small>
        </div>
    </div>

    <nav class="sa-navigation">

        <ul class="sa-menu">

            {{-- Dashboard --}}
            <li class="sa-menu-item {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('superadmin.dashboard') }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- Data Admin --}}
            <li class="sa-menu-item {{ request()->routeIs('superadmin.data_admin*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.data_admin') }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Data Admin</span>
                </a>
            </li>

            {{-- Data Pengaduan --}}
            <li class="sa-menu-item {{ request()->routeIs('superadmin.data_pengaduan*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.data_pengaduan') }}">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Data Pengaduan</span>
                </a>
            </li>

            {{-- Permohonan --}}
            <li class="sa-menu-item {{ request()->routeIs('superadmin.permohonan*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.permohonan') }}">
                    <i class="bi bi-envelope-paper-fill"></i>
                    <span>Permohonan</span>
                </a>
            </li>

            {{-- Aktivitas --}}
            <li class="sa-menu-item {{ request()->routeIs('superadmin.aktivitas*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.aktivitas') }}">
                    <i class="bi bi-clock-history"></i>
                    <span>Aktivitas</span>
                </a>
            </li>

        </ul>

    </nav>

    <div class="sa-sidebar-footer">

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button type="submit" class="sa-logout">

                <i class="bi bi-box-arrow-left"></i>

                <span>Keluar</span>

            </button>

        </form>

    </div>

</aside>

<button id="sidebarOverlay" class="sa-sidebar-overlay"></button>

@once
    @push('scripts')

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                const dashboard = document.getElementById('superAdminDashboard');
                const sidebar = document.getElementById('superAdminSidebar');
                const toggle = document.getElementById('toggleSidebar');
                const overlay = document.getElementById('sidebarOverlay');

                if (!dashboard || !sidebar || !toggle) return;

                const storageKey = 'sidebar-collapse';

                // Desktop
                if (window.innerWidth > 991) {

                    if (localStorage.getItem(storageKey) == 'true') {
                        dashboard.classList.add('sidebar-collapsed');
                    }

                }

                toggle.addEventListener('click', function () {

                    if (window.innerWidth <= 991) {

                        dashboard.classList.toggle('mobile-sidebar-open');

                    } else {

                        dashboard.classList.toggle('sidebar-collapsed');

                        localStorage.setItem(
                            storageKey,
                            dashboard.classList.contains('sidebar-collapsed')
                        );

                    }

                });

                overlay.addEventListener('click', function () {

                    dashboard.classList.remove('mobile-sidebar-open');

                });

                window.addEventListener('resize', function () {

                    if (window.innerWidth > 991) {

                        dashboard.classList.remove('mobile-sidebar-open');

                    }

                });

            });

        </script>

    @endpush
@endonce