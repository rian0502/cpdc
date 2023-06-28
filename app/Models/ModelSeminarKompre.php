<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSeminarKompre extends Model
{
    use HasFactory;
    protected $table = 'seminar_komprehensif';
    protected $fillable = [
        'encrypt_id',
        'tahun_akademik',
        'semester',
        'periode_seminar',
        'judul_ta',
        'sks',
        'ipk',
        'toefl',
        'berkas_kompre',
        'agreement',
        'komentar',
        'status_admin',
        'status_koor',
        'id_pembimbing_satu',
        'id_pembimbing_dua',
        'pbl2_nama',
        'pbl2_nip',
        'id_pembahas',
        'id_mahasiswa',
        'created_at',
        'updated_at'
    ];

    public function pembimbingSatu()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing_satu');
    }
    public function pembimbingDua()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing_dua');
    }
    public function pembahas()
    {
        return $this->belongsTo(Dosen::class, 'id_pembahas');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
    public function jadwal()
    {
        return $this->hasOne(ModelJadwalSeminarKompre::class, 'id_seminar');
    }
    public function beritaAcara()
    {
        return $this->hasOne(ModelBaSeminarKompre::class, 'id_seminar');
    }
}
