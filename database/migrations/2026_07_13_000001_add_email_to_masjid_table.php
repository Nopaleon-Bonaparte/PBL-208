<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('masjid', function (Blueprint $table) {
            if (!Schema::hasColumn('masjid', 'email')) {
                $table->string('email', 150)->nullable()->after('kontak_pengurus');
            }
        });
    }

    public function down(): void
    {
        Schema::table('masjid', function (Blueprint $table) {
            $table->dropColumn(['email']);
        });
    }
};
