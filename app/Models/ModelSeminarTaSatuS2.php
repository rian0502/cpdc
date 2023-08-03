<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelSeminarTaSatuS2 extends Model
{
    use HasFactory;
    protected $table = 's2_tugas_akhir_1';
    protected $fillable = [
        'encrypt_id',
        'tahun_akademik',
        'semester',
        'sumber_penelitian',
        'periode_seminar',
        'judul_ta',
        'sks',
        'ipk',
        'toefl',
        'berkas_ta_satu',
        'agreement',
        'komentar',
        'status_admin',
        'status_koor',
        'id_pembimbing_satu',
        'id_pembimbing_dua',
        'pbl2_nama',
        'pbl2_nip',
        'id_pembahas_1',
        'id_pembahas_2',
        'id_pembahas_3',
        'id_mahasiswa',
        'pembahas_external_1',
        'nip_pembahas_external_1',
        'pembahas_external_2',
        'nip_pembahas_external_2',
        'pembahas_external_3',
        'nip_pembahas_external_3',
        'created_at',
        'updated_at'
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
    public function pembimbingSatu()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing_satu');
    }
    public function pembimbingDua()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing_dua');
    }
    public function pembahasSatu()
    {
        return $this->belongsTo(Dosen::class, 'id_pembahas_1');
    }
    public function pembahasDua()
    {
        return $this->belongsTo(Dosen::class, 'id_pembahas_2');
    }
    public function pembahasTiga()
    {
        return $this->belongsTo(Dosen::class, 'id_pembahas_3');
    }
    public function jadwal()
    {
        return $this->hasOne(ModelJadwalSeminarTaSatuS2::class, 'id_seminar');
    }
    public function beritaAcara()
    {
        return $this->hasOne(ModelBaSeminarTaSatuS2::class, 'id_seminar');
    }
}
