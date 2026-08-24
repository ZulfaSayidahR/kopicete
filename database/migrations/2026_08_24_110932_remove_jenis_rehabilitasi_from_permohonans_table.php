<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropColumn('jenis_rehabilitasi');
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->string('jenis_rehabilitasi')->nullable();
        });
    }
};