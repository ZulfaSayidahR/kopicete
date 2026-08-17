<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::statement("
            ALTER TABLE pengaduans
            MODIFY status ENUM(
                'Diverifikasi',
                'Diproses',
                'Selesai',
                'Ditolak'
            ) NOT NULL DEFAULT 'Diverifikasi'
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE pengaduans
            MODIFY status ENUM(
                'Menunggu',
                'Diproses',
                'Selesai',
                'Ditolak'
            ) NOT NULL DEFAULT 'Menunggu'
        ");
    }
};