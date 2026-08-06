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
        Schema::create('pengaduans', function (Blueprint $table) {

            $table->id();

            // Kode Aduan
            $table->string('kode_aduan')->unique();

            // Data Aduan
            $table->string('judul_aduan');
            $table->string('topik_aduan');
            $table->text('detail_aduan');

            // Lokasi
            $table->unsignedBigInteger('id_kecamatan');
            $table->unsignedBigInteger('id_desa');

            // Lampiran
            $table->string('lampiran')->nullable();

            // Data Pelapor
            $table->string('nama_lengkap');
            $table->string('no_whatsapp');
            $table->string('email')->nullable();
            $table->text('alamat_domisili');

            // OTP
            $table->string('otp', 6)->nullable();
            $table->timestamp('otp_expired')->nullable();
            $table->timestamp('otp_verified_at')->nullable();

            // Status Aduan
            $table->enum('status', [
                'Menunggu',
                'Diproses',
                'Selesai',
                'Ditolak'
            ])->default('Menunggu');

            $table->timestamps();

            // Foreign Key Kecamatan
            $table->foreign('id_kecamatan')
                ->references('id_kecamatan')
                ->on('kecamatan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Foreign Key Desa
            $table->foreign('id_desa')
                ->references('id_desa')
                ->on('desa')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {

            $table->dropForeign(['id_kecamatan']);
            $table->dropForeign(['id_desa']);

        });

        Schema::dropIfExists('pengaduans');
    }
};