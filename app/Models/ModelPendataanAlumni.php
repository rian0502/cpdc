<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelPendataanAlumni extends Model
{
    use HasFactory;
    protected $table = 'pendataan_alumni';
    protected $fillable = [
        'encrypted_id',
        'tahun_akademik',
        'sks',
        'ipk',
        'tgl_lulus',
        'masa_studi',
        'periode_wisuda',
        'toefl',
        'berkas_pengesahan',
        'transkrip',
        'berkas_toefl',
        'status',
        'komentar',
        'mahasiswa_id',
        'created_at',
        'updated_at'
    ];
    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
