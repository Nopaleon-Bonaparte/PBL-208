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
            ['id_cabang' => 'CB04', 'nama_cabang' => 'PCM Nongsa',     'wilayah' => 'Kota Batam', 'status_keaktifan_cabang' => 'Nonaktif'],
        ]);

        // ── RANTING (PRM) ──
        DB::table('ranting')->insert([
            ['id_ranting' => 'RT01', 'nama_ranting' => 'PRM Belian',        'status_keaktifan_ranting' => 'Aktif', 'id_cabang' => 'CB01'],
            ['id_ranting' => 'RT02', 'nama_ranting' => 'PRM Sukajadi',      'status_keaktifan_ranting' => 'Aktif', 'id_cabang' => 'CB01'],
            ['id_ranting' => 'RT03', 'nama_ranting' => 'PRM Tembesi',       'status_keaktifan_ranting' => 'Aktif', 'id_cabang' => 'CB02'],
            ['id_ranting' => 'RT04', 'nama_ranting' => 'PRM Sekupang Raya', 'status_keaktifan_ranting' => 'Aktif', 'id_cabang' => 'CB03'],
        ]);

        // ── MASJID — contoh nyata di Batam ──
        DB::table('masjid')->insert([
            ['id_masjid' => 'M001', 'nama_masjid' => 'Masjid Agung Batam',     'id_ranting' => 'RT01', 'wilayah' => 'Batam Kota', 'status_legalitas' => 'Terdaftar'],
            ['id_masjid' => 'M002', 'nama_masjid' => 'Masjid Al-Hikmah Batam', 'id_ranting' => 'RT02', 'wilayah' => 'Sukajadi',   'status_legalitas' => 'Terdaftar'],
            ['id_masjid' => 'M003', 'nama_masjid' => 'Masjid Raya Sagulung',   'id_ranting' => 'RT03', 'wilayah' => 'Sagulung',   'status_legalitas' => 'Proses'],
            ['id_masjid' => 'M004', 'nama_masjid' => 'Masjid An-Nur Sekupang', 'id_ranting' => 'RT04', 'wilayah' => 'Sekupang',   'status_legalitas' => 'Terdaftar'],
        ]);

        // ── USER ──
        DB::table('user')->insert([
            [
                'id_user' => 'U001', 'username' => 'calvin',
                'nama_lengkap' => 'Calvin Pratama', 'email' => 'calvin@pdmbatam.or.id', 'no_hp' => '0812-1000-0001',
                'password' => 'password123', 'id_role' => 'R99', 'id_ranting' => 'RT01',
                'status_akun' => 'Aktif', 'terakhir_login' => now(),
            ],
            [
                'id_user' => 'U002', 'username' => 'budi',
                'nama_lengkap' => 'Syamsul Bahri', 'email' => 'syamsul_mjd_alhikmah@pdmbatam.or.id', 'no_hp' => '0813-2000-0002',
                'password' => 'password123', 'id_role' => 'R02', 'id_ranting' => 'RT02',
                'status_akun' => 'Aktif', 'terakhir_login' => now()->subDay(),
            ],
            [
                'id_user' => 'U003', 'username' => 'nauval',
                'nama_lengkap' => 'H. Ahmad Zaki, M.Pd', 'email' => 'ahmad_zaki_pcm@pdmbatam.or.id', 'no_hp' => '0811-3000-0003',
                'password' => 'password123', 'id_role' => 'R01', 'id_ranting' => 'RT01',
                'status_akun' => 'Aktif', 'terakhir_login' => now()->subMinutes(10),
            ],
            [
                'id_user' => 'U004', 'username' => 'anggun',
                'nama_lengkap' => 'Nuraini Rahmawati', 'email' => 'nuraini_prm_center@pdmbatam.or.id', 'no_hp' => '0852-4000-0004',
                'password' => 'password123', 'id_role' => 'R03', 'id_ranting' => 'RT01',
                'status_akun' => 'Aktif', 'terakhir_login' => now()->subHours(2),
            ],
            [
                'id_user' => 'U005', 'username' => 'rina_prm_sukajadi',
                'nama_lengkap' => 'Rina Marlina', 'email' => 'rina_prm_sukajadi@pdmbatam.or.id', 'no_hp' => '0853-5000-0005',
                'password' => 'password123', 'id_role' => 'R03', 'id_ranting' => 'RT02',
                'status_akun' => 'Aktif', 'terakhir_login' => now()->subDays(3),
            ],
            [
                'id_user' => 'U006', 'username' => 'fauzi_pcm_sagulung',
                'nama_lengkap' => 'H. Fauzi Hidayat', 'email' => 'fauzi_pcm_sagulung@pdmbatam.or.id', 'no_hp' => '0817-6000-0006',
                'password' => 'password123', 'id_role' => 'R01', 'id_ranting' => 'RT03',
                'status_akun' => 'Aktif', 'terakhir_login' => now()->subHours(5),
            ],
            [
                'id_user' => 'U007', 'username' => 'dewi_mjd_agung',
                'nama_lengkap' => 'Dewi Kusuma', 'email' => 'dewi_mjd_agung@pdmbatam.or.id', 'no_hp' => '0822-7000-0007',
                'password' => 'password123', 'id_role' => 'R02', 'id_ranting' => 'RT01',
                'status_akun' => 'Nonaktif', 'terakhir_login' => now()->subDays(14),
            ],
        ]);

        // ── USER_MASJID (pivot: siapa mengelola masjid apa) ──
        DB::table('user_masjid')->insert([
            ['id_user' => 'U002', 'id_masjid' => 'M002'],
            ['id_user' => 'U007', 'id_masjid' => 'M001'],
        ]);

        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $this->command->info('✅ Semua data berhasil di-seed!');
    }
}