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
        return $this->hasOne(ModelJadwalSeminarTaSatuS2::class, 'id_seminar');
    }
    public function beritaAcara()
    {
        return $this->hasOne(ModelBaSeminarTaSatuS2::class, 'id_seminar');
    }

    public function getJadwalDosenDate($id_dosen)
    {
        return $this->join('jadwal_s2_seminar_ta1', 's2_tugas_akhir_1.id', '=', 'jadwal_s2_seminar_ta1.id_seminar')
            ->where(function ($query) use ($id_dosen) {
                $query->where('s2_tugas_akhir_1.id_pembimbing_satu', $id_dosen)
                    ->orWhere('s2_tugas_akhir_1.id_pembimbing_dua', $id_dosen)
                    ->orWhere('s2_tugas_akhir_1.id_pembahas', $id_dosen)
                    ->orWhere('s2_tugas_akhir_1.id_pembahas_1', $id_dosen)
                    ->orWhere('s2_tugas_akhir_1.id_pembahas_2', $id_dosen)
                    ->orWhere('s2_tugas_akhir_1.id_pembahas_3', $id_dosen);
            })
            ->where('jadwal_s2_seminar_ta1.tanggal', '>=', date('Y-m-d'))
            ->select('s2_tugas_akhir_1.id', 's2_tugas_akhir_1.judul_ta', 's2_tugas_akhir_1.id_mahasiswa')
            ->orderBy('jadwal_s2_seminar_ta1.tanggal', 'asc')
            ->get();
    }

    public function getInvalidJumlahBerkas()
    {
        return $this->where('status_koor', 'Belum Selesai')
            ->orWhere('status_koor', 'Perbaikan')
            ->whereHas('beritaAcara', function ($query) {
                $query->where('s2_tugas_akhir_1.id', 'ba_s2_seminar_ta1.id_seminar');
            })->count();
    }

    public function getJumlahJadwal()
    {
        return $this->where('status_admin', 'Valid')
            ->whereDoesntHave('jadwal')->count();
    }
}
