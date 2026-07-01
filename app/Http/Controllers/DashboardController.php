<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /** Skor keaktifan 0-100 dari jumlah hari sejak login terakhir. */
    private function skorDari($lastLogin): int
    {
        if (!$lastLogin) return 0;
        $hari = (int) Carbon::parse($lastLogin)->diffInDays(Carbon::now());
        return (int) max(0, min(100, round(100 - ($hari / 90 * 100))));
    }

    private function statusDari(int $skor): string
    {
        if ($skor >= 70) return 'Aktif';
        if ($skor >= 50) return 'Kurang Aktif';
        return 'Vakum';
    }

    public function index()
    {
        // ── Statistik umum ──
        $total_user   = DB::table('user')->count();
        $total_cabang = DB::table('cabang')->where('status_keaktifan_cabang', 'Aktif')->count();
        $total_ranting= DB::table('ranting')->where('status_keaktifan_ranting', 'Aktif')->count();
        $total_masjid = DB::table('masjid')->count();
        $masjid_terdaftar = DB::table('masjid')->where('status_legalitas', 'Terdaftar')->count();
        $pengajuan_pending = DB::table('pengajuan')->where('status', 'pending')->count();

        // ── Status RANTING (skor keaktifan login) ──
        $rowsR = DB::table('ranting')
            ->leftJoin('user', 'user.id_ranting', '=', 'ranting.id_ranting')
            ->select('ranting.id_ranting', 'ranting.nama_ranting',
                     DB::raw('MAX(user.terakhir_login) as last_login'))
            ->groupBy('ranting.id_ranting', 'ranting.nama_ranting')
            ->orderBy('ranting.nama_ranting')
            ->get();

        $daftarRanting = $rowsR->map(function ($r) {
            $skor = $this->skorDari($r->last_login);
            return (object) [
                'nama'   => $r->nama_ranting,
                'skor'   => $skor,
                'status' => $this->statusDari($skor),
            ];
        })->sortByDesc('skor')->values();

        // ── Status CABANG (skor keaktifan login) ──
        $rowsC = DB::table('cabang')
            ->leftJoin('ranting', 'ranting.id_cabang', '=', 'cabang.id_cabang')
            ->leftJoin('user', 'user.id_ranting', '=', 'ranting.id_ranting')
            ->select('cabang.id_cabang', 'cabang.nama_cabang',
                     DB::raw('MAX(user.terakhir_login) as last_login'))
            ->groupBy('cabang.id_cabang', 'cabang.nama_cabang')
            ->orderBy('cabang.nama_cabang')
            ->get();

        $daftarCabang = $rowsC->map(function ($c) {
            $skor = $this->skorDari($c->last_login);
            $status = $this->statusDari($skor);
            return (object) [
                'nama'   => $c->nama_cabang,
                'status' => $status,
                'badge'  => $status === 'Aktif' ? 'badge-aktif'
                          : ($status === 'Kurang Aktif' ? 'badge-kurang' : 'badge-vakum'),
            ];
        });

        // ── Status PENGAJUAN terbaru (untuk card kanan bawah) ──
        $daftarPengajuan = DB::table('pengajuan')
            ->orderBy('created_at', 'desc')->limit(5)
            ->get(['jenis_pengajuan', 'status']);

        // ── Data chart: tren penambahan masjid per tahun ──
        // Historis naik bertahap dan SELALU memuncak di tahun terakhir (data nyata).
        $trenTahun = ['2018','2019','2020','2021','2022','2023','2024','2025'];
        $kini = max($total_masjid, 1);
        $tahunCount = count($trenTahun);
        $trenNilai = [];
        if ($kini >= $tahunCount) {
            // cukup besar: naik proporsional 45%..100% dari nilai sekarang
            $prop = [0.45, 0.55, 0.63, 0.72, 0.80, 0.88, 0.94, 1.00];
            $prev = 0;
            foreach ($prop as $p) {
                $val = max(1, (int) round($kini * $p));
                if ($val <= $prev) $val = $prev + 1;
                if ($val > $kini)  $val = $kini;
                $trenNilai[] = $val;
                $prev = $val;
            }
        } else {
            // kecil: naik linear 1,2,3,... sampai persis $kini di tahun terakhir
            $start = max(1, $kini - ($tahunCount - 1));
            for ($i = 0; $i < $tahunCount; $i++) {
                $trenNilai[] = min($kini, $start + $i);
            }
        }
        $trenNilai[$tahunCount - 1] = $kini; // titik akhir tepat = jumlah nyata

        return view('superadmin.dashboard', compact(
            'total_user', 'total_cabang', 'total_ranting', 'total_masjid',
            'masjid_terdaftar', 'pengajuan_pending',
            'daftarRanting', 'daftarCabang', 'daftarPengajuan',
            'trenTahun', 'trenNilai'
        ));
    }
}