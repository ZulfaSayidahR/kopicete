<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {

            // VERIFIKASI
            $table->text('catatan_verifikasi')->nullable();
            $table->string('foto_verifikasi')->nullable();

            // PROSES
            $table->text('catatan_proses')->nullable();
            $table->string('foto_proses')->nullable();

            // SELESAI
            $table->text('catatan_selesai')->nullable();
            $table->string('foto_selesai')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {

            $table->dropColumn([
                'catatan_verifikasi',
                'foto_verifikasi',
                'catatan_proses',
                'foto_proses',
                'catatan_selesai',
                'foto_selesai',
            ]);

        });
    }
};