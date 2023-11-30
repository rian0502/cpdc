<?php

namespace App\Models;

use App\Models\Lokasi;
use App\Models\ModelSeminarKP;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalSKP extends Model
{
    use HasFactory;

    protected $table = 'jadwal_skp';
    protected $fillable = [
        'encrypt_id',
        'tanggal_skp',
        'jam_mulai_skp',
        'jam_selesai_skp',
        'id_skp',
        'id_lokasi',
    ];

    public function skp()
    {
        return $this->belongsTo(ModelSeminarKP::class, 'id_skp');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
}
