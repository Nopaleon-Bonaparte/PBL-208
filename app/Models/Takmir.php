<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Takmir extends Model
{
    protected $table = 'takmir';
    protected $primaryKey = 'id_takmir';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_takmir',
        'id_masjid',
        'nama',
        'jabatan',
        'no_hp',
        'masa_jabatan_mulai',
        'masa_jabatan_selesai',
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'id_masjid', 'id_masjid');
    }
}