<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pcm_id')->constrained('pcm')->cascadeOnDelete();
            $table->string('nama');
            $table->string('kelurahan')->nullable();
            $table->string('ketua')->nullable();
            $table->year('tahun_berdiri')->nullable();
            $table->enum('status', ['Aktif', 'Kurang Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->unsignedTinyInteger('skor_keaktifan')->default(0)->comment('Skor 0-100');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prm');
    }
};
