<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('master_ranting', function (Blueprint $table) {
        $table->string('id_ranting', 10)->primary();
        $table->string('id_cabang', 10);
        $table->string('nama_ranting', 150);
        $table->enum('status_keaktifan_ranting', ['Aktif', 'Kurang Aktif', 'Vakum'])->default('Aktif');
        $table->timestamps();
        $table->foreign('id_cabang')
              ->references('id_cabang')->on('master_cabang')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_rantings');
    }
};
