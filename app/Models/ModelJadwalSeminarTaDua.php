<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelJadwalSeminarTaDua extends Model
{
    use HasFactory;

    protected $table = 'jadwal_seminar_ta_dua';
    protected $fillable = [
        'encrypt_id',
        'tanggal_seminar_ta_dua',
        'jam_mulai_seminar_ta_dua',
        'jam_selesai_seminar_ta_dua',
        'id_lokasi',
        'id_seminar',
        'created_at',
        'updated_at'
    ];

    public function seminar()
    {
        return $this->belongsTo(ModelSeminarTaDua::class, 'id_seminar');
    }
    public function lokasi()
    {
        return $this->belongsTo(ModelLokasiSeminar::class, 'id_lokasi');
    }
}
