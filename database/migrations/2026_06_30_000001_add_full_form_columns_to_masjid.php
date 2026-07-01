<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menambah kolom-kolom dari form lengkap "Tambah Masjid" asli
 * agar seluruh field tersimpan ke database.
 */
class AddFullFormColumnsToMasjid extends Migration
{
    public function up(): void
    {
        Schema::table('masjid', function (Blueprint $table) {
            // Informasi Dasar
            if (!Schema::hasColumn('masjid', 'kecamatan'))        $table->string('kecamatan', 50)->nullable();
            if (!Schema::hasColumn('masjid', 'kelurahan'))        $table->string('kelurahan', 50)->nullable();
            if (!Schema::hasColumn('masjid', 'kapasitas'))        $table->integer('kapasitas')->default(0);
            if (!Schema::hasColumn('masjid', 'no_sk'))            $table->string('no_sk', 100)->nullable();
            // Legalitas & Wakaf
            if (!Schema::hasColumn('masjid', 'status_tanah'))     $table->string('status_tanah', 50)->nullable();
            if (!Schema::hasColumn('masjid', 'jenis_sertifikat')) $table->string('jenis_sertifikat', 50)->nullable();
            if (!Schema::hasColumn('masjid', 'no_sertifikat'))    $table->string('no_sertifikat', 100)->nullable();
            if (!Schema::hasColumn('masjid', 'nama_nazir'))       $table->string('nama_nazir', 100)->nullable();
            // Inventaris & Fasilitas
            if (!Schema::hasColumn('masjid', 'sound_system'))     $table->string('sound_system', 30)->nullable();
            if (!Schema::hasColumn('masjid', 'jumlah_ac'))        $table->integer('jumlah_ac')->nullable();
            if (!Schema::hasColumn('masjid', 'alat_kebersihan'))  $table->string('alat_kebersihan', 255)->nullable();
            if (!Schema::hasColumn('masjid', 'sarana_lainnya'))   $table->text('sarana_lainnya')->nullable();
            // Data Takmir Awal
            if (!Schema::hasColumn('masjid', 'takmir_nama'))      $table->string('takmir_nama', 100)->nullable();
            if (!Schema::hasColumn('masjid', 'takmir_nik'))       $table->string('takmir_nik', 20)->nullable();
            if (!Schema::hasColumn('masjid', 'takmir_wa'))        $table->string('takmir_wa', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('masjid', function (Blueprint $table) {
            $table->dropColumn([
                'kecamatan', 'kelurahan', 'kapasitas', 'no_sk',
                'status_tanah', 'jenis_sertifikat', 'no_sertifikat', 'nama_nazir',
                'sound_system', 'jumlah_ac', 'alat_kebersihan', 'sarana_lainnya',
                'takmir_nama', 'takmir_nik', 'takmir_wa',
            ]);
        });
    }
}
