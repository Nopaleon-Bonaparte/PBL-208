<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        DB::table('user_masjid')->truncate();
        DB::table('persetujuan')->truncate();
        DB::table('pengajuan')->truncate();
        DB::table('user')->truncate();
        DB::table('ranting')->truncate();
        DB::table('cabang')->truncate();
        DB::table('masjid')->truncate();
        DB::table('role')->truncate();

        // ── ROLE ──
        DB::table('role')->insert([
            ['id_role' => 'R01', 'nama_role' => 'Admin Cabang'],
            ['id_role' => 'R02', 'nama_role' => 'Pengurus Masjid'],
            ['id_role' => 'R03', 'nama_role' => 'Admin Ranting'],
            ['id_role' => 'R99', 'nama_role' => 'Superadmin'],
        ]);

        // ── CABANG (PCM) — semua di Kota Batam ──
        DB::table('cabang')->insert([
            ['id_cabang' => 'CB01', 'nama_cabang' => 'PCM Batam Kota', 'wilayah' => 'Kota Batam', 'status_keaktifan_cabang' => 'Aktif'],
            ['id_cabang' => 'CB02', 'nama_cabang' => 'PCM Sagulung',   'wilayah' => 'Kota Batam', 'status_keaktifan_cabang' => 'Aktif'],
            ['id_cabang' => 'CB03', 'nama_cabang' => 'PCM Sekupang',   'wilayah' => 'Kota Batam', 'status_keaktifan_cabang' => 'Aktif'],
        ]);

        // ── RANTING (PRM) ──
        DB::table('ranting')->insert([
            ['id_ranting' => 'RT01', 'nama_ranting' => 'PRM Belian',        'status_keaktifan_ranting' => 'Aktif', 'id_cabang' => 'CB01', 'kecamatan' => 'Batam Kota'],
            ['id_ranting' => 'RT02', 'nama_ranting' => 'PRM Sukajadi',      'status_keaktifan_ranting' => 'Aktif', 'id_cabang' => 'CB01', 'kecamatan' => 'Batam Kota'],
            ['id_ranting' => 'RT03', 'nama_ranting' => 'PRM Tembesi',       'status_keaktifan_ranting' => 'Aktif', 'id_cabang' => 'CB02', 'kecamatan' => 'Sagulung'],
            ['id_ranting' => 'RT04', 'nama_ranting' => 'PRM Sekupang Raya', 'status_keaktifan_ranting' => 'Aktif', 'id_cabang' => 'CB03', 'kecamatan' => 'Sekupang'],
        ]);

        // ── MASJID — contoh nyata di Batam (semua sudah approved) ──
        DB::table('masjid')->insert([
            ['id_masjid' => 'M001', 'nama_masjid' => 'Masjid Agung Batam',     'tipe' => 'Masjid', 'id_ranting' => 'RT01', 'wilayah' => 'Batam Kota', 'alamat' => 'Jl. Engku Putri, Batam Kota', 'kontak_pengurus' => '0822-7000-0007', 'status_legalitas' => 'Terdaftar', 'status_data' => 'approved', 'id_user_pengaju' => null, 'default_username' => 'masjid_agung_batam', 'default_password' => 'masjid123'],
            ['id_masjid' => 'M002', 'nama_masjid' => 'Masjid Al-Hikmah Batam', 'tipe' => 'Masjid', 'id_ranting' => 'RT02', 'wilayah' => 'Sukajadi',   'alamat' => 'Jl. Sukajadi, Batam',       'kontak_pengurus' => '0813-2000-0002', 'status_legalitas' => 'Terdaftar', 'status_data' => 'approved', 'id_user_pengaju' => null, 'default_username' => 'masjid_al_hikmah', 'default_password' => 'masjid123'],
            ['id_masjid' => 'M003', 'nama_masjid' => 'Masjid Raya Sagulung',   'tipe' => 'Masjid', 'id_ranting' => 'RT03', 'wilayah' => 'Sagulung',   'alamat' => 'Jl. Sagulung Baru',          'kontak_pengurus' => '0812-9000-0010', 'status_legalitas' => 'Proses',    'status_data' => 'approved', 'id_user_pengaju' => null, 'default_username' => 'masjid_raya_sagulung', 'default_password' => 'masjid123'],
            ['id_masjid' => 'M004', 'nama_masjid' => 'Masjid An-Nur Sekupang', 'tipe' => 'Masjid', 'id_ranting' => 'RT04', 'wilayah' => 'Sekupang',   'alamat' => 'Jl. Sekupang Raya',          'kontak_pengurus' => '0812-9000-0011', 'status_legalitas' => 'Terdaftar', 'status_data' => 'approved', 'id_user_pengaju' => null, 'default_username' => 'masjid_an_nur', 'default_password' => 'masjid123'],
            // Contoh masjid yang MASIH menunggu persetujuan admin cabang (diajukan admin ranting RT01)
            ['id_masjid' => 'M005', 'nama_masjid' => 'Musholla Al-Ikhlas',     'tipe' => 'Musholla', 'id_ranting' => 'RT01', 'wilayah' => 'Batam Kota', 'alamat' => 'Jl. Bunga Raya No. 5', 'kontak_pengurus' => '0856-1000-0020', 'status_legalitas' => 'Proses', 'status_data' => 'pending', 'id_user_pengaju' => 'U004', 'default_username' => 'musholla_al_ikhlas', 'default_password' => 'masjid123'],
        ]);

        // ── USER ──
        DB::table('user')->insert([
            [
                'id_user' => 'U001', 'username' => 'calvin',
                'nama_lengkap' => 'Calvin Pratama', 'email' => 'calvin@pdmbatam.or.id', 'no_hp' => '0812-1000-0001',
                'password' => 'password123', 'id_role' => 'R99', 'id_ranting' => 'RT01',
                'status_akun' => 'Aktif', 'terakhir_login' => now(),
            ]
        ]);

        // ── PENGAJUAN (demo: 1 permohonan tambah masjid menunggu di antrian cabang CB01) ──
        DB::table('pengajuan')->insert([
            [
                'id_pengajuan'    => 'PGJ0001',
                'id_masjid'       => 'M005',
                'id_user_pengaju' => 'U001',
                'jenis_pengajuan' => 'tambah_masjid',
                'deskripsi'       => 'Penambahan data musholla baru oleh admin ranting.',
                'data_baru'       => json_encode([
                    'nama_masjid' => 'Musholla Al-Ikhlas', 'tipe' => 'Musholla',
                    'wilayah' => 'Batam Kota', 'alamat' => 'Jl. Bunga Raya No. 5',
                    'kontak_pengurus' => '0856-1000-0020', 'status_legalitas' => 'Proses',
                ]),
                'status'          => 'pending',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);

        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $this->command->info('✅ Semua data berhasil di-seed!');
    }
}