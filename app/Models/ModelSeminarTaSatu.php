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
        'sks',
        'ipk',
        'toefl',
        'berkas_ta_satu',
        'agreement',
        'status_admin',
        'status_koor',
        'id_pembimbing_satu',
        'id_pembimbing_dua',
        'pbl2_nama',
        'pbl2_nip',
        'pembahas',
        'id_mahasiswa',
        'created_at',
        'updated_at'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(ModelMahasiswa::class, 'id_mahasiswa');
    }
    public function pembimbing_satu()
    {
        return $this->belongsTo(ModelPembimbing::class, 'id_pembimbing');
    }
    public function pembimbing_dua(){
        return $this->belongsTo(ModelPembimbing::class, 'id_pembimbing_dua');
    }
    public function pembahas(){
        return $this->belongsTo(ModelPembimbing::class, 'id_pembahas');
    }
    public function jadwal(){
        return $this->hasOne(ModelJadwalSeminarTaSatu::class);
    }
    public function ba_seminar(){
        return $this->hasOne(ModelBaSeminarTaSatu::class);
    }
}
