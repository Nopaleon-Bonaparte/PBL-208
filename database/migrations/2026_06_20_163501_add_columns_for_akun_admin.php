<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Tambah kolom profil & status ke tabel user ──
        Schema::table('user', function (Blueprint $table) {
            $table->string('nama_lengkap', 150)->nullable()->after('username');
            $table->string('email', 150)->nullable()->after('nama_lengkap');
            $table->string('no_hp', 20)->nullable()->after('email');
            $table->string('id_cabang', 10)->nullable()->after('id_ranting');
            $table->string('status_akun', 20)->default('Aktif')->after('id_cabang');
            $table->dateTime('terakhir_login')->nullable()->after('status_akun');
            $table->foreign('id_cabang')->references('id_cabang')->on('cabang');
        });

        // ── Tambah kolom wilayah ke tabel cabang ──
        Schema::table('cabang', function (Blueprint $table) {
            $table->string('wilayah', 100)->nullable()->after('nama_cabang');
        });

        // ── Tambah kolom relasi ranting & wilayah ke tabel masjid ──
        Schema::table('masjid', function (Blueprint $table) {
            $table->string('id_ranting', 10)->nullable()->after('nama_masjid');
            $table->string('wilayah', 100)->nullable()->after('id_ranting');
            $table->foreign('id_ranting')->references('id_ranting')->on('ranting');
        });
    }

    public function down(): void
    {
        Schema::table('masjid', function (Blueprint $table) {
            $table->dropForeign(['id_ranting']);
            $table->dropColumn(['id_ranting', 'wilayah']);
        });

        Schema::table('cabang', function (Blueprint $table) {
            $table->dropColumn('wilayah');
        });

        Schema::table('user', function (Blueprint $table) {
            $table->dropForeign(['id_cabang']);
            $table->dropColumn(['nama_lengkap', 'email', 'no_hp', 'id_cabang', 'status_akun', 'terakhir_login']);
        });
    }
};