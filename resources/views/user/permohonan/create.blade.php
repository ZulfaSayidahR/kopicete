@extends('layouts.app')

@section('title', 'Portal Permohonan')

@section('content')

<section class="pengaduan-page">

    <div class="container">

        <div class="permohonan-wrapper">

            {{-- =====================================================
                FORM PERMOHONAN
            ====================================================== --}}

            <div class="pengaduan-card">

                <div class="pengaduan-header">

                    <h4>Form Permohonan</h4>

                    <p>
                        Sampaikan permohonan kepada BNNK Tulungagung
                        dengan melengkapi seluruh data berikut.
                    </p>

                </div>


                <div class="pengaduan-body">

                    <form
                        action="{{ route('permohonan.konfirmasi') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        id="formPermohonan"
                    >

                        @csrf

                        <div class="row">

                            {{-- =====================================================
                                JENIS PERMOHONAN
                            ====================================================== --}}

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Jenis Permohonan
                                </label>

                            </div>


                            <div class="col-md-8 mb-3">

                                <select
                                    class="form-select"
                                    name="jenis_permohonan"
                                    id="jenis_permohonan"
                                    required
                                >

                                    <option value="" selected disabled>
                                        Pilih Jenis Permohonan
                                    </option>

                                    <option
                                        value="Sosialisasi"
                                        {{ old('jenis_permohonan') == 'Sosialisasi' ? 'selected' : '' }}
                                    >
                                        Permohonan Sosialisasi
                                    </option>

                                    <option
                                        value="Rehabilitasi"
                                        {{ old('jenis_permohonan') == 'Rehabilitasi' ? 'selected' : '' }}
                                    >
                                        Permohonan Rehabilitasi
                                    </option>

                                </select>


                                @error('jenis_permohonan')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- =====================================================
                                BAGIAN SOSIALISASI
                            ====================================================== --}}

                            <div
                                id="formSosialisasi"
                                class="row"
                                style="display: none;"
                            >

                                {{-- NAMA PENYELENGGARA --}}

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Nama Penyelenggara
                                    </label>

                                </div>


                                <div class="col-md-8 mb-3">

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nama_penyelenggara"
                                        id="nama_penyelenggara"
                                        placeholder="Masukkan nama penyelenggara"
                                        value="{{ old('nama_penyelenggara') }}"
                                    >


                                    @error('nama_penyelenggara')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- TANGGAL KEGIATAN --}}

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Tanggal Kegiatan
                                    </label>

                                </div>


                                <div class="col-md-8 mb-3">

                                    <input
                                        type="date"
                                        class="form-control"
                                        name="tanggal_kegiatan"
                                        id="tanggal_kegiatan"
                                        value="{{ old('tanggal_kegiatan') }}"
                                    >


                                    @error('tanggal_kegiatan')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- WAKTU KEGIATAN --}}

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Waktu Kegiatan
                                    </label>

                                </div>


                                <div class="col-md-8 mb-3">

                                    <input
                                        type="time"
                                        class="form-control"
                                        name="waktu_kegiatan"
                                        id="waktu_kegiatan"
                                        value="{{ old('waktu_kegiatan') }}"
                                    >


                                    @error('waktu_kegiatan')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- TEMPAT KEGIATAN --}}

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Tempat Kegiatan
                                    </label>

                                </div>


                                <div class="col-md-8 mb-3">

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="tempat"
                                        id="tempat"
                                        placeholder="Masukkan lokasi kegiatan"
                                        value="{{ old('tempat') }}"
                                    >


                                    @error('tempat')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- PENANGGUNG JAWAB --}}

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Nama Penanggung Jawab
                                    </label>

                                </div>


                                <div class="col-md-8 mb-3">

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="penanggung_jawab"
                                        id="penanggung_jawab"
                                        placeholder="Nama penanggung jawab"
                                        value="{{ old('penanggung_jawab') }}"
                                    >


                                    @error('penanggung_jawab')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- JUMLAH PESERTA --}}

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Jumlah Peserta
                                    </label>

                                </div>


                                <div class="col-md-8 mb-3">

                                    <input
                                        type="number"
                                        class="form-control"
                                        name="jumlah_peserta"
                                        id="jumlah_peserta"
                                        placeholder="Jumlah peserta"
                                        value="{{ old('jumlah_peserta') }}"
                                        min="1"
                                    >


                                    @error('jumlah_peserta')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                            </div>


                            {{-- =====================================================
                                BAGIAN REHABILITASI
                            ====================================================== --}}

                            <div
                                id="formRehabilitasi"
                                class="row"
                                style="display: none;"
                            >

                                {{-- NAMA PEMOHON --}}

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Nama Pemohon
                                    </label>

                                </div>


                                <div class="col-md-8 mb-3">

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nama_pemohon"
                                        id="nama_pemohon"
                                        placeholder="Masukkan nama pemohon"
                                        value="{{ old('nama_pemohon') }}"
                                    >


                                    @error('nama_pemohon')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- NIK --}}

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        NIK
                                    </label>

                                </div>


                                <div class="col-md-8 mb-3">

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nik"
                                        id="nik"
                                        placeholder="Masukkan NIK"
                                        value="{{ old('nik') }}"
                                        maxlength="20"
                                    >


                                    @error('nik')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- ALAMAT PEMOHON --}}

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Alamat Pemohon
                                    </label>

                                </div>


                                <div class="col-md-8 mb-3">

                                    <textarea
                                        class="form-control"
                                        name="alamat_pemohon"
                                        id="alamat_pemohon"
                                        rows="4"
                                        placeholder="Masukkan alamat lengkap pemohon"
                                    >{{ old('alamat_pemohon') }}</textarea>


                                    @error('alamat_pemohon')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- JENIS REHABILITASI --}}

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Jenis Rehabilitasi
                                    </label>

                                </div>


                                <div class="col-md-8 mb-3">

                                    <select
                                        class="form-select"
                                        name="jenis_rehabilitasi"
                                        id="jenis_rehabilitasi"
                                    >

                                        <option value="" selected disabled>
                                            Pilih Jenis Rehabilitasi
                                        </option>

                                        <option
                                            value="Rawat Jalan"
                                            {{ old('jenis_rehabilitasi') == 'Rawat Jalan' ? 'selected' : '' }}
                                        >
                                            Rawat Jalan
                                        </option>

                                        <option
                                            value="Rawat Inap"
                                            {{ old('jenis_rehabilitasi') == 'Rawat Inap' ? 'selected' : '' }}
                                        >
                                            Rawat Inap
                                        </option>

                                        <option
                                            value="Konsultasi"
                                            {{ old('jenis_rehabilitasi') == 'Konsultasi' ? 'selected' : '' }}
                                        >
                                            Konsultasi
                                        </option>

                                    </select>


                                    @error('jenis_rehabilitasi')

                                        <div class="text-danger small mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                            </div>


                            {{-- =====================================================
                                NO WHATSAPP
                            ====================================================== --}}

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    No WhatsApp
                                </label>

                            </div>


                            <div class="col-md-8 mb-3">

                                <input
                                    type="text"
                                    class="form-control"
                                    name="no_hp"
                                    id="no_hp"
                                    placeholder="08xxxxxxxxxx"
                                    value="{{ old('no_hp') }}"
                                    maxlength="20"
                                    required
                                >

                                <div class="form-note">
                                    Nomor ini digunakan untuk mengirim kode OTP melalui WhatsApp.
                                </div>


                                @error('no_hp')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- =====================================================
                                KETERANGAN
                            ====================================================== --}}

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Keterangan
                                </label>

                            </div>


                            <div class="col-md-8 mb-3">

                                <textarea
                                    class="form-control"
                                    name="keterangan"
                                    rows="5"
                                    placeholder="Tuliskan keterangan tambahan jika diperlukan"
                                >{{ old('keterangan') }}</textarea>


                                @error('keterangan')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- =====================================================
                                LAMPIRAN
                            ====================================================== --}}

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Lampiran Surat Permohonan
                                </label>

                            </div>


                            <div class="col-md-8 mb-3">

                                <input
                                    type="file"
                                    class="form-control"
                                    name="lampiran"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                >

                                <div class="form-note">
                                    Format PDF / JPG / PNG maksimal 5 MB.
                                </div>


                                @error('lampiran')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>


                        {{-- =====================================================
                            NAVIGASI
                        ====================================================== --}}

                        <div class="form-navigation">

                            <a
                                href="{{ route('home') }}"
                                class="btn-prev"
                            >
                                Sebelumnya
                            </a>


                            <button
                                type="submit"
                                class="btn-next"
                            >
                                Selanjutnya
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- =====================================================
                SIDEBAR PERMOHONAN TERBARU
            ====================================================== --}}

            <!-- <aside class="sidebar-aduan">

                <div class="aduan-terbaru-header">

                    <h4>
                        Permohonan Terbaru
                    </h4>

                </div>


                {{-- =====================================================
                    SEARCH PERMOHONAN
                ====================================================== --}}

                <div class="search-permohonan-box">

                    <form
                        action="{{ route('permohonan.cari') }}"
                        method="GET"
                    >

                        <div class="search-permohonan-wrapper">

                            <div class="search-permohonan-input-wrapper">

                                <i class="bi bi-search"></i>

                                <input
                                    type="text"
                                    name="jenis_permohonan"
                                    value="{{ request('jenis_permohonan') }}"
                                    placeholder="Cari berdasarkan jenis permohonan..."
                                    autocomplete="off"
                                >

                            </div>


                            <button
                                type="submit"
                                class="btn-search-permohonan"
                            >

                                <i class="bi bi-search"></i>

                                Cari

                            </button>

                        </div>

                    </form>

                </div>


                {{-- =====================================================
                    DATA PERMOHONAN
                ====================================================== --}}

                @forelse($permohonanTerbaru as $item)

                    <div class="aduan-item">

                        {{-- STATUS --}}

                        <span
                            class="status
                                @if($item->status == 'Diajukan')
                                    menunggu
                                @elseif($item->status == 'Diverifikasi')
                                    verifikasi
                                @elseif($item->status == 'Diproses')
                                    proses
                                @elseif($item->status == 'Selesai')
                                    selesai
                                @elseif($item->status == 'Ditolak')
                                    ditolak
                                @endif
                            "
                        >
                            {{ $item->status }}
                        </span>


                        {{-- JENIS PERMOHONAN --}}

                        <h6>
                            {{ \Illuminate\Support\Str::limit($item->jenis_permohonan, 40) }}
                        </h6>


                        {{-- NAMA --}}

                        <small>

                            <i class="bi bi-person-fill"></i>

                            @if($item->jenis_permohonan === 'Sosialisasi')

                                {{ \Illuminate\Support\Str::limit($item->nama_penyelenggara ?? '-', 30) }}

                            @elseif($item->jenis_permohonan === 'Rehabilitasi')

                                {{ \Illuminate\Support\Str::limit($item->nama_pemohon ?? '-', 30) }}

                            @endif

                        </small>


                        {{-- TANGGAL --}}

                        <small>

                            <i class="bi bi-calendar-event-fill"></i>

                            {{ $item->created_at->translatedFormat('d F Y') }}

                        </small>


                        {{-- TRACKING --}}

                        <a
                            href="{{ route('permohonan.tracking', $item->kode_permohonan) }}"
                            class="btn-detail-laporan"
                        >

                            <i class="bi bi-eye-fill"></i>

                            Lihat Tracking

                        </a>

                    </div>

                @empty

                    <div class="alert alert-light">

                        <i class="bi bi-info-circle me-1"></i>

                        Belum ada permohonan.

                    </div>

                @endforelse

            </aside> -->

        </div>

    </div>

</section>


{{-- =====================================================
    JAVASCRIPT FORM DINAMIS
====================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const jenisPermohonan =
        document.getElementById('jenis_permohonan');

    const formSosialisasi =
        document.getElementById('formSosialisasi');

    const formRehabilitasi =
        document.getElementById('formRehabilitasi');


    /*
    |--------------------------------------------------------------------------
    | FIELD SOSIALISASI
    |--------------------------------------------------------------------------
    */

    const fieldSosialisasi = [
        'nama_penyelenggara',
        'tanggal_kegiatan',
        'waktu_kegiatan',
        'tempat',
        'penanggung_jawab',
        'jumlah_peserta'
    ];


    /*
    |--------------------------------------------------------------------------
    | FIELD REHABILITASI
    |--------------------------------------------------------------------------
    */

    const fieldRehabilitasi = [
        'nama_pemohon',
        'nik',
        'alamat_pemohon',
        'jenis_rehabilitasi'
    ];


    /*
    |--------------------------------------------------------------------------
    | UPDATE FORM
    |--------------------------------------------------------------------------
    */

    function updateForm() {

        const jenis = jenisPermohonan.value;


        /*
        |--------------------------------------------------------------------------
        | SEMBUNYIKAN SEMUA FORM
        |--------------------------------------------------------------------------
        */

        formSosialisasi.style.display = 'none';

        formRehabilitasi.style.display = 'none';


        /*
        |--------------------------------------------------------------------------
        | HAPUS REQUIRED
        |--------------------------------------------------------------------------
        */

        fieldSosialisasi.forEach(function (field) {

            const element =
                document.getElementById(field);

            if (element) {

                element.required = false;

            }

        });


        fieldRehabilitasi.forEach(function (field) {

            const element =
                document.getElementById(field);

            if (element) {

                element.required = false;

            }

        });


        /*
        |--------------------------------------------------------------------------
        | SOSIALISASI
        |--------------------------------------------------------------------------
        */

        if (jenis === 'Sosialisasi') {

            formSosialisasi.style.display = 'block';


            fieldSosialisasi.forEach(function (field) {

                const element =
                    document.getElementById(field);

                if (element) {

                    element.required = true;

                }

            });

        }


        /*
        |--------------------------------------------------------------------------
        | REHABILITASI
        |--------------------------------------------------------------------------
        */

        if (jenis === 'Rehabilitasi') {

            formRehabilitasi.style.display = 'block';


            fieldRehabilitasi.forEach(function (field) {

                const element =
                    document.getElementById(field);

                if (element) {

                    element.required = true;

                }

            });

        }

    }


    /*
    |--------------------------------------------------------------------------
    | EVENT CHANGE
    |--------------------------------------------------------------------------
    */

    jenisPermohonan.addEventListener(
        'change',
        updateForm
    );


    /*
    |--------------------------------------------------------------------------
    | JALANKAN SAAT HALAMAN DIBUKA
    |--------------------------------------------------------------------------
    */

    updateForm();

});

</script>

@endsection