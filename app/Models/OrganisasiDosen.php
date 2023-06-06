<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiDosen extends Model
{
    use HasFactory;
    protected $table = 'organisasi_dosen';

    protected $fillable = [
        'encrypt_id',
        'nama_organisasi',
        'tahun_menjabat',
        'tahun_berakhir',
        'jabatan',
        'dosen_id',
        'created_at',
        'updated_at',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
}
