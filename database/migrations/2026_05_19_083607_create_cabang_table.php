<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->string('id_cabang', 10)->primary();
            $table->string('nama_cabang', 100);
            $table->string('status_keaktifan_cabang', 50)->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('cabang');
    }
};
