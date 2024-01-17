<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mahasiswas()
    {
        return $this->hasManyThrough(
            Mahasiswa::class,
            AsistenLab::class,
            'id_actity_lab',
            'id_mahasiswa'
        );
    }
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'asisten_lab', 'id_actity_lab', 'id_mahasiswa');
    }
    public function asisten_lab()
    {
        return $this->hasMany(AsistenLab::class, 'id_actity_lab');
    }
}
