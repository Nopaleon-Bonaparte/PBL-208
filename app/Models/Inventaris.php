<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'id_inventaris';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_inventaris',
        'id_masjid',
        'nama_barang',
        'jumlah',
        'kondisi',
        'tanggal_pengadaan',
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'id_masjid', 'id_masjid');
    }
}