@extends('layouts.admin')

@section('title', 'Data Admin')

@section('content')

<section class="sa-dashboard" id="superAdminDashboard">

    @include('layouts.sidebar')

    <main class="sa-main">

        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <header class="sa-topbar">

            <div class="sa-topbar-left">

                <button
                    type="button"
                    class="sa-toggle-sidebar"
                    id="toggleSidebar"
                    aria-label="Buka atau tutup sidebar"
                >
                    <i class="bi bi-list"></i>
                </button>

                <div class="sa-page-heading">

                    <h1>Data Admin</h1>

                    <p>
                        Kelola dan pantau seluruh akun admin
                        BNNK Tulungagung
                    </p>

                </div>

            </div>


            <div class="sa-profile">

                <div class="sa-profile-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="sa-profile-info">

                    <strong>
                        {{ auth()->user()->name ?? 'Super Admin' }}
                    </strong>

                    <small>
                        Administrator Sistem
                    </small>

                </div>

                <i class="bi bi-chevron-down sa-profile-arrow"></i>

            </div>

        </header>


        {{-- =========================================================
            PESAN SUCCESS
        ========================================================== --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- =========================================================
            PESAN ERROR
        ========================================================== --}}
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">

                <i class="bi bi-exclamation-circle-fill me-2"></i>

                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- =========================================================
            VALIDATION ERROR
        ========================================================== --}}
        @if($errors->any())

            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">

                <strong>
                    Terjadi kesalahan:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- =========================================================
            RINGKASAN DATA ADMIN
        ========================================================== --}}
        <section class="sa-statistics">

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-blue">

                    <i class="bi bi-people-fill"></i>

                </div>

                <div class="sa-stat-content">

                    <span>
                        Total Admin Terdaftar
                    </span>

                    <h2>
                        {{ $totalAdmin }}
                    </h2>

                    <small>

                        <i class="bi bi-database-check"></i>

                        Akun tersimpan dalam sistem

                    </small>

                </div>

            </article>

        </section>


        {{-- =========================================================
            DATA ADMIN
        ========================================================== --}}
        <section class="sa-panel sa-admin-panel">


            {{-- =====================================================
                HEADER
            ====================================================== --}}
            <div class="sa-panel-header">

                <div>

                    <h3>
                        Data Admin Terdaftar
                    </h3>

                    <p>
                        Daftar akun admin yang terdaftar di dalam sistem.
                    </p>

                </div>


                <div class="sa-table-tools">


                    {{-- =================================================
                        SEARCH
                    ================================================== --}}
                    <form
                        action="{{ route('superadmin.data_admin') }}"
                        method="GET"
                        class="sa-search-box"
                    >

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            id="adminSearch"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama atau email..."
                            autocomplete="off"
                        >

                    </form>


                    {{-- =================================================
                        TAMBAH ADMIN
                    ================================================== --}}
                    <button
                        type="button"
                        class="sa-filter-button"
                        data-bs-toggle="modal"
                        data-bs-target="#tambahAdminModal"
                    >

                        <i class="bi bi-person-plus-fill"></i>

                        <span>
                            Tambah Admin
                        </span>

                    </button>

                </div>

            </div>


            {{-- =========================================================
                TABEL DATA ADMIN
            ========================================================== --}}
            <div class="sa-table-responsive">

                <table
                    class="sa-table"
                    id="adminTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Admin
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                Metode Login
                            </th>

                            <th>
                                Tanggal Terdaftar
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="sa-action-column">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($admins as $admin)

                            <tr>

                                {{-- =================================================
                                    ADMIN
                                ================================================== --}}
                                <td>

                                    <div class="sa-admin-user">

                                        <div
                                            class="sa-admin-avatar
                                            {{ $admin->role === 'admin_permohonan' ? 'purple' : '' }}"
                                        >

                                            {{ strtoupper(
                                                substr($admin->name ?? 'A', 0, 1)
                                            ) }}

                                        </div>


                                        <div>

                                            <strong>
                                                {{ $admin->name }}
                                            </strong>

                                            <small>

                                                @switch($admin->role)

                                                    @case('admin_pengaduan')

                                                        Admin Pengaduan

                                                        @break

                                                    @case('admin_permohonan')

                                                        Admin Permohonan

                                                        @break

                                                    @default

                                                        Admin

                                                @endswitch

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- =================================================
                                    EMAIL
                                ================================================== --}}
                                <td>

                                    <span class="sa-email-text">
                                        {{ $admin->email }}
                                    </span>

                                </td>


                                {{-- =================================================
                                    ROLE
                                ================================================== --}}
                                <td>

                                    @switch($admin->role)

                                        @case('admin_pengaduan')

                                            <span class="badge bg-primary">
                                                Admin Pengaduan
                                            </span>

                                            @break

                                        @case('admin_permohonan')

                                            <span class="badge bg-success">
                                                Admin Permohonan
                                            </span>

                                            @break

                                        @default

                                            <span class="badge bg-secondary">
                                                {{ $admin->role }}
                                            </span>

                                    @endswitch

                                </td>


                                {{-- =================================================
                                    METODE LOGIN
                                ================================================== --}}
                                <td>

                                    <span class="sa-login-badge">

                                        @if(!empty($admin->google_id))

                                            <i class="bi bi-google"></i>

                                            Google

                                        @else

                                            <i class="bi bi-envelope-fill"></i>

                                            Email & Password

                                        @endif

                                    </span>

                                </td>


                                {{-- =================================================
                                    TANGGAL TERDAFTAR
                                ================================================== --}}
                                <td>

                                    @if($admin->created_at)

                                        {{ $admin->created_at->translatedFormat('d F Y') }}

                                    @else

                                        -

                                    @endif

                                </td>


                                {{-- =================================================
                                    STATUS
                                ================================================== --}}
                                <td>

                                    @if($admin->is_active)

                                        <span class="sa-status-badge active">

                                            <span></span>

                                            Aktif

                                        </span>

                                    @else

                                        <span class="sa-status-badge">

                                            <span></span>

                                            Nonaktif

                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    AKSI
                                ================================================== --}}
                                <td>

                                    <div class="sa-action-buttons">


                                        {{-- =================================================
                                            RESET PASSWORD
                                        ================================================== --}}
                                        <button
                                            type="button"
                                            class="sa-action-button sa-key-button"
                                            title="Reset password admin"
                                            aria-label="Reset password {{ $admin->name }}"

                                            data-bs-toggle="modal"
                                            data-bs-target="#resetPasswordModal"

                                            data-admin-id="{{ $admin->id }}"
                                            data-admin-name="{{ $admin->name }}"

                                            data-reset-url="{{ route(
                                                'superadmin.data_admin.reset_password',
                                                ['id' => $admin->id]
                                            ) }}"
                                        >

                                            <i class="bi bi-key-fill"></i>

                                        </button>


                                        {{-- =================================================
                                            HAPUS ADMIN
                                        ================================================== --}}
                                        <button
                                            type="button"
                                            class="sa-action-button sa-delete-button"
                                            title="Hapus admin"
                                            aria-label="Hapus {{ $admin->name }}"

                                            data-bs-toggle="modal"
                                            data-bs-target="#hapusAdminModal"

                                            data-admin-id="{{ $admin->id }}"
                                            data-admin-name="{{ $admin->name }}"

                                            data-delete-url="{{ route(
                                                'superadmin.data_admin.destroy',
                                                ['id' => $admin->id]
                                            ) }}"
                                        >

                                            <i class="bi bi-trash-fill"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <i
                                            class="bi bi-people"
                                            style="font-size: 40px;"
                                        ></i>

                                        @if(request('search'))

                                            <p class="mt-2 mb-1">
                                                Admin tidak ditemukan.
                                            </p>

                                            <small>
                                                Tidak ada hasil untuk
                                                "<strong>{{ request('search') }}</strong>"
                                            </small>

                                        @else

                                            <p class="mt-2 mb-0">
                                                Belum ada admin terdaftar.
                                            </p>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =========================================================
                FOOTER
            ========================================================== --}}
            <div class="sa-table-footer">

                <span>

                    @if($admins->total() > 0)

                        Menampilkan
                        {{ $admins->firstItem() }}
                        -
                        {{ $admins->lastItem() }}
                        dari
                        {{ $admins->total() }}
                        admin

                    @else

                        Menampilkan 0 dari 0 admin

                    @endif

                </span>


                {{-- =====================================================
                    PAGINATION
                ====================================================== --}}
                @if($admins->hasPages())

                    <div class="sa-pagination">

                        {{-- PREVIOUS --}}
                        @if($admins->onFirstPage())

                            <button
                                type="button"
                                disabled
                            >

                                <i class="bi bi-chevron-left"></i>

                            </button>

                        @else

                            <a
                                href="{{ $admins->previousPageUrl() }}"
                                class="sa-pagination-link"
                            >

                                <i class="bi bi-chevron-left"></i>

                            </a>

                        @endif


                        {{-- NOMOR HALAMAN --}}
                        @foreach($admins->getUrlRange(
                            max(1, $admins->currentPage() - 2),
                            min($admins->lastPage(), $admins->currentPage() + 2)
                        ) as $page => $url)

                            @if($page == $admins->currentPage())

                                <button
                                    type="button"
                                    class="active"
                                >
                                    {{ $page }}
                                </button>

                            @else

                                <a
                                    href="{{ $url }}"
                                    class="sa-pagination-link"
                                >
                                    {{ $page }}
                                </a>

                            @endif

                        @endforeach


                        {{-- NEXT --}}
                        @if($admins->hasMorePages())

                            <a
                                href="{{ $admins->nextPageUrl() }}"
                                class="sa-pagination-link"
                            >

                                <i class="bi bi-chevron-right"></i>

                            </a>

                        @else

                            <button
                                type="button"
                                disabled
                            >

                                <i class="bi bi-chevron-right"></i>

                            </button>

                        @endif

                    </div>

                @endif

            </div>

        </section>


        {{-- =========================================================
            MODAL TAMBAH ADMIN
        ========================================================== --}}
        <div
            class="modal fade"
            id="tambahAdminModal"
            tabindex="-1"
            aria-labelledby="tambahAdminModalLabel"
            aria-hidden="true"
        >

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 shadow-lg rounded-4">


                    {{-- HEADER --}}
                    <div class="modal-header border-0">

                        <div>

                            <h5
                                class="modal-title fw-bold"
                                id="tambahAdminModalLabel"
                            >

                                <i class="bi bi-person-plus-fill me-2"></i>

                                Tambah Admin

                            </h5>

                            <small class="text-muted">
                                Tambahkan akun admin baru ke dalam sistem.
                            </small>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>

                    </div>


                    {{-- BODY --}}
                    <div class="modal-body">

                        <form
                            id="tambahAdminForm"
                            method="POST"
                            action="{{ route('superadmin.data_admin.store') }}"
                        >

                            @csrf


                            {{-- NAMA --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >

                            </div>


                            {{-- EMAIL --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    placeholder="Masukkan email"
                                    required
                                >

                                <small class="text-muted">
                                    Email digunakan untuk login ke dalam sistem.
                                </small>

                            </div>


                            {{-- ROLE --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Jabatan / Role
                                </label>

                                <select
                                    class="form-select"
                                    name="role"
                                    required
                                >

                                    <option value="">
                                        Pilih role admin
                                    </option>

                                    <option value="admin_pengaduan">
                                        Admin Pengaduan
                                    </option>

                                    <option value="admin_permohonan">
                                        Admin Permohonan
                                    </option>

                                </select>

                            </div>


                            {{-- PASSWORD --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="Masukkan password"
                                    minlength="8"
                                    required
                                >

                                <small class="text-muted">
                                    Password minimal 8 karakter.
                                </small>

                            </div>


                            {{-- KONFIRMASI PASSWORD --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Konfirmasi Password
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    placeholder="Ulangi password"
                                    minlength="8"
                                    required
                                >

                            </div>

                        </form>

                    </div>


                    {{-- FOOTER --}}
                    <div class="modal-footer border-0">

                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            form="tambahAdminForm"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-person-plus-fill me-1"></i>

                            Simpan Admin

                        </button>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            MODAL RESET PASSWORD
        ========================================================== --}}
        <div
            class="modal fade"
            id="resetPasswordModal"
            tabindex="-1"
            aria-labelledby="resetPasswordModalLabel"
            aria-hidden="true"
        >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg rounded-4">


                {{-- HEADER --}}
                <div class="modal-header border-0">

                    <div>

                        <h5
                            class="modal-title fw-bold"
                            id="resetPasswordModalLabel"
                        >

                            <i class="bi bi-key-fill me-2"></i>

                            Reset Password

                        </h5>

                        <small class="text-muted">
                            Buat password baru untuk akun admin.
                        </small>

                    </div>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                {{-- BODY --}}
                <div class="modal-body">

                    <div class="alert alert-warning">

                        <i class="bi bi-exclamation-triangle-fill me-1"></i>

                        Password akun berikut akan diubah:

                        <strong id="resetAdminName">
                            Admin
                        </strong>

                    </div>


                    <form
                        id="resetPasswordForm"
                        method="POST"
                        action=""
                    >

                        @csrf

                        @method('PUT')


                        {{-- =================================================
                        PASSWORD BARU
                        ================================================== --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Password Baru
                            </label>


                            <div style="position: relative;">

                                <input
                                    type="password"
                                    class="form-control"
                                    id="newPassword"
                                    name="password"
                                    placeholder="Masukkan password baru"
                                    minlength="8"
                                    required
                                    style="padding-right: 45px;"
                                >


                                {{-- ICON MATA PASSWORD BARU --}}
                                <i
                                    class="bi bi-eye-fill"
                                    id="toggleNewPassword"
                                    title="Lihat password"
                                    style="
                                        position: absolute;
                                        right: 15px;
                                        top: 50%;
                                        transform: translateY(-50%);
                                        cursor: pointer;
                                        z-index: 10;
                                    "
                                ></i>

                            </div>

                        </div>


                        {{-- =================================================
                        KONFIRMASI PASSWORD
                        ================================================== --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Konfirmasi Password
                            </label>


                            <div style="position: relative;">

                                <input
                                    type="password"
                                    class="form-control"
                                    id="confirmPassword"
                                    name="password_confirmation"
                                    placeholder="Ulangi password baru"
                                    minlength="8"
                                    required
                                    style="padding-right: 45px;"
                                >


                                {{-- ICON MATA KONFIRMASI PASSWORD --}}
                                <i
                                    class="bi bi-eye-fill"
                                    id="toggleConfirmPassword"
                                    title="Lihat konfirmasi password"
                                    style="
                                        position: absolute;
                                        right: 15px;
                                        top: 50%;
                                        transform: translateY(-50%);
                                        cursor: pointer;
                                        z-index: 10;
                                    "
                                ></i>

                            </div>

                        </div>


                    </form>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer border-0">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        form="resetPasswordForm"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-key-fill me-1"></i>

                        Reset Password

                    </button>

                </div>


            </div>

        </div>

        </div>

        {{-- ============================================================
        JAVASCRIPT ICON MATA PASSWORD
        ============================================================ --}}
        <script>

        document.addEventListener('DOMContentLoaded', function () {


            // ============================================================
            // PASSWORD BARU
            // ============================================================

            const newPassword =
                document.getElementById('newPassword');

            const toggleNewPassword =
                document.getElementById('toggleNewPassword');


            if (toggleNewPassword && newPassword) {

                toggleNewPassword.addEventListener(
                    'click',
                    function () {

                        if (newPassword.type === 'password') {

                            newPassword.type = 'text';

                            this.classList.remove(
                                'bi-eye-fill'
                            );

                            this.classList.add(
                                'bi-eye-slash-fill'
                            );

                            this.setAttribute(
                                'title',
                                'Sembunyikan password'
                            );

                        } else {

                            newPassword.type = 'password';

                            this.classList.remove(
                                'bi-eye-slash-fill'
                            );

                            this.classList.add(
                                'bi-eye-fill'
                            );

                            this.setAttribute(
                                'title',
                                'Lihat password'
                            );

                        }

                    }
                );

            }


            // ============================================================
            // KONFIRMASI PASSWORD
            // ============================================================

            const confirmPassword =
                document.getElementById('confirmPassword');

            const toggleConfirmPassword =
                document.getElementById('toggleConfirmPassword');


            if (toggleConfirmPassword && confirmPassword) {

                toggleConfirmPassword.addEventListener(
                    'click',
                    function () {

                        if (confirmPassword.type === 'password') {

                            confirmPassword.type = 'text';

                            this.classList.remove(
                                'bi-eye-fill'
                            );

                            this.classList.add(
                                'bi-eye-slash-fill'
                            );

                            this.setAttribute(
                                'title',
                                'Sembunyikan konfirmasi password'
                            );

                        } else {

                            confirmPassword.type = 'password';

                            this.classList.remove(
                                'bi-eye-slash-fill'
                            );

                            this.classList.add(
                                'bi-eye-fill'
                            );

                            this.setAttribute(
                                'title',
                                'Lihat konfirmasi password'
                            );

                        }

                    }
                );

            }

        });

        </script>


        {{-- =========================================================
            MODAL HAPUS ADMIN
        ========================================================== --}}
        <div
            class="modal fade"
            id="hapusAdminModal"
            tabindex="-1"
            aria-labelledby="hapusAdminModalLabel"
            aria-hidden="true"
        >

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 shadow-lg rounded-4">


                    {{-- HEADER --}}
                    <div class="modal-header border-0">

                        <h5
                            class="modal-title fw-bold"
                            id="hapusAdminModalLabel"
                        >

                            <i class="bi bi-trash-fill me-2 text-danger"></i>

                            Hapus Admin

                        </h5>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>

                    </div>


                    {{-- BODY --}}
                    <div class="modal-body text-center">

                        <div class="mb-3">

                            <i
                                class="bi bi-exclamation-circle-fill text-danger"
                                style="font-size: 55px;"
                            ></i>

                        </div>


                        <h5 class="fw-bold">
                            Hapus akun admin?
                        </h5>


                        <p class="text-muted mb-0">

                            Apakah kamu yakin ingin menghapus akun

                            <strong id="hapusAdminName">
                                Admin
                            </strong>

                            ?

                        </p>


                        <small class="text-danger">

                            Data akun yang telah dihapus
                            tidak dapat dikembalikan.

                        </small>

                    </div>


                    {{-- FOOTER --}}
                    <div class="modal-footer border-0 justify-content-center">

                        <button
                            type="button"
                            class="btn btn-light px-4"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>


                        <form
                            id="hapusAdminForm"
                            method="POST"
                            action=""
                            class="d-inline"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger px-4"
                            >

                                <i class="bi bi-trash-fill me-1"></i>

                                Ya, Hapus

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            JAVASCRIPT
        ========================================================== --}}
        <script>

            document.addEventListener('DOMContentLoaded', function () {


                /*
                |--------------------------------------------------------------------------
                | MODAL RESET PASSWORD
                |--------------------------------------------------------------------------
                */

                const resetPasswordModal =
                    document.getElementById('resetPasswordModal');

                const resetPasswordForm =
                    document.getElementById('resetPasswordForm');

                const resetAdminName =
                    document.getElementById('resetAdminName');


                if (resetPasswordModal) {

                    resetPasswordModal.addEventListener(
                        'show.bs.modal',
                        function (event) {

                            const button =
                                event.relatedTarget;


                            if (!button) {
                                return;
                            }


                            const adminName =
                                button.getAttribute(
                                    'data-admin-name'
                                );


                            const resetUrl =
                                button.getAttribute(
                                    'data-reset-url'
                                );


                            /*
                            | Isi nama admin
                            */

                            if (resetAdminName) {

                                resetAdminName.textContent =
                                    adminName || 'Admin';

                            }


                            /*
                            | Isi action form reset password
                            */

                            if (resetPasswordForm) {

                                resetPasswordForm.action =
                                    resetUrl;

                            }


                            /*
                            | Kosongkan password setiap modal dibuka
                            */

                            const newPassword =
                                document.getElementById(
                                    'newPassword'
                                );

                            const confirmPassword =
                                document.getElementById(
                                    'confirmPassword'
                                );


                            if (newPassword) {
                                newPassword.value = '';
                            }


                            if (confirmPassword) {
                                confirmPassword.value = '';
                            }

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | MODAL HAPUS ADMIN
                |--------------------------------------------------------------------------
                */

                const hapusAdminModal =
                    document.getElementById('hapusAdminModal');

                const hapusAdminForm =
                    document.getElementById('hapusAdminForm');

                const hapusAdminName =
                    document.getElementById('hapusAdminName');


                if (hapusAdminModal) {

                    hapusAdminModal.addEventListener(
                        'show.bs.modal',
                        function (event) {

                            const button =
                                event.relatedTarget;


                            if (!button) {
                                return;
                            }


                            const adminName =
                                button.getAttribute(
                                    'data-admin-name'
                                );


                            const deleteUrl =
                                button.getAttribute(
                                    'data-delete-url'
                                );


                            /*
                            | Isi nama admin
                            */

                            if (hapusAdminName) {

                                hapusAdminName.textContent =
                                    adminName || 'Admin';

                            }


                            /*
                            | PENTING:
                            | Isi action form dengan URL:
                            | /superadmin/data-admin/{id}
                            */

                            if (hapusAdminForm) {

                                hapusAdminForm.action =
                                    deleteUrl;

                            }

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | SEARCH
                |--------------------------------------------------------------------------
                |
                | Search utama tetap menggunakan GET Laravel.
                | JavaScript hanya membantu pencarian langsung di tabel.
                |
                */

                const searchInput =
                    document.getElementById('adminSearch');

                const table =
                    document.getElementById('adminTable');


                if (searchInput && table) {

                    searchInput.addEventListener(
                        'keyup',
                        function () {

                            const keyword =
                                this.value.toLowerCase().trim();


                            const rows =
                                table.querySelectorAll(
                                    'tbody tr'
                                );


                            rows.forEach(function (row) {

                                const text =
                                    row.textContent.toLowerCase();


                                row.style.display =
                                    text.includes(keyword)
                                        ? ''
                                        : 'none';

                            });

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | VALIDASI TAMBAH ADMIN
                |--------------------------------------------------------------------------
                */

                const tambahAdminForm =
                    document.getElementById('tambahAdminForm');


                if (tambahAdminForm) {

                    tambahAdminForm.addEventListener(
                        'submit',
                        function (event) {

                            const password =
                                tambahAdminForm.querySelector(
                                    'input[name="password"]'
                                ).value;


                            const confirmation =
                                tambahAdminForm.querySelector(
                                    'input[name="password_confirmation"]'
                                ).value;


                            if (password.length < 8) {

                                event.preventDefault();

                                alert(
                                    'Password minimal 8 karakter.'
                                );

                                return;

                            }


                            if (password !== confirmation) {

                                event.preventDefault();

                                alert(
                                    'Konfirmasi password tidak sesuai.'
                                );

                                return;

                            }

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | VALIDASI RESET PASSWORD
                |--------------------------------------------------------------------------
                */

                if (resetPasswordForm) {

                    resetPasswordForm.addEventListener(
                        'submit',
                        function (event) {

                            const password =
                                document.getElementById(
                                    'newPassword'
                                ).value;


                            const confirmation =
                                document.getElementById(
                                    'confirmPassword'
                                ).value;


                            if (password.length < 8) {

                                event.preventDefault();

                                alert(
                                    'Password minimal 8 karakter.'
                                );

                                return;

                            }


                            if (password !== confirmation) {

                                event.preventDefault();

                                alert(
                                    'Konfirmasi password tidak sesuai.'
                                );

                                return;

                            }


                            /*
                            | Pastikan action tidak kosong
                            */

                            if (!resetPasswordForm.action) {

                                event.preventDefault();

                                alert(
                                    'URL reset password tidak ditemukan.'
                                );

                                return;

                            }

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | VALIDASI HAPUS ADMIN
                |--------------------------------------------------------------------------
                */

                if (hapusAdminForm) {

                    hapusAdminForm.addEventListener(
                        'submit',
                        function (event) {

                            if (!hapusAdminForm.action) {

                                event.preventDefault();

                                alert(
                                    'URL hapus admin tidak ditemukan.'
                                );

                                return;

                            }

                        }
                    );

                }

            });

        </script>

    </main>

</section>

@endsection