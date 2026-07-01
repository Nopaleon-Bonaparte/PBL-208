<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = 'id_pengajuan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pengajuan',
        'id_masjid',
        'id_user_pengaju',
        'jenis_pengajuan',   // tambah_masjid | edit_masjid
        'deskripsi',
        'data_baru',         // JSON usulan perubahan/penambahan
        'status',            // pending | approved | rejected
        'alasan_penolakan',
    ];

    protected $casts = [
        'data_baru' => 'array',
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'id_masjid', 'id_masjid');
    }

    public function pengaju()
    {
        return $this->belongsTo(User::class, 'id_user_pengaju', 'id_user');
    }

    public function persetujuan()
    {
        return $this->hasOne(Persetujuan::class, 'id_pengajuan', 'id_pengajuan');
    }
}
