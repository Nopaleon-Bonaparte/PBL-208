<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legalitas extends Model
{
    protected $table = 'legalitas';
    protected $primaryKey = 'id_legalitas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_legalitas',
        'id_masjid',
        'jenis_sertifikat',
        'nomor_sertifikat',
        'tanggal_terbit',
        'status',
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'id_masjid', 'id_masjid');
    }
}