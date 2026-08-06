<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {

            $table->timestamp('tanggal_verifikasi')->nullable();

            $table->timestamp('tanggal_proses')->nullable();

            $table->timestamp('tanggal_selesai')->nullable();

            $table->text('catatan_admin')->nullable();

            $table->string('foto_tindak_lanjut')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {

            $table->dropColumn([
                'tanggal_verifikasi',
                'tanggal_proses',
                'tanggal_selesai',
                'catatan_admin',
                'foto_tindak_lanjut'
            ]);

        });
    }
};