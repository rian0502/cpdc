<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelJadwalSeminarKompre extends Model
{
    use HasFactory;

    protected $table = 'jadwal_seminar_komprehensif';
    protected $fillable = [
        'encrypt_id',
        'tanggal_komprehensif',
        'jam_mulai_komprehensif',
        'jam_selesai_komprehensif',
        'id_lokasi',
        'id_seminar',
        'created_at',
        'updated_at'
    ];
    public function seminar()
    {
        return $this->belongsTo(ModelSeminarKompre::class, 'id_seminar');
    }
    public function lokasi()
    {
        return $this->belongsTo(ModelLokasiSeminar::class, 'id_lokasi');
    }
}
