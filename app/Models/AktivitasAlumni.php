<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasAlumni extends Model
{
    use HasFactory;
    protected $table = 'aktivitas_alumni';
    protected $fillable = [
        'encrypted_id',
        'tempat',
        'alamat',
        'jabatan',
        'tahun_masuk',
        'hubungan',
        'gaji',
        'status',
        'mahasiswa_id',
        'created_at',
        'updated_at'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
