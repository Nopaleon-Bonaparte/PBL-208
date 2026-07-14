<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * MasjidController
 *
 * Alur:
 *  1. Admin Ranting (R03) menambah masjid baru  -> status pending -> antrian cabang.
 *  2. Admin Ranting / Pengurus Masjid (R02) mengedit -> antrian cabang.
 *  3. Admin Cabang (R01) edit langsung (lihat updateCabang).
 *
 * Form lengkap: informasi dasar, legalitas/wakaf, inventaris, takmir awal.
 * Semua field tersimpan ke tabel masjid.
 */
class MasjidController extends Controller
{
    /* ───────────────────────── HELPER ───────────────────────── */

    private function nextMasjidId(): string
    {
        $last = DB::table('masjid')->orderBy('id_masjid', 'desc')->value('id_masjid');
        $n = $last ? ((int) substr($last, 1)) + 1 : 1;
        return 'M' . str_pad((string) $n, 3, '0', STR_PAD_LEFT);
    }

    private function nextPengajuanId(): string
    {
        $count = DB::table('pengajuan')->count() + 1;
        return 'PGJ' . str_pad((string) $count, 4, '0', STR_PAD_LEFT);
    }

    /** Aturan validasi seluruh field form. */
    private function rules(): array
    {
        return [
            'nama_masjid'      => 'required|string|max:100',
            'tipe'             => 'required|in:Masjid,Musholla',
            'alamat'           => 'nullable|string',
            'kecamatan'        => 'nullable|string|max:50',
            'kelurahan'        => 'nullable|string|max:50',
            'kapasitas'        => 'nullable|integer|min:0',
            'no_sk'            => 'nullable|string|max:100',
            'status_tanah'     => 'nullable|string|max:50',
            'jenis_sertifikat' => 'nullable|string|max:50',
            'no_sertifikat'    => 'nullable|string|max:100',
            'nama_nazir'       => 'nullable|string|max:100',
            'sound_system'        => 'nullable|string|max:30',
            'jumlah_sound_system' => 'nullable|integer|min:0',
            'jumlah_ac'           => 'nullable|integer|min:0',
            'kondisi_ac'          => 'nullable|string|max:50',
            'alat_kebersihan_list' => 'nullable|array',
            'alat_kondisi'         => 'nullable|array',
            'alat_jumlah'          => 'nullable|array',
            'sarana_list'                 => 'nullable|array',
            'sarana_kondisi'              => 'nullable|array',
            'sarana_jumlah'               => 'nullable|array',
            'sarana_keterangan_tambahan'  => 'nullable|string',
            'takmir_nama'      => 'nullable|string|max:100',
            'takmir_nik'       => 'nullable|string|max:20',
            'takmir_wa'        => 'nullable|string|max:20',
            'status_legalitas' => 'nullable|string|max:50',
            'foto_bangunan'    => 'nullable|image|max:5120',
            'file_sk'          => 'nullable|mimes:pdf|max:10240',
            'file_sertifikat'  => 'nullable|mimes:pdf|max:10240',
            'file_ktp'         => 'nullable|mimes:pdf|max:10240',
            'default_username' => 'required|string|max:100',
            'default_password' => 'nullable|string|min:6',
            'email'            => 'nullable|email|max:150',
        ];
    }

    /** Susun array kolom masjid dari request. */
    private function fields(Request $request, $existingMasjid = null): array
    {
        // wilayah diturunkan dari kecamatan (kompatibel dengan tampilan lama)
        $wilayah = $request->kecamatan ?: $request->input('wilayah');
        // kontak pengurus diturunkan dari nomor WA takmir
        $kontak  = $request->takmir_wa ?: $request->input('kontak_pengurus');
        $alatList = $request->input('alat_kebersihan_list', []);
        $alatKondisi = $request->input('alat_kondisi', []);
        $alatJumlah = $request->input('alat_jumlah', []);
        
        $alatData = [];
        foreach ($alatList as $item) {
            $alatData[$item] = [
                'kondisi' => $alatKondisi[$item] ?? '',
                'jumlah' => $alatJumlah[$item] ?? '',
            ];
        }
        $alat = !empty($alatData) ? json_encode($alatData) : null;

        $saranaList = $request->input('sarana_list', []);
        $saranaKondisi = $request->input('sarana_kondisi', []);
        $saranaJumlah = $request->input('sarana_jumlah', []);
        $saranaKeterangan = $request->input('sarana_keterangan_tambahan');
        
        $saranaData = [];
        foreach ($saranaList as $item) {
            $saranaData[$item] = [
                'kondisi' => $saranaKondisi[$item] ?? '',
                'jumlah' => $saranaJumlah[$item] ?? '',
            ];
        }
        if ($saranaKeterangan) {
            $saranaData['keterangan_tambahan'] = $saranaKeterangan;
        }
        $sarana = !empty($saranaData) ? json_encode($saranaData) : null;

        $foto_bangunan = $existingMasjid ? $existingMasjid->foto_bangunan : null;
        if ($request->hasFile('foto_bangunan')) {
            $foto_bangunan = $request->file('foto_bangunan')->store('uploads/masjid', 'public');
        }

        $file_sk = $existingMasjid ? $existingMasjid->file_sk : null;
        if ($request->hasFile('file_sk')) {
            $file_sk = $request->file('file_sk')->store('uploads/masjid', 'public');
        }

        $file_sertifikat = $existingMasjid ? $existingMasjid->file_sertifikat : null;
        if ($request->hasFile('file_sertifikat')) {
            $file_sertifikat = $request->file('file_sertifikat')->store('uploads/masjid', 'public');
        }

        $file_ktp = $existingMasjid ? $existingMasjid->file_ktp : null;
        if ($request->hasFile('file_ktp')) {
            $file_ktp = $request->file('file_ktp')->store('uploads/masjid', 'public');
        }

        $defaultPasswordVal = $request->filled('default_password') 
            ? $request->default_password 
            : ($existingMasjid ? $existingMasjid->default_password : 'masjid123');

        return [
            'nama_masjid'      => $request->nama_masjid,
            'tipe'             => $request->tipe,
            'alamat'           => $request->alamat,
            'wilayah'          => $wilayah,
            'kecamatan'        => $request->kecamatan,
            'kelurahan'        => $request->kelurahan,
            'kapasitas'        => $request->kapasitas ?: 0,
            'no_sk'            => $request->no_sk,
            'status_tanah'     => $request->status_tanah,
            'jenis_sertifikat' => $request->jenis_sertifikat,
            'no_sertifikat'    => $request->no_sertifikat,
            'nama_nazir'       => $request->nama_nazir,
            'sound_system'        => $request->sound_system,
            'jumlah_sound_system' => $request->jumlah_sound_system,
            'jumlah_ac'           => $request->jumlah_ac,
            'kondisi_ac'          => $request->kondisi_ac,
            'alat_kebersihan'  => $alat,
            'sarana_lainnya'   => $sarana,
            'takmir_nama'      => $request->takmir_nama,
            'takmir_nik'       => $request->takmir_nik,
            'takmir_wa'        => $request->takmir_wa,
            'kontak_pengurus'  => $kontak,
            'status_legalitas' => $request->status_legalitas ?: 'Proses',
            'foto_bangunan'    => $foto_bangunan,
            'file_sk'          => $file_sk,
            'file_sertifikat'  => $file_sertifikat,
            'file_ktp'         => $file_ktp,
            'default_username' => $request->default_username,
            'default_password' => $defaultPasswordVal,
            'email'            => $request->email,
        ];
    }

    /* ──────────────── ADMIN RANTING: TAMBAH MASJID ──────────────── */

    public function create()
    {
        if (session('id_role') != 'R03') return redirect('/dashboard');

        // Ambil kecamatan wilayah ranting yang sedang login
        $ranting = DB::table('ranting')->where('id_ranting', session('id_ranting'))->first();
        $kecamatanRanting = $ranting->kecamatan ?? null;

        return view('admin_ranting.tambah-data-masjid', compact('kecamatanRanting'));
    }

    public function store(Request $request)
    {
        if (session('id_role') != 'R03') return redirect('/dashboard');

        $request->validate($this->rules());

        $idMasjid  = $this->nextMasjidId();
        $idRanting = session('id_ranting');
        $idPengaju = session('id_user');
        $fields    = $this->fields($request);

        DB::transaction(function () use ($request, $idMasjid, $idRanting, $idPengaju, $fields) {
            // 1. Buat masjid berstatus pending (belum jadi).
            DB::table('masjid')->insert(array_merge($fields, [
                'id_masjid'        => $idMasjid,
                'id_ranting'       => $idRanting,
                'status_data'      => 'pending',
                'id_user_pengaju'  => $idPengaju,
            ]));

            // 2. Buat pengajuan ke admin cabang (data_baru = seluruh field).
            DB::table('pengajuan')->insert([
                'id_pengajuan'    => $this->nextPengajuanId(),
                'id_masjid'       => $idMasjid,
                'id_user_pengaju' => $idPengaju,
                'jenis_pengajuan' => 'tambah_masjid',
                'deskripsi'       => 'Penambahan data masjid/musholla baru oleh admin ranting.',
                'data_baru'       => json_encode($fields),
                'status'          => 'pending',
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        });

        return redirect('/prm/data-masjid')
            ->with('success', 'Data masjid berhasil diajukan. Menunggu persetujuan admin cabang.');
    }

    /* ──────────────── RANTING / PENGURUS: EDIT DATA ──────────────── */

    public function edit(string $idMasjid)
    {
        if (!in_array(session('id_role'), ['R03', 'R02'])) return redirect('/dashboard');

        $masjid = DB::table('masjid')->where('id_masjid', $idMasjid)->first();
        if (!$masjid) return redirect('/dashboard')->with('error', 'Masjid tidak ditemukan.');

        if (session('id_role') === 'R02' && session('id_masjid') !== $idMasjid) {
            return redirect('/masjid/informasi')->with('error', 'Anda tidak mengelola masjid ini.');
        }

        $base = session('id_role') === 'R02' ? '/masjid' : '/prm';

        return view('admin_ranting.tambah-data-masjid', [
            'masjid'    => $masjid,
            'mode'      => 'edit',
            'mode_base' => $base,
        ]);
    }

    public function update(Request $request, string $idMasjid)
    {
        if (!in_array(session('id_role'), ['R03', 'R02'])) return redirect('/dashboard');

        $masjid = DB::table('masjid')->where('id_masjid', $idMasjid)->first();
        if (!$masjid) return redirect('/dashboard')->with('error', 'Masjid tidak ditemukan.');

        if (session('id_role') === 'R02' && session('id_masjid') !== $idMasjid) {
            return redirect('/masjid/informasi')->with('error', 'Anda tidak mengelola masjid ini.');
        }

        $request->validate($this->rules());

        // Perubahan TIDAK langsung diterapkan -> masuk antrian persetujuan cabang.
        DB::table('pengajuan')->insert([
            'id_pengajuan'    => $this->nextPengajuanId(),
            'id_masjid'       => $idMasjid,
            'id_user_pengaju' => session('id_user'),
            'jenis_pengajuan' => 'edit_masjid',
            'deskripsi'       => 'Permohonan perubahan data masjid.',
            'data_baru'       => json_encode($this->fields($request, $masjid)),
            'status'          => 'pending',
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        $redirect = session('id_role') === 'R02' ? '/masjid/informasi' : '/prm/data-masjid';

        return redirect($redirect)
            ->with('success', 'Perubahan diajukan. Menunggu persetujuan admin cabang.');
    }

    /* ──────────────── ADMIN CABANG: EDIT LANGSUNG ──────────────── */

    public function editCabang(string $idMasjid)
    {
        if (session('id_role') != 'R01') return redirect('/dashboard');

        $masjid = DB::table('masjid')->where('id_masjid', $idMasjid)->first();
        if (!$masjid) return redirect('/pcm/sub-branches')->with('error', 'Masjid tidak ditemukan.');

        $rantingIds = DB::table('ranting')->where('id_cabang', session('id_cabang'))->pluck('id_ranting')->all();
        if (!in_array($masjid->id_ranting, $rantingIds)) {
            return redirect('/pcm/sub-branches')->with('error', 'Bukan wewenang cabang Anda.');
        }

        return view('admin_ranting.tambah-data-masjid', [
            'masjid'    => $masjid,
            'mode'      => 'edit',
            'mode_base' => '/pcm',
        ]);
    }

    public function updateCabang(Request $request, string $idMasjid)
    {
        if (session('id_role') != 'R01') return redirect('/dashboard');

        $masjid = DB::table('masjid')->where('id_masjid', $idMasjid)->first();
        if (!$masjid) return redirect('/pcm/sub-branches')->with('error', 'Masjid tidak ditemukan.');

        $rantingIds = DB::table('ranting')->where('id_cabang', session('id_cabang'))->pluck('id_ranting')->all();
        if (!in_array($masjid->id_ranting, $rantingIds)) {
            return redirect('/pcm/sub-branches')->with('error', 'Bukan wewenang cabang Anda.');
        }

        $request->validate($this->rules());

        // Admin cabang: perubahan langsung diterapkan.
        DB::table('masjid')->where('id_masjid', $idMasjid)->update($this->fields($request, $masjid));

        return redirect('/pcm/sub-branches')->with('success', 'Data masjid berhasil diperbarui.');
    }
}
