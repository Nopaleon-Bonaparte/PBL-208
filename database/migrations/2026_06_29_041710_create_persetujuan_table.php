<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persetujuan', function (Blueprint $table) {
            $table->string('id_persetujuan', 10)->primary();
            $table->string('id_pengajuan', 10);
            $table->foreign('id_pengajuan')->references('id_pengajuan')->on('pengajuan')->onDelete('cascade');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persetujuan');
    }
};