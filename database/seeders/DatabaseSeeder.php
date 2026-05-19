<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('user_masjid')->truncate();
        DB::table('user')->truncate();
        DB::table('ranting')->truncate();
        DB::table('cabang')->truncate();
        DB::table('masjid')->truncate();
        DB::table('role')->truncate();

        DB::table('role')->insert([
            ['id_role' => 'R01', 'nama_role' => 'Admin Cabang'],
            ['id_role' => 'R02', 'nama_role' => 'Pengurus Masjid'],
            ['id_role' => 'R03', 'nama_role' => 'Admin Ranting'],
            ['id_role' => 'R99', 'nama_role' => 'Superadmin'],
        ]);

        DB::table('cabang')->insert([
            ['id_cabang' => 'CB01', 'nama_cabang' => 'Cabang Pusat',  'status_keaktifan_cabang' => 'Aktif'],
            ['id_cabang' => 'CB02', 'nama_cabang' => 'Cabang Daerah', 'status_keaktifan_cabang' => 'Nonaktif'],
        ]);

        DB::table('ranting')->insert([
            ['id_ranting' => 'RT01', 'nama_ranting' => 'Ranting A', 'status_keaktifan_ranting' => 'Aktif', 'id_cabang' => 'CB01'],
            ['id_ranting' => 'RT02', 'nama_ranting' => 'Ranting B', 'status_keaktifan_ranting' => 'Aktif', 'id_cabang' => 'CB01'],
        ]);

        DB::table('masjid')->insert([
            ['id_masjid' => 'M001', 'nama_masjid' => 'Masjid Al-Ikhlas', 'status_legalitas' => 'Terdaftar'],
            ['id_masjid' => 'M002', 'nama_masjid' => 'Masjid As-Salam',  'status_legalitas' => 'Proses'],
        ]);

        DB::table('user')->insert([
            ['id_user' => 'U001', 'username' => 'calvin', 'password' => '***', 'id_role' => 'R99', 'id_ranting' => 'RT01'],
            ['id_user' => 'U002', 'username' => 'budi',   'password' => '***', 'id_role' => 'R02', 'id_ranting' => 'RT02'],
            ['id_user' => 'U003', 'username' => 'nauval', 'password' => '***', 'id_role' => 'R01', 'id_ranting' => 'RT01'],
            ['id_user' => 'U004', 'username' => 'anggun', 'password' => '***', 'id_role' => 'R03', 'id_ranting' => null],
        ]);

        DB::table('user_masjid')->insert([
            ['id_user' => 'U001', 'id_masjid' => 'M001'],
            ['id_user' => 'U001', 'id_masjid' => 'M002'],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✅ Semua data berhasil di-seed!');
    }
}
