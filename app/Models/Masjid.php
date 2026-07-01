<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    protected $table = 'masjid';
    protected $primaryKey = 'id_masjid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_masjid', 'nama_masjid', 'tipe', 'id_ranting', 'wilayah', 'alamat',
        'kecamatan', 'kelurahan', 'kapasitas', 'no_sk',
        'status_tanah', 'jenis_sertifikat', 'no_sertifikat', 'nama_nazir',
        'sound_system', 'jumlah_ac', 'alat_kebersihan', 'sarana_lainnya',
        'takmir_nama', 'takmir_nik', 'takmir_wa',
        'kontak_pengurus', 'status_legalitas', 'status_data',
        'id_user_pengaju', 'default_username', 'default_password',
    ];

    public function ranting()
    {
        return $this->belongsTo(\App\Models\Ranting::class, 'id_ranting', 'id_ranting');
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id_masjid', 'id_masjid');
    }
}
