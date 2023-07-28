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
        'scala',
        'tahun',
        'uraian',
        'url',
        'dosen_id'
    ];
    public function dosen()
    {
        return $this->belongsTo(ModelDosen::class);
    }
}
