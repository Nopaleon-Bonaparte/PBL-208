<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    protected $table = 'persetujuan';
    protected $primaryKey = 'id_persetujuan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_persetujuan',
        'id_pengajuan',
        'id_user',
        'status',
        'alasan',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}