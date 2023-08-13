<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelJadwalSeminarTaSatuS2 extends Model
{
    use HasFactory;
    protected $table = 'jadwal_s2_seminar_ta1';
    protected $fillable = [
        'encrypt_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'id_lokasi',
        'id_seminar',
        'created_at',
        'updated_at'
    ];
    public function seminar()
    {
        return $this->belongsTo(ModelSeminarTaSatuS2::class, 'id_seminar');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
}
