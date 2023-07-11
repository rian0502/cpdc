<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Laboratorium extends Model
{
    use HasFactory;
    protected $table = 'activity_lab';
    protected $primaryKey = 'id';
    protected $fillable = [
        'encrypted_id',
        'nama_kegiatan',
        'tanggal_kegiatan',
        'jam_mulai',
        'jam_selesai',
        'id_lokasi',
        'keperluan',
        'keterangan',
        'jumlah_mahasiswa',
        'created_at',
        'updated_at',
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id');
    }
}
