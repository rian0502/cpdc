<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\AnggotaPublikasiDosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublikasiDosen extends Model
{
    use HasFactory;

    protected $table = 'publikasi';
    protected $fillable = [
        'encrypt_id',
        'nama_publikasi',
        'vol',
        'halaman',
        'judul',
        'tahun',
        'scala',
        'kategori',
        'kategori_litabmas',
        'url',
        'jumlah_kutipan',
        'anggota_external'
    ];

    public function anggotaPublikasi(){
        return $this->hasMany(AnggotaPublikasiDosen::class, 'id_publikasi');
    }

    public function dosens(){
        return $this->hasManyThrough(
            Dosen::class,
            AnggotaPublikasiDosen::class,
            'id_publikasi',
            'id_dosen',
        );
    }

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'anggota_publikasi', 'id_publikasi', 'id_dosen')->withPivot('posisi');
    }

    // public function KetuaPublikasi()
    // {
    //     return $this->belongsToMany(Dosen::class, 'anggota_publikasi', 'id_publikasi', 'id_dosen')
    //         ->wherePivot('posisi', 'Ketua')
    //         ->first();
    // }
}
