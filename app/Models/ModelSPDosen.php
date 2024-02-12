<?php

namespace App\Models;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelSPDosen extends Model
{
    use HasFactory;
    protected $table = 'sp_dosen';
    protected $fillable = [
        'encrypt_id',
        'nama',
        'scala',
        'tanggal',
        'uraian',
        'url',
        'dosen_id'
    ];
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
