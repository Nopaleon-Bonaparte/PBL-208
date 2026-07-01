<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkunAdminController extends Controller
{
    /**
     * Halaman utama Manajemen Akun Administrator.
     * Hanya menampilkan akun Admin Cabang (R01), Admin Ranting (R03),
     * dan Pengurus Masjid (R02) — Superadmin (R99) tidak ditampilkan di sini.
     */
    public function index(Request $request)
    {
        if (session('id_role') != 'R99') {
            return redirect('/dashboard');
        }

        $search = $request->query('search');
        $role   = $request->query('role');   // R01 / R02 / R03
        $unit   = $request->query('unit');   // id_cabang atau id_ranting

        // Query utama: gabungkan user + role + ranting + cabang + masjid
        $query = DB::table('user')
            ->join('role', 'user.id_role', '=', 'role.id_role')
            ->leftJoin('ranting', 'user.id_ranting', '=', 'ranting.id_ranting')
            ->leftJoin('cabang', 'ranting.id_cabang', '=', 'cabang.id_cabang')
            ->leftJoin('user_masjid', 'user.id_user', '=', 'user_masjid.id_user')
            ->leftJoin('masjid', 'user_masjid.id_masjid', '=', 'masjid.id_masjid')
            ->whereIn('user.id_role', ['R01', 'R02', 'R03'])
            ->select(
                'user.id_user',
                'user.username',
                'user.nama_lengkap',
                'user.email',
                'user.no_hp',
                'user.id_role',
                'role.nama_role',
                'user.status_akun',
                'user.terakhir_login',
                'ranting.nama_ranting',
                'cabang.nama_cabang',
                'cabang.wilayah as wilayah_cabang',
                'masjid.nama_masjid',
                'masjid.wilayah as wilayah_masjid'
            );

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('user.nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('user.username', 'like', "%{$search}%");
            });
        }

        if ($role) {
            $query->where('user.id_role', $role);
        }

        if ($unit) {
            $query->where(function ($q) use ($unit) {
                $q->where('ranting.id_cabang', $unit)
                  ->orWhere('user.id_ranting', $unit);
            });
        }

        $admins = $query->orderBy('user.nama_lengkap')->paginate(10)->withQueryString();

        // Statistik ringkas
        $totalAdmin   = DB::table('user')->whereIn('id_role', ['R01', 'R02', 'R03'])->count();
        $totalCabang  = DB::table('user')->where('id_role', 'R01')->count();
        $totalRanting = DB::table('user')->where('id_role', 'R03')->count();
        $totalMasjid  = DB::table('user')->where('id_role', 'R02')->count();

        // Untuk dropdown "Unit PCM/PRM" — hanya wilayah Kota Batam
        $daftarCabang = DB::table('cabang')->where('wilayah', 'Kota Batam')->get();

        return view('superadmin.akun-admin', compact(
            'admins', 'totalAdmin', 'totalCabang', 'totalRanting', 'totalMasjid', 'daftarCabang'
        ));
    }

    /**
     * Simpan akun admin baru (Admin Cabang / Admin Ranting / Pengurus Masjid).
     */
    public function store(Request $request)
    {
        if (session('id_role') != 'R99') {
            return redirect('/dashboard');
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'username'     => 'required|string|max:100|unique:user,username',
            'email'        => 'nullable|email|max:150',
            'no_hp'        => 'nullable|string|max:20',
            'password'     => 'required|string|min:6',
            'id_role'      => 'required|in:R01,R02,R03',
            'id_ranting'   => 'nullable|string|exists:ranting,id_ranting',
            'id_masjid'    => 'nullable|string|exists:masjid,id_masjid',
        ]);

        $idUser = 'U' . str_pad((string) (DB::table('user')->count() + 1), 3, '0', STR_PAD_LEFT);

        DB::table('user')->insert([
            'id_user'      => $idUser,
            'username'     => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
            'password'     => $request->password, // disarankan Hash::make() di produksi
            'id_role'      => $request->id_role,
            'id_ranting'   => $request->id_ranting,
            'status_akun'  => 'Aktif',
        ]);

        if ($request->id_role === 'R02' && $request->id_masjid) {
            DB::table('user_masjid')->insert([
                'id_user'   => $idUser,
                'id_masjid' => $request->id_masjid,
            ]);
        }

        return redirect('/superadmin/akun-admin')->with('success', 'Akun baru berhasil ditambahkan.');
    }

    /**
     * Nonaktifkan / aktifkan kembali akun.
     */
    public function toggleStatus(string $idUser)
    {
        if (session('id_role') != 'R99') {
            return redirect('/dashboard');
        }

        $user = DB::table('user')->where('id_user', $idUser)->first();
        if (!$user) {
            return redirect('/superadmin/akun-admin')->with('error', 'Akun tidak ditemukan.');
        }

        $newStatus = ($user->status_akun === 'Aktif') ? 'Nonaktif' : 'Aktif';

        DB::table('user')->where('id_user', $idUser)->update(['status_akun' => $newStatus]);

        return redirect('/superadmin/akun-admin')->with('success', "Status akun diubah menjadi {$newStatus}.");
    }

    /**
     * Reset password akun ke nilai default.
     */
    public function resetPassword(string $idUser)
    {
        if (session('id_role') != 'R99') {
            return redirect('/dashboard');
        }

        DB::table('user')->where('id_user', $idUser)->update([
            'password' => 'password123', // disarankan Hash::make() di produksi
        ]);

        return redirect('/superadmin/akun-admin')->with('success', 'Password berhasil direset ke default.');
    }

    /**
     * Tambah CABANG baru (hanya Superadmin).
     */
    public function storeCabang(Request $request)
    {
        if (session('id_role') != 'R99') {
            return redirect('/dashboard');
        }

        $request->validate([
            'nama_cabang' => 'required|string|max:100',
            'wilayah'     => 'nullable|string|max:100',
        ]);

        $last = DB::table('cabang')->orderBy('id_cabang', 'desc')->value('id_cabang');
        $n = $last ? ((int) substr($last, 2)) + 1 : 1;
        $idCabang = 'CB' . str_pad((string) $n, 2, '0', STR_PAD_LEFT);

        DB::table('cabang')->insert([
            'id_cabang'               => $idCabang,
            'nama_cabang'             => $request->nama_cabang,
            'wilayah'                 => $request->wilayah ?: 'Kota Batam',
            'status_keaktifan_cabang' => 'Aktif',
        ]);

        return redirect('/superadmin/akun-admin')->with('success', "Cabang {$request->nama_cabang} ditambahkan.");
    }

    /**
     * Tambah RANTING baru (hanya Superadmin).
     */
    public function storeRanting(Request $request)
    {
        if (session('id_role') != 'R99') {
            return redirect('/dashboard');
        }

        $request->validate([
            'nama_ranting' => 'required|string|max:100',
            'id_cabang'    => 'required|string|exists:cabang,id_cabang',
        ]);

        $last = DB::table('ranting')->orderBy('id_ranting', 'desc')->value('id_ranting');
        $n = $last ? ((int) substr($last, 2)) + 1 : 1;
        $idRanting = 'RT' . str_pad((string) $n, 2, '0', STR_PAD_LEFT);

        DB::table('ranting')->insert([
            'id_ranting'               => $idRanting,
            'nama_ranting'             => $request->nama_ranting,
            'status_keaktifan_ranting' => 'Aktif',
            'id_cabang'                => $request->id_cabang,
        ]);

        return redirect('/superadmin/akun-admin')->with('success', "Ranting {$request->nama_ranting} ditambahkan.");
    }
}