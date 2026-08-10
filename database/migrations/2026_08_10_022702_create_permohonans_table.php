<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permohonans', function (Blueprint $table) {

            $table->id();

            // Kode unik permohonan
            $table->string('kode_permohonan')->unique();

            // Informasi permohonan
            $table->string('jenis_permohonan');

            $table->string('nama_penyelenggara');

            // Informasi kegiatan
            $table->date('tanggal_kegiatan');

            $table->time('waktu_kegiatan');

            $table->string('tempat');

            // Penanggung jawab
            $table->string('penanggung_jawab');

            $table->string('no_hp', 20);

            // Jumlah peserta
            $table->unsignedInteger('jumlah_peserta');

            // Keterangan tambahan
            $table->text('keterangan')->nullable();

            // Lampiran surat
            $table->string('lampiran')->nullable();

            // Status permohonan
            $table->string('status')->default('Menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};