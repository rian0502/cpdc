<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class ModelSeminarTaSatu extends Model
{
    use HasFactory;
    protected $table = 'seminar_ta_satu';
    protected $fillable = [
        'encrypt_id',
        'tahun_akademik',
        'semester',
        'periode_seminar',
        'judul_ta',
        'sumber_penelitian',
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
        return $this->hasOne(ModelJadwalSeminarTaSatu::class, 'id_seminar');
    }
    public function ba_seminar()
    {
        return $this->hasOne(ModelBaSeminarTaSatu::class, 'id_seminar');
    }

    public function getJadwalDosenDate($id_dosen)
    {
        return $this->join('jadwal_seminar_ta_satu', 'seminar_ta_satu.id', '=', 'jadwal_seminar_ta_satu.id_seminar')
            ->where('seminar_ta_satu.id_pembimbing_satu', $id_dosen)
            ->orWhere('seminar_ta_satu.id_pembimbing_dua', $id_dosen)
            ->orWhere('seminar_ta_satu.id_pembahas', $id_dosen)
            ->where('jadwal_seminar_ta_satu.tanggal_seminar_ta_satu', '>=', date('Y-m-d'))
            ->select('seminar_ta_satu.id', 'seminar_ta_satu.judul_ta', 'seminar_ta_satu.id_mahasiswa')
            ->orderBy('jadwal_seminar_ta_satu.tanggal_seminar_ta_satu', 'asc')
            ->get();
    }

    public function getInvalidJumlahBerkas()
    {
        return $this->where('status_koor', 'Belum Selesai')
            ->orWhere('status_koor', 'Perbaikan')
            ->whereHas('ba_seminar', function ($query) {
                $query->where('seminar_ta_satu.id', 'ba_seminar_ta_satu.id_seminar');
            })->count();
    }

    public function getJumlahJadwal(){
        return $this->where('status_admin', 'Valid')
        ->whereDoesntHave('jadwal')->count();
    }
}
