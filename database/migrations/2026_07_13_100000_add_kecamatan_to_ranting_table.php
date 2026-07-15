<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ranting', function (Blueprint $table) {
            // Kecamatan wilayah kerja ranting ini (satu ranting umumnya mencakup satu kecamatan)
            $table->string('kecamatan', 100)->nullable()->after('id_cabang');
        });
    }

    public function down(): void
    {
        Schema::table('ranting', function (Blueprint $table) {
            $table->dropColumn('kecamatan');
        });
    }
};
