<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menyelaraskan skema database dengan alur persetujuan:
 *
 *   Admin Ranting (R03)  → menambah masjid baru / mengajukan perubahan
 *   Admin Cabang  (R01)  → menyetujui / menolak (antrian persetujuan)
 *   Superadmin    (R99)  → hanya melihat data yang sudah jadi + kelola akun
 *   Pengurus Masjid (R02)→ mengedit data masjidnya → masuk antrian cabang
 *
 * Perubahan:
 *  - masjid: tambah kolom status_data (draft/pending/approved), alamat, kontak,
 *            id_user_pengaju, default_username, default_password.
 *  - pengajuan: ganti enum jenis agar mendukung 'tambah_masjid' & 'edit_masjid',
 *               tambah kolom data_baru (JSON usulan) & id_user_pengaju.
 *  - persetujuan: ganti id_user (FK ke users.id) → id_user string (FK ke user.id_user).
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── MASJID ──────────────────────────────────────────────
        Schema::table('masjid', function (Blueprint $table) {
            if (!Schema::hasColumn('masjid', 'alamat')) {
                $table->text('alamat')->nullable()->after('wilayah');
            }
            if (!Schema::hasColumn('masjid', 'tipe')) {
                $table->string('tipe', 20)->default('Masjid')->after('nama_masjid'); // Masjid / Musholla
            }
            if (!Schema::hasColumn('masjid', 'kontak_pengurus')) {
                $table->string('kontak_pengurus', 30)->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('masjid', 'status_data')) {
                // draft     = baru dibuat ranting, belum diajukan
                // pending   = menunggu persetujuan admin cabang
                // approved  = sudah disetujui → tampil sebagai "data jadi"
                $table->string('status_data', 20)->default('pending')->after('status_legalitas');
            }
            if (!Schema::hasColumn('masjid', 'id_user_pengaju')) {
                $table->string('id_user_pengaju', 10)->nullable()->after('status_data');
            }
            // Kredensial default untuk akun pengurus masjid (dihubungi admin ranting)
            if (!Schema::hasColumn('masjid', 'default_username')) {
                $table->string('default_username', 100)->nullable()->after('id_user_pengaju');
            }
            if (!Schema::hasColumn('masjid', 'default_password')) {
                $table->string('default_password', 100)->nullable()->after('default_username');
            }
        });

        // Tandai semua masjid hasil seed lama sebagai sudah "approved"
        \Illuminate\Support\Facades\DB::table('masjid')->update(['status_data' => 'approved']);

        // ── PENGAJUAN ───────────────────────────────────────────
        // Drop & buat ulang supaya enum jenis + kolom baru konsisten.
        Schema::dropIfExists('persetujuan');
        Schema::dropIfExists('pengajuan');

        Schema::create('pengajuan', function (Blueprint $table) {
            $table->string('id_pengajuan', 15)->primary();
            $table->string('id_masjid', 10);
            $table->string('id_user_pengaju', 10); // admin ranting / pengurus masjid
            // jenis: tambah_masjid (masjid baru) | edit_masjid (perubahan data)
            $table->string('jenis_pengajuan', 30);
            $table->text('deskripsi')->nullable();
            // data_baru menyimpan snapshot usulan (JSON) agar bisa diterapkan saat approve
            $table->longText('data_baru')->nullable();
            $table->string('status', 20)->default('pending'); // pending|approved|rejected
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();

            $table->foreign('id_masjid')->references('id_masjid')->on('masjid')->onDelete('cascade');
            $table->foreign('id_user_pengaju')->references('id_user')->on('user');
        });

        // ── PERSETUJUAN ─────────────────────────────────────────
        Schema::create('persetujuan', function (Blueprint $table) {
            $table->string('id_persetujuan', 15)->primary();
            $table->string('id_pengajuan', 15);
            $table->string('id_user', 10); // admin cabang yang memproses (FK ke user.id_user)
            $table->string('status', 20)->default('pending'); // approved|rejected
            $table->text('alasan')->nullable();
            $table->timestamps();

            $table->foreign('id_pengajuan')->references('id_pengajuan')->on('pengajuan')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persetujuan');
        Schema::dropIfExists('pengajuan');

        Schema::table('masjid', function (Blueprint $table) {
            $table->dropColumn([
                'alamat', 'tipe', 'kontak_pengurus', 'status_data',
                'id_user_pengaju', 'default_username', 'default_password',
            ]);
        });
    }
};
