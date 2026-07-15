<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkunAdminController extends Controller
{
    public function index(Request $request)
    {
        if (session('id_role') != 'R99') {
            return redirect('/dashboard');
        }

        $search  = $request->query('search');
        $role    = $request->query('role');
        $cabang  = $request->query('cabang');
        $ranting = $request->query('ranting');

        $query = DB::table('user')
            ->join('role', 'user.id_role', '=', 'role.id_role')
            ->leftJoin('ranting', 'user.id_ranting', '=', 'ranting.id_ranting')
            ->leftJoin('cabang as c_ranting', 'ranting.id_cabang', '=', 'c_ranting.id_cabang')
            ->leftJoin('cabang as c_user', 'user.id_cabang', '=', 'c_user.id_cabang')
            ->whereIn('user.id_role', ['R01', 'R03'])
            ->select(
                'user.id_user', 'user.username', 'user.nama_lengkap',
                'user.email', 'user.no_hp', 'user.id_role',
                'role.nama_role', 'ranting.nama_ranting',
                'c_ranting.nama_cabang as nama_cabang_ranting',
                'c_user.nama_cabang as nama_cabang_direct'
            );

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('user.nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('user.username', 'like', "%{$search}%");
            });
        }
        if ($role) $query->where('user.id_role', $role);
        if ($cabang) {
            $namaCabangFull = 'PCM ' . $cabang;
            $query->where(function ($q) use ($namaCabangFull) {
                $q->where('c_user.nama_cabang', $namaCabangFull)
                  ->orWhere('c_ranting.nama_cabang', $namaCabangFull);
            });
        }
        if ($ranting) {
            $namaRantingFull = 'PRM ' . $ranting;
            $query->where('ranting.nama_ranting', $namaRantingFull);
        }

        $admins = $query->orderBy('user.nama_lengkap')->paginate(10)->withQueryString();

        $totalAdmin   = DB::table('user')->whereIn('id_role', ['R01', 'R03'])->count();
        $totalCabang  = DB::table('user')->where('id_role', 'R01')->count();
        $totalRanting = DB::table('user')->where('id_role', 'R03')->count();
        $daftarCabang = DB::table('cabang')->where('wilayah', 'Kota Batam')->get();
        $daftarRanting = DB::table('ranting')->get();

        return view('superadmin.akun-admin', compact(
            'admins', 'totalAdmin', 'totalCabang', 'totalRanting', 'daftarCabang', 'daftarRanting'
        ));
    }

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
            'id_role'      => 'required|in:R01,R03',
            'kecamatan_cabang' => 'required|string',
            'nama_ranting' => 'required_if:id_role,R03|nullable|string|max:100',
        ]);

        $namaCabang = 'PCM ' . $request->kecamatan_cabang;
        $cabang = DB::table('cabang')->where('nama_cabang', $namaCabang)->first();
        if (!$cabang) {
            $nextCabangNum = DB::table('cabang')->count() + 1;
            $idCabang = 'CB' . str_pad((string) $nextCabangNum, 2, '0', STR_PAD_LEFT);
            DB::table('cabang')->insert([
                'id_cabang' => $idCabang,
                'nama_cabang' => $namaCabang,
                'wilayah' => 'Kota Batam',
                'status_keaktifan_cabang' => 'Aktif',
            ]);
        } else {
            $idCabang = $cabang->id_cabang;
        }

        $idRanting = null;

        if ($request->id_role === 'R03') {
            $namaRantingFull = $request->nama_ranting;
            if (!str_starts_with($namaRantingFull, 'PRM ')) {
                $namaRantingFull = 'PRM ' . $namaRantingFull;
            }

            $ranting = DB::table('ranting')
                ->where('nama_ranting', $namaRantingFull)
                ->where('id_cabang', $idCabang)
                ->first();
            if (!$ranting) {
                $nextRantingNum = DB::table('ranting')->count() + 1;
                $idRanting = 'RT' . str_pad((string) $nextRantingNum, 2, '0', STR_PAD_LEFT);
                DB::table('ranting')->insert([
                    'id_ranting' => $idRanting,
                    'nama_ranting' => $namaRantingFull,
                    'status_keaktifan_ranting' => 'Aktif',
                    'id_cabang' => $idCabang,
                ]);
            } else {
                $idRanting = $ranting->id_ranting;
            }
        }

        $idUser = 'U' . str_pad((string) (DB::table('user')->count() + 1), 3, '0', STR_PAD_LEFT);

        $no_hp = $request->no_hp;
        if ($no_hp) {
            $digits = preg_replace('/\D/', '', $no_hp);
            if (str_starts_with($digits, '62')) {
                $digits = '0' . substr($digits, 2);
            }
            if (strlen($digits) > 8) {
                $no_hp = substr($digits, 0, 4) . '-' . substr($digits, 4, 4) . '-' . substr($digits, 8, 5);
            } else {
                $parts = str_split($digits, 4);
                $no_hp = implode('-', $parts);
            }
        }

        DB::table('user')->insert([
            'id_user'      => $idUser,
            'username'     => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_hp'        => $no_hp,
            'password'     => $request->password,
            'id_role'      => $request->id_role,
            'id_ranting'   => $idRanting,
            'id_cabang'    => ($request->id_role === 'R01') ? $idCabang : null,
            'status_akun'  => 'Aktif',
        ]);

        return redirect('/superadmin/akun-admin')->with('success', 'Akun baru berhasil ditambahkan.');
    }

    public function destroy(string $idUser)
    {
        if (session('id_role') != 'R99') {
            return redirect('/dashboard');
        }

        $user = DB::table('user')->where('id_user', $idUser)->first();
        if (!$user) {
            return redirect('/superadmin/akun-admin')->with('error', 'Akun tidak ditemukan.');
        }

        DB::table('persetujuan')->where('id_user', $idUser)->delete();

        DB::table('pengajuan')->where('id_user_pengaju', $idUser)->update(['id_user_pengaju' => null]);

        DB::table('user_masjid')->where('id_user', $idUser)->delete();

        DB::table('user')->where('id_user', $idUser)->delete();

        return redirect('/superadmin/akun-admin')->with('success', 'Akun berhasil dihapus.');
    }
}
