<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('masjid', function (Blueprint $table) {
            if (!Schema::hasColumn('masjid', 'foto_bangunan')) {
                $table->string('foto_bangunan', 255)->nullable();
            }
            if (!Schema::hasColumn('masjid', 'file_sk')) {
                $table->string('file_sk', 255)->nullable();
            }
            if (!Schema::hasColumn('masjid', 'file_sertifikat')) {
                $table->string('file_sertifikat', 255)->nullable();
            }
            if (!Schema::hasColumn('masjid', 'file_ktp')) {
                $table->string('file_ktp', 255)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('masjid', function (Blueprint $table) {
            $table->dropColumn(['foto_bangunan', 'file_sk', 'file_sertifikat', 'file_ktp']);
        });
    }
};
