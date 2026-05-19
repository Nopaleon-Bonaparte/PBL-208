<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masjid', function (Blueprint $table) {
            $table->string('id_masjid', 10)->primary();
            $table->string('nama_masjid', 100);
            $table->string('status_legalitas', 50)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('masjid');
    }
};
