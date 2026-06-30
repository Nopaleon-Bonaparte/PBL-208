<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('takmir', function (Blueprint $table) {
            $table->string('id_takmir', 10)->primary();
            $table->string('id_masjid', 10);
            $table->foreign('id_masjid')->references('id_masjid')->on('masjid')->onDelete('cascade');
            $table->string('nama', 100);
            $table->string('jabatan', 50);
            $table->string('no_hp', 15)->nullable();
            $table->date('masa_jabatan_mulai')->nullable();
            $table->date('masa_jabatan_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('takmir');
    }
};