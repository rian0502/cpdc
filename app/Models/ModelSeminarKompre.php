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

    public function getJadwalDosenDate($id_dosen)
    {
        return $this->join(
            'jadwal_seminar_komprehensif',
            'seminar_komprehensif.id',
            '=',
            'jadwal_seminar_komprehensif.id_seminar'
        )
            ->where(function ($query) use ($id_dosen) {
                $query->where('seminar_komprehensif.id_pembimbing_satu', $id_dosen)
                    ->orWhere('seminar_komprehensif.id_pembimbing_dua', $id_dosen)
                    ->orWhere('seminar_komprehensif.id_pembahas', $id_dosen);
            })
            ->where('jadwal_seminar_komprehensif.tanggal_komprehensif', '>=', date('Y-m-d'))
            ->select('seminar_komprehensif.id', 'seminar_komprehensif.judul_ta', 'seminar_komprehensif.id_mahasiswa')
            ->orderBy('jadwal_seminar_komprehensif.tanggal_komprehensif', 'asc')
            ->get();
    }
    public function getInvalidJumlahBerkas()
    {
        return $this->where('status_koor', 'Belum Selesai')
            ->orWhere('status_koor', 'Perbaikan')
            ->whereHas('beritaAcara', function ($query) {
                $query->where('seminar_komprehensif.id', 'ba_seminar_komprehensif.id_seminar');
            })->count();
    }

    public function getJumlahJadwal()
    {
        return $this->where('status_admin', 'Valid')
            ->whereDoesntHave('jadwal')->count();
    }
}
