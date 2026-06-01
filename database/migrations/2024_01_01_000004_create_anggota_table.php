<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prm_id')->nullable()->constrained('prm')->nullOnDelete();
            $table->string('nbm', 20)->unique()->nullable()->comment('Nomor Baku Muhammadiyah');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email')->nullable();
            $table->enum('pendidikan_terakhir', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3', 'Lainnya'])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->enum('status_keanggotaan', ['Aktif', 'Tidak Aktif', 'Meninggal'])->default('Aktif');
            $table->year('tahun_masuk')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
