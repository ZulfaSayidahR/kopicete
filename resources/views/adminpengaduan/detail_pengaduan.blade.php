@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')

    <section class="sa-dashboard" id="superAdminDashboard">

        @include('layouts.sidebar_admin_pengaduan')

        <main class="sa-main">

            {{-- Header --}}
            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button class="sa-toggle-sidebar">
                        <i class="bi bi-list" id="toggleSidebar"></i>
                    </button>

                    <div class="sa-page-heading">

                        <h1>Detail Pengaduan</h1>

                        <p>Informasi lengkap pengaduan masyarakat.</p>

                    </div>

                </div>

            </header>



            <div class="row mt-4">

                {{-- KIRI --}}
                <div class="col-lg-7">

                    {{-- Informasi --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">
                            <h3>Informasi Pengaduan</h3>
                        </div>

                        <div class="p-4">

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <strong>Token</strong>

                                    <p>PHGSHJBJ</p>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Kategori</strong>

                                    <p>Penyalahgunaan Narkoba</p>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Kecamatan</strong>

                                    <p>Campurdarat</p>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Tanggal</strong>

                                    <p>4 Juli 2026</p>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Nomor Pelapor</strong>

                                    <p>085612345678</p>

                                </div>

                            </div>

                            <hr>

                            <strong>Kronologi</strong>

                            <p>

                                Pelapor melihat aktivitas yang diduga
                                merupakan transaksi narkoba di sekitar
                                wilayah Campurdarat.

                            </p>

                        </div>

                    </div>



                    {{-- Lampiran --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">

                            <h3>Lampiran Bukti</h3>

                        </div>

                        <div class="p-4 text-center">

                            <img src="{{ asset('images/contoh.jpg') }}" class="img-fluid rounded">

                        </div>

                    </div>

                </div>



                {{-- KANAN --}}
                <div class="col-lg-5">

                    {{-- ================= RIWAYAT STATUS ================= --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">
                            <h3>Riwayat Status</h3>
                        </div>

                        <div class="p-4">

                            <div class="status-timeline">

                                {{-- Aktif --}}
                                <div class="timeline-item active">
                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">
                                        <h6>Diajukan</h6>
                                        <small>4 Jul, 09:40</small>
                                    </div>
                                </div>

                                {{-- Aktif --}}
                                <div class="timeline-item active">
                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">
                                        <h6>Diverifikasi Admin BNNK</h6>
                                        <small>4 Jul, 11:15</small>
                                    </div>
                                </div>

                                {{-- Belum --}}
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">
                                        <h6>Diproses Lapangan</h6>
                                        <small>Menunggu</small>
                                    </div>
                                </div>

                                {{-- Belum --}}
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">
                                        <h6>Selesai / Diteruskan BNNK</h6>
                                        <small>Menunggu</small>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- Update Status --}}
                    <div class="sa-panel mt-4">

    <div class="sa-panel-header">

        <h3>Verifikasi</h3>

    </div>

    <div class="p-4">

        <form action="{{ route('adminpengaduan.update_pengaduan') }}"
      method="POST"
      enctype="multipart/form-data">

            @csrf

            {{-- Status --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Status
                </label>

                <select class="form-select" name="status">

                    <option value="Diajukan">Diajukan</option>
                    <option value="Diverifikasi">Diverifikasi</option>
                    <option value="Diproses Lapangan">Diproses Lapangan</option>
                    <option value="Selesai">Selesai</option>

                </select>

            </div>

            {{-- Catatan --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Catatan Admin
                </label>

                <textarea
                    class="form-control"
                    name="catatan"
                    rows="4"
                    placeholder="Masukkan catatan hasil verifikasi..."></textarea>

            </div>

            {{-- Upload Bukti --}}
            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Upload Bukti Tindak Lanjut
                </label>

                <input
                    type="file"
                    name="bukti"
                    id="bukti"
                    class="form-control file-upload"
                    accept="image/*">

                <small class="text-muted">
                    Format: JPG, JPEG, PNG. Maksimal 2 MB.
                </small>

                {{-- Preview --}}
                <div class="mt-3">

                    <img
                        id="previewBukti"
                        src="#"
                        alt="Preview Bukti"
                        class="img-fluid rounded shadow"
                        style="display:none; max-height:250px;">

                </div>

            </div>

            <div class="d-grid">

                <button type="submit" class="btn btn-primary">

                    <i class="bi bi-check-circle-fill"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>
                </div>

            </div>

        </main>

    </section>

@endsection

<script>
document.getElementById('bukti').addEventListener('change', function (e) {

    const file = e.target.files[0];
    const preview = document.getElementById('previewBukti');

    if (file) {

        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';

    } else {

        preview.style.display = 'none';

    }

});
</script>