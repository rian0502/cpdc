<?php

namespace App\Models;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnggotaPublikasiDosen extends Model
{
    use HasFactory;

    protected $table = 'anggota_publikasi';

    protected $fillable = [
        'id_dosen',
        'id_publikasi',
        'posisi',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id');
    }
    public function publikasi()
    {
        return $this->belongsTo(Publikasi::class, 'id_publikasi', 'id');
    }
}
