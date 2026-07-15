<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->string('id_inventaris', 10)->primary();
            $table->string('id_masjid', 10);
            $table->foreign('id_masjid')->references('id_masjid')->on('masjid')->onDelete('cascade');
            $table->string('nama_barang', 100);
            $table->integer('jumlah');
            $table->enum('kondisi', ['baik', 'rusak ringan', 'rusak berat']);
            $table->date('tanggal_pengadaan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};