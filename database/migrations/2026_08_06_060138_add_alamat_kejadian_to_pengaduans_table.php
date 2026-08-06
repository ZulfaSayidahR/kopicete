<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {

            $table->text('alamat_kejadian')
                ->nullable()
                ->after('id_desa');

        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {

            $table->dropColumn('alamat_kejadian');

        });
    }
};