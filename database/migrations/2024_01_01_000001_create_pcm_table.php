<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pcm', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kecamatan');
            $table->string('ketua')->nullable();
            $table->string('sekretaris')->nullable();
            $table->year('tahun_berdiri')->nullable();
            $table->enum('status', ['Aktif', 'Kurang Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pcm');
    }
};
