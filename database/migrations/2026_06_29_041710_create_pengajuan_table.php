<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->string('id_pengajuan', 10)->primary();
            $table->string('id_masjid', 10);
            $table->foreign('id_masjid')->references('id_masjid')->on('masjid')->onDelete('cascade');
            $table->enum('jenis_pengajuan', ['legalitas', 'inventaris', 'takmir']);
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};