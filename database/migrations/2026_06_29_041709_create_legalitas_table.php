<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legalitas', function (Blueprint $table) {
            $table->string('id_legalitas', 10)->primary();
            $table->string('id_masjid', 10);
            $table->foreign('id_masjid')->references('id_masjid')->on('masjid')->onDelete('cascade');
            $table->string('jenis_sertifikat', 50);
            $table->string('nomor_sertifikat', 50)->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->enum('status', ['aktif', 'tidak aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legalitas');
    }
};