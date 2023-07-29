<?php

namespace App\Models;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(Dosen::class);
    }
}
