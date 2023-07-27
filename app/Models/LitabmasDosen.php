<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\AnggotaLitabmas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LitabmasDosen extends Model
{
    use HasFactory;

    protected $table = 'litabmas_dosen';

    protected $fillable = [
        'encrypt_id',
        'nama_litabmas',
        'kategori',
        'sumber_dana',
        'jumlah_dana',
        'tahun_penelitian',
        'anggota_external',
        'url',
        'created_at',
        'updated_at',
    ];
    public function anggota_litabmas(){
        return $this->hasMany(AnggotaLitabmas::class, 'litabmas_id');
    }
    
    public function dosens(){
        return $this->haasManyThrough(
            Dosen::class,
            AnggotaLitabmas::class,
            'litabmas_id',
            'dosen_id',
        );
    }
    public function dosen(){
        return $this->belongsToMany(Dosen::class, 'anggota_litabmas_dosen', 'litabmas_id', 'dosen_id')->withPivot('Posisi');
    }
}
