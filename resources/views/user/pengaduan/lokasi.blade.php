@extends('layouts.app')

@section('title', 'Portal Pengaduan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-wrapper">

                <!-- =========================================
                                                                        FORM STEP 2
                                                                ========================================== -->

                <div class="pengaduan-card">

                    <div class="pengaduan-header">

                        <h4>Form Pengaduan</h4>

                        <p>
                            Sampaikan keluhan atau saran Anda dengan lengkap.
                        </p>

                    </div>

                    <div class="pengaduan-body">

                        <!-- STEP -->

                        <div class="stepper">

                            <div class="step selesai">
                                <div class="step-number">✓</div>
                                <div class="step-title">Data Aduan</div>
                            </div>

                            <div class="step active">
                                <div class="step-number">2</div>
                                <div class="step-title">Lokasi & Lampiran</div>
                            </div>

                            <div class="step">
                                <div class="step-number">3</div>
                                <div class="step-title">Data Pelapor</div>
                            </div>

                            <div class="step">
                                <div class="step-number">4</div>
                                <div class="step-title">Konfirmasi</div>
                            </div>

                        </div>

                        <form action="{{ route('pengaduan.storeStep2') }}" method="POST" enctype="multipart/form-data">

                            @csrf


                            <div class="mb-3">
                                <label class="form-label">Alamat Kejadian</label>

                                <textarea name="alamat_kejadian" class="form-control" rows="3"
                                    required>{{ old('alamat_kejadian', $step2['alamat_kejadian'] ?? '') }}</textarea>
                            </div>

                            <div class="row">


                                <!-- KECAMATAN -->

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Kecamatan
                                    </label>


                                    <select class="form-select" name="id_kecamatan" id="kecamatan" required>


                                        <option value="">
                                            Pilih Kecamatan
                                        </option>


                                        @foreach($kecamatan as $item)

                                            <option value="{{ $item->id_kecamatan }}">

                                                {{ $item->nama_kecamatan }}

                                            </option>



                                        @endforeach


                                    </select>


                                </div>



                                <!-- DESA -->

                                <div class="col-md-6 mb-3">


                                    <label class="form-label">

                                        Desa

                                    </label>



                                    <select class="form-select" name="id_desa" id="desa" required>


                                        <option value="">
                                            Pilih Kecamatan Terlebih Dahulu
                                        </option>


                                    </select>


                                </div>


                            </div>

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    <i class="bi bi-paperclip"></i>
                                    Lampiran Bukti

                                </label>

                                <input type="file" name="lampiran" id="lampiran"
                                    class="form-control @error('lampiran') is-invalid @enderror" accept=".jpg,.jpeg,.png">

                                @error('lampiran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="text-muted d-block mt-2">

                                    Maksimal <strong>5 MB</strong>.<br>
                                    Format yang diperbolehkan:
                                    <strong>JPG, JPEG, PNG</strong>.

                                </small>

                                <div id="previewLampiran" class="mt-3 d-none">

                                    <div class="card shadow-sm">

                                        <div class="card-body text-center">

                                            <img id="previewImage" class="img-fluid rounded" style="max-height:300px;">

                                            <p id="namaFile" class="mt-3 mb-0 text-secondary fw-semibold"></p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="alert alert-warning">

                                <div class="form-check">

                                    <input class="form-check-input" type="checkbox" name="pernyataan" value="setuju"
                                        required>

                                    <label class="form-check-label">

                                        Saya menyatakan bahwa laporan ini benar
                                        dan dapat dipertanggungjawabkan.

                                    </label>

                                </div>

                            </div>
                            <!-- <div class="mb-4">

                                                <label class="form-label">

                                                    Verifikasi Keamanan

                                                </label>

                                                <div class="border rounded p-3">

                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" required>

                                                        <label class="form-check-label">

                                                            Saya bukan robot

                                                        </label>

                                                    </div>

                                                </div>

                                            </div> -->

                            <div class="form-navigation">

                                <a href="{{ route('pengaduan.create') }}" class="btn btn-secondary">

                                    Sebelumnya

                                </a>


                                <button type="submit" class="btn-next">

                                    Selanjutnya

                                </button>

                            </div>
                        </form>

                    </div>

                </div>

                <!-- ==========================================
                                                                                                        SIDEBAR
                                                                                                =========================================== -->

                <aside class="sidebar-aduan">

                    <div class="sidebar-header">

                        <h5>Aduan Terbaru</h5>

                        <button class="btn-sidebar">

                            <i class="bi bi-search"></i>

                            Jelajah

                        </button>

                    </div>

                    <div class="aduan-item">

                        <span class="status verifikasi">
                            Verifikasi
                        </span>

                        <h6>
                            Dugaan Penyalahgunaan Narkotika
                        </h6>

                        <small>

                            <i class="bi bi-geo-alt-fill"></i>

                            Terminal Gayatri

                        </small>
                        <small>
                            <i class="bi bi-calendar-event-fill"></i>
                            09 Juli 2026
                        </small>

                    </div>

                    <div class="aduan-item">

                        <span class="status selesai">
                            Selesai
                        </span>

                        <h6>
                            Dugaan Peredaran Gelap
                        </h6>

                        <small>

                            <i class="bi bi-geo-alt-fill"></i>

                            Kecamatan Campurdarat

                        </small>
                        <small>
                            <i class="bi bi-calendar-event-fill"></i>
                            01 Juli 2026
                        </small>

                    </div>

                    <div class="aduan-item">

                        <span class="status proses">
                            Diproses
                        </span>

                        <h6>
                            Dugaan Penyalahgunaan
                        </h6>

                        <small>

                            <small>
                                <i class="bi bi-geo-alt-fill"></i>
                                Kecamatan Bandung
                            </small>

                            <small>
                                <i class="bi bi-calendar-event-fill"></i>
                                09 Juli 2026
                            </small>

                        </small>

                    </div>

                </aside>


            </div>

        </div>

    </section>
    <script>

        document
            .getElementById('kecamatan')
            .addEventListener('change', function () {


                let idKecamatan = this.value;


                let desa = document.getElementById('desa');



                desa.innerHTML = `
                                        <option>
                                            Memuat desa...
                                        </option>
                                    `;



                if (idKecamatan == '') {

                    desa.innerHTML = `
                                            <option>
                                                Pilih Kecamatan Terlebih Dahulu
                                            </option>
                                        `;

                    return;

                }



                fetch(
                    "{{ url('/pengaduan/get-desa') }}/"
                    + idKecamatan
                )


                    .then(response => response.json())


                    .then(data => {


                        desa.innerHTML = `
                                            <option value="">
                                                Pilih Desa
                                            </option>
                                        `;



                        data.forEach(item => {


                            desa.innerHTML += `

                                                <option value="${item.id_desa}">

                                                    ${item.nama_desa}

                                                </option>

                                            `;


                        });



                    });



            });


        document.getElementById('lampiran').addEventListener('change', function (e) {

            const file = e.target.files[0];

            if (!file) return;

            document.getElementById('namaFile').innerHTML = file.name;

            const reader = new FileReader();

            reader.onload = function (event) {

                document.getElementById('previewImage').src = event.target.result;

                document.getElementById('previewLampiran').classList.remove('d-none');

            }

            reader.readAsDataURL(file);

        });

    </script>

@endsection