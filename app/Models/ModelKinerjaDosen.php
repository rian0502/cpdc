<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKinerjaDosen extends Model
{
    use HasFactory;
    protected $table = 'kinerja_dosen';
    protected $fillable =  [
        'encrypted_id',
        'semester',
        'tahun_akademik',
        'sks_pendidikan',
        'sks_penelitian',
        'sks_pengabdian',
        'sks_penunjang',
        'dosen_id',
        'created_at',
        'updated_at'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
