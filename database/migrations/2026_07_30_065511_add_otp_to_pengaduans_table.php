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
        Schema::table('pengaduans', function (Blueprint $table) {

            $table->string('otp', 6)
                ->nullable();

            $table->timestamp('otp_expired')
                ->nullable();

        });
    }


    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            //
        });
    }
};
