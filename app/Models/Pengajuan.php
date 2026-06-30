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
        'jenis_pengajuan',
        'deskripsi',
        'status',
        'alasan_penolakan',
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'id_masjid', 'id_masjid');
    }

    public function persetujuan()
    {
        return $this->hasOne(Persetujuan::class, 'id_pengajuan', 'id_pengajuan');
    }
}