<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelJadwalSeminarTaSatu extends Model
{
    use HasFactory;
    protected $table = 'jadwal_seminar_ta_satu';
    protected $fillable = [
        'encrypt_id',
        'tanggal_seminar_ta_satu',
        'jam_mulai_seminar_ta_satu',
        'jam_selesai_seminar_ta_satu',
        'id_lokasi',
        'id_seminar'
    ];
    public function seminar (){
        return $this->belongsTo(ModelSeminarTaSatu::class, 'id_seminar');
    }
    public function lokasi(){
        return $this->belongsTo(ModelLokasiSeminar::class, 'id_lokasi');
    }
}
