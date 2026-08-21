<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | DATA REHABILITASI
            |--------------------------------------------------------------------------
            */

            $table->string('nama_pemohon')
                ->nullable()
                ->after('jumlah_peserta');

            $table->string('nik', 20)
                ->nullable()
                ->after('nama_pemohon');

            $table->text('alamat_pemohon')
                ->nullable()
                ->after('nik');

            $table->string('jenis_rehabilitasi')
                ->nullable()
                ->after('alamat_pemohon');


            /*
            |--------------------------------------------------------------------------
            | FILE / DOKUMEN ADMIN
            |--------------------------------------------------------------------------
            */

            $table->string('file_verifikasi')
                ->nullable()
                ->after('catatan_verifikasi');

            $table->string('file_proses')
                ->nullable()
                ->after('catatan_proses');

            $table->string('file_selesai')
                ->nullable()
                ->after('catatan_selesai');


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            |
            | Kolom status tetap VARCHAR.
            | Kita tidak menggunakan ENUM agar lebih fleksibel.
            |
            */

            $table->string('status')
                ->default('Diajukan')
                ->change();

        });


        /*
        |--------------------------------------------------------------------------
        | DATA LAMA
        |--------------------------------------------------------------------------
        |
        | Data lama yang masih menggunakan status "Menunggu"
        | kita ubah menjadi "Diajukan".
        |
        */

        DB::table('permohonans')
            ->where('status', 'Menunggu')
            ->update([
                'status' => 'Diajukan'
            ]);
    }


    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {

            $table->dropColumn([
                'nama_pemohon',
                'nik',
                'alamat_pemohon',
                'jenis_rehabilitasi',
                'file_verifikasi',
                'file_proses',
                'file_selesai',
            ]);

        });

        /*
        |--------------------------------------------------------------------------
        | Kembalikan status menjadi Menunggu
        |--------------------------------------------------------------------------
        */

        DB::table('permohonans')
            ->where('status', 'Diajukan')
            ->update([
                'status' => 'Menunggu'
            ]);

        Schema::table('permohonans', function (Blueprint $table) {

            $table->string('status')
                ->default('Menunggu')
                ->change();

        });
    }
};