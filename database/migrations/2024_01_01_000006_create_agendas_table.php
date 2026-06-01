<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->time('jam')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->enum('status', ['Terjadwal', 'Berlangsung', 'Selesai', 'Dibatalkan'])->default('Terjadwal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
