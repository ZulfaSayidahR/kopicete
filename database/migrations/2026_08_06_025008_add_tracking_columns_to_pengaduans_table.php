<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {

            if (!Schema::hasColumn('pengaduans', 'tanggal_verifikasi')) {
                $table->timestamp('tanggal_verifikasi')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'tanggal_proses')) {
                $table->timestamp('tanggal_proses')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'tanggal_selesai')) {
                $table->timestamp('tanggal_selesai')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'catatan_admin')) {
                $table->text('catatan_admin')->nullable();
            }

            if (!Schema::hasColumn('pengaduans', 'foto_tindak_lanjut')) {
                $table->string('foto_tindak_lanjut')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {

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