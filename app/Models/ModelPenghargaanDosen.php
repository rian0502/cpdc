<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPenghargaanDosen extends Model
{
    use HasFactory;
    protected $table = 'penghargaan_dosen';
    protected $fillable = [
        'encrypt_id',
        'nama',
        'tanggal',
        'uraian',
        'url',
        'scala',
        'kategori',
        'dosen_id'
    ];
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

}
