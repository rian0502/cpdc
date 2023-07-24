<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelGelar extends Model
{
    use HasFactory;
    protected $table = 'gelar';

    protected $fillable = [
        'encrypt_id',
        'instansi_pendidikan',
        'jurusan',
        'tahun_lulus',
        'nama_gelar',
        'singkatan_gelar',
        'dosen_id',
        'created_at',
        'updated_at',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
}
