<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('masjid', function (Blueprint $table) {
            if (!Schema::hasColumn('masjid', 'jumlah_sound_system')) {
                $table->integer('jumlah_sound_system')->nullable()->after('sound_system');
            }
            if (!Schema::hasColumn('masjid', 'kondisi_ac')) {
                $table->string('kondisi_ac', 50)->nullable()->after('jumlah_ac');
            }
        });
    }

    public function down(): void
    {
        Schema::table('masjid', function (Blueprint $table) {
            $table->dropColumn(['jumlah_sound_system', 'kondisi_ac']);
        });
    }
};
