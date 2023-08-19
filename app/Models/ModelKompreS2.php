<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKompreS2 extends Model
{
    use HasFactory;
    protected $table = 's2_kompre';
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
        'draft_artikel',
        'url_draft_artikel',
        'id_pembimbing_1',
        'id_pembimbing_2',
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
        return $this->belongsTo(Dosen::class, 'id_pembimbing_1');
    }
    public function pembimbingDua()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing_2');
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
        return $this->hasOne(ModelJadwalSeminarKompreS2::class, 'id_seminar');
    }
    public function beritaAcara()
    {
        return $this->hasOne(ModelBaKompreS2::class, 'id_seminar');
    }
    public function getJadwalDosenDate($id_dosen)
    {
        return $this->join('jadwal_s2_kompre', 's2_kompre.id', '=', 'jadwal_s2_kompre.id_seminar')
            ->where(function ($query) use ($id_dosen) {
                $query->where('s2_kompre.id_pembimbing_1', $id_dosen)
                    ->orWhere('s2_kompre.id_pembimbing_2', $id_dosen)
                    ->orWhere('s2_kompre.id_pembahas_1', $id_dosen)
                    ->orWhere('s2_kompre.id_pembahas_2', $id_dosen)
                    ->orWhere('s2_kompre.id_pembahas_3', $id_dosen);
            })
            ->where('jadwal_s2_kompre.tanggal', '>=', date('Y-m-d'))
            ->select('s2_kompre.id', 's2_kompre.judul_ta', 's2_kompre.id_mahasiswa')
            ->orderBy('jadwal_s2_kompre.tanggal', 'asc')
            ->get();
    }

    public function getInvalidJumlahBerkas()
    {
        return $this->where('status_koor', 'Belum Selesai')
            ->orWhere('status_koor', 'Perbaikan')
            ->whereHas('beritaAcara', function ($query) {
                $query->where('s2_kompre.id', 'ba_s2_kompre.id_seminar');
            })->count();
    }

    public function getJumlahJadwal()
    {
        return $this->where('status_admin', 'Valid')
            ->whereDoesntHave('jadwal')->count();
    }
}
