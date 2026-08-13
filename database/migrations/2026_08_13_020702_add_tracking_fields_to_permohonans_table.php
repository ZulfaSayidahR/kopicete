<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {

            $table->dateTime('tanggal_verifikasi')
                ->nullable();

            $table->text('catatan_verifikasi')
                ->nullable();

            $table->dateTime('tanggal_proses')
                ->nullable();

            $table->text('catatan_proses')
                ->nullable();

            $table->dateTime('tanggal_selesai')
                ->nullable();

            $table->text('catatan_selesai')
                ->nullable();

        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {

            $table->dropColumn([
                'tanggal_verifikasi',
                'catatan_verifikasi',
                'tanggal_proses',
                'catatan_proses',
                'tanggal_selesai',
                'catatan_selesai',
            ]);

        });
    }
};