<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masjid', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->unsignedInteger('kapasitas')->nullable()->comment('Jumlah jamaah');
            $table->year('tahun_berdiri')->nullable();
            $table->enum('status', ['Aktif', 'Dalam Perbaikan', 'Tidak Aktif'])->default('Aktif');
            $table->boolean('is_wakaf')->default(false);
            $table->decimal('luas_tanah', 10, 2)->nullable()->comment('Dalam m2');
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masjid');
    }
};
