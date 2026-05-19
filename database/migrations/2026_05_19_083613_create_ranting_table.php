<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ranting', function (Blueprint $table) {
            $table->string('id_ranting', 10)->primary();
            $table->string('nama_ranting', 100);
            $table->string('status_keaktifan_ranting', 50)->nullable();
            $table->string('id_cabang', 10)->nullable();
            $table->foreign('id_cabang')->references('id_cabang')->on('cabang');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ranting');
    }
};
