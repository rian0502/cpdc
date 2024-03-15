<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelSeminarKP extends Model
{
    use HasFactory;

    protected $table = 'seminar_kp';
    protected $fillable = [
        'encrypt_id',
        'judul_kp',
        'semester',
        'tahun_akademik',
        'mitra',
        'region',
        'rencana_seminar',
        'pembimbing_lapangan',
        'ni_pemlap',
        'toefl',
        'sks',
        'ipk',
        'berkas_seminar_pkl',
        'agreement',
        'status_seminar',
        'proses_admin',
        'keterangan',
        'id_dospemkp',
        'id_mahasiswa',
        'created_at',
        'updated_at'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dospemkp');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
    public function jadwal()
    {
        return $this->hasOne(JadwalSKP::class, 'id_skp');
    }
    public function berita_acara(){
        return $this->hasOne(BaSKP::class, 'id_seminar');
    }

    public function getJadwalDosenDate($id_dosen){
        return $this->join('jadwal_skp', 'seminar_kp.id', '=', 'jadwal_skp.id_skp')
        ->where('seminar_kp.id_dospemkp', $id_dosen)
        ->where('jadwal_skp.tanggal_skp', '>=', date('Y-m-d'))
        ->select('seminar_kp.id', 'seminar_kp.judul_kp', 'seminar_kp.id_mahasiswa', 'seminar_kp.judul_kp')
        ->orderBy('jadwal_skp.tanggal_skp', 'asc')
        ->get();
    }
    public function getSeminarKumpulBa(){
        return $this->join('ba_seminar_kp', 'seminar_kp.id', '=', 'ba_seminar_kp.id_seminar')
        ->where('seminar_kp.status_seminar', 'Belum Selesai')
        ->select('seminar_kp.id','seminar_kp.encrypt_id','seminar_kp.id_mahasiswa', 'seminar_kp.judul_kp', 'ba_seminar_kp.no_ba_seminar_kp')
        ->orderBy('seminar_kp.updated_at', 'asc')
        ->get();
    }
}
