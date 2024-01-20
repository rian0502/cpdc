<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPublikasiMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'publikasi_mahasiswa';
    protected $fillable = [
        'encrypt_id',
        'nama_publikasi',
        'judul',
        'tahun',
        'vol',
        'halaman',
        'scala',
        'kategori',
        'url',
        'anggota',
        'mahasiswa_id',
        'created_at',
        'updated_at'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class);
    }



}
