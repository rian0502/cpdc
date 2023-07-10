<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use JadwalSeminarTaDua;

class ModelSeminarTaDua extends Model
{
    use HasFactory;
    protected $table = 'seminar_ta_dua';
    protected $fillable = [
        'encrypt_id',
        'tahun_akademik',
        'semester',
        'periode_seminar',
        'judul_ta',
        'sks',
        'ipk',
        'toefl',
        'berkas_ta_dua',
        'komentar',
        'agreement',
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

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
    public function pembimbing_satu()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing_satu');
    }
    public function pembimbing_dua()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing_dua');
    }
    public function pembahas()
    {
        return $this->belongsTo(Dosen::class, 'id_pembahas');
    }
    public function jadwal()
    {
        return $this->hasOne(ModelJadwalSeminarTaDua::class, 'id_seminar');
    }
    public function ba_seminar()
    {
        return $this->hasOne(ModelBaSeminarTaDua::class, 'id_seminar');
    }

    public function getJadwalDosenDate($id_dosen)
    {
        return $this->join('jadwal_seminar_ta_dua', 'seminar_ta_dua.id', '=', 'jadwal_seminar_ta_dua.id_seminar')
            ->where('seminar_ta_dua.id_pembimbing_satu', $id_dosen)
            ->orWhere('seminar_ta_dua.id_pembimbing_dua', $id_dosen)
            ->orWhere('seminar_ta_dua.id_pembahas', $id_dosen)
            ->where('jadwal_seminar_ta_dua.tanggal_seminar_ta_dua', '>=', date('Y-m-d'))
            ->select('seminar_ta_dua.id', 'seminar_ta_dua.judul_ta', 'seminar_ta_dua.id_mahasiswa')
            ->orderBy('jadwal_seminar_ta_dua.tanggal_seminar_ta_dua', 'asc')
            ->get();
    }
    public function getInvalidJumlahBerkas()
    {
        return $this->where('status_koor', 'Belum Selesai')
            ->orWhere('status_koor', 'Perbaikan')
            ->whereHas('ba_seminar', function ($query) {
                $query->where('seminar_ta_dua.id', 'ba_seminar_ta_dua.id_seminar');
            })->count();
    }

    public function getJumlahJadwal()
    {
        return $this->where('status_admin', 'Valid')
            ->whereDoesntHave('jadwal')->count();
    }
}
