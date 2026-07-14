<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * PersetujuanController — Antrian Persetujuan Admin Cabang (R01)
 *
 * Admin cabang melihat permohonan dari admin ranting (tambah masjid) dan
 * pengurus masjid (edit data). Saat disetujui:
 *   - tambah_masjid -> masjid.status_data = 'approved' (jadi "data jadi").
 *   - edit_masjid   -> perubahan diterapkan ke baris masjid.
 * Saat ditolak -> masjid baru dihapus (jika tambah_masjid) / perubahan dibatalkan.
 *
 * Admin cabang hanya melihat pengajuan dari masjid di ranting bawah cabangnya.
 */
class PersetujuanController extends Controller
{
    private function nextPersetujuanId(): string
    {
        $count = DB::table('persetujuan')->count() + 1;
        return 'PRS' . str_pad((string) $count, 4, '0', STR_PAD_LEFT);
    }

    /** Daftar id_ranting yang berada di bawah cabang admin yang login. */
    private function rantingCabangIni(): array
    {
        $idCabang = session('id_cabang');
        return DB::table('ranting')->where('id_cabang', $idCabang)->pluck('id_ranting')->all();
    }

    public function index(Request $request)
    {
        if (session('id_role') != 'R01') return redirect('/dashboard');

        $rantingIds = $this->rantingCabangIni();

        $pengajuan = DB::table('pengajuan')
            ->join('masjid', 'pengajuan.id_masjid', '=', 'masjid.id_masjid')
            ->leftJoin('ranting', 'masjid.id_ranting', '=', 'ranting.id_ranting')
            ->leftJoin('user', 'pengajuan.id_user_pengaju', '=', 'user.id_user')
            ->where('pengajuan.status', 'pending')
            ->whereIn('masjid.id_ranting', $rantingIds)
            ->select(
                'pengajuan.id_pengajuan',
                'pengajuan.jenis_pengajuan',
                'pengajuan.deskripsi',
                'pengajuan.data_baru',
                'pengajuan.created_at',
                'masjid.id_masjid',
                'masjid.nama_masjid',
                'masjid.tipe',
                'masjid.wilayah',
                'ranting.nama_ranting',
                'user.nama_lengkap as pengaju'
            )
            ->orderBy('pengajuan.created_at', 'desc')
            ->get();

        $totalPending = $pengajuan->count();

        return view('admin_cabang.persetujuan', compact('pengajuan', 'totalPending'));
    }

    public function approve(Request $request, string $idPengajuan)
    {
        if (session('id_role') != 'R01') return redirect('/dashboard');

        $pengajuan = DB::table('pengajuan')->where('id_pengajuan', $idPengajuan)->first();
        if (!$pengajuan || $pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan tidak ditemukan atau sudah diproses.');
        }

        $masjid = DB::table('masjid')->where('id_masjid', $pengajuan->id_masjid)->first();
        if (!$masjid || !in_array($masjid->id_ranting, $this->rantingCabangIni())) {
            return back()->with('error', 'Anda tidak berwenang atas pengajuan ini.');
        }

        DB::transaction(function () use ($pengajuan, $idPengajuan) {
            $data = json_decode($pengajuan->data_baru, true) ?: [];

            if ($pengajuan->jenis_pengajuan === 'tambah_masjid') {
                DB::table('masjid')->where('id_masjid', $pengajuan->id_masjid)
                    ->update(['status_data' => 'approved']);
            } elseif ($pengajuan->jenis_pengajuan === 'edit_masjid') {
                $allowed = [
                    'nama_masjid', 'tipe', 'alamat', 'wilayah', 'kecamatan', 'kelurahan',
                    'kapasitas', 'no_sk', 'status_tanah', 'jenis_sertifikat', 'no_sertifikat',
                    'nama_nazir', 'sound_system', 'jumlah_sound_system', 'jumlah_ac', 'kondisi_ac', 'alat_kebersihan', 'sarana_lainnya',
                    'takmir_nama', 'takmir_nik', 'takmir_wa', 'kontak_pengurus', 'status_legalitas',
                    'foto_bangunan', 'file_sk', 'file_sertifikat', 'file_ktp',
                    'default_username', 'default_password', 'email',
                ];
                $update = array_intersect_key($data, array_flip($allowed));
                $update['status_data'] = 'approved';
                DB::table('masjid')->where('id_masjid', $pengajuan->id_masjid)->update($update);
            }

            DB::table('pengajuan')->where('id_pengajuan', $idPengajuan)
                ->update(['status' => 'approved', 'updated_at' => now()]);

            DB::table('persetujuan')->insert([
                'id_persetujuan' => $this->nextPersetujuanId(),
                'id_pengajuan'   => $idPengajuan,
                'id_user'        => session('id_user'),
                'status'         => 'approved',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        });

        return back()->with('success', 'Pengajuan disetujui. Data masjid kini aktif.');
    }

    public function reject(Request $request, string $idPengajuan)
    {
        if (session('id_role') != 'R01') return redirect('/dashboard');

        $request->validate(['alasan' => 'nullable|string|max:255']);

        $pengajuan = DB::table('pengajuan')->where('id_pengajuan', $idPengajuan)->first();
        if (!$pengajuan || $pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan tidak ditemukan atau sudah diproses.');
        }

        $masjid = DB::table('masjid')->where('id_masjid', $pengajuan->id_masjid)->first();
        if (!$masjid || !in_array($masjid->id_ranting, $this->rantingCabangIni())) {
            return back()->with('error', 'Anda tidak berwenang atas pengajuan ini.');
        }

        DB::transaction(function () use ($pengajuan, $idPengajuan, $request) {
            DB::table('pengajuan')->where('id_pengajuan', $idPengajuan)->update([
                'status'           => 'rejected',
                'alasan_penolakan' => $request->alasan,
                'updated_at'       => now(),
            ]);

            DB::table('persetujuan')->insert([
                'id_persetujuan' => $this->nextPersetujuanId(),
                'id_pengajuan'   => $idPengajuan,
                'id_user'        => session('id_user'),
                'status'         => 'rejected',
                'alasan'         => $request->alasan,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            if ($pengajuan->jenis_pengajuan === 'tambah_masjid') {
                DB::table('masjid')->where('id_masjid', $pengajuan->id_masjid)->delete();
            }
        });

        return back()->with('success', 'Pengajuan ditolak.');
    }
}
