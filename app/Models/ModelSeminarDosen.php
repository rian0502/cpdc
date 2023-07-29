<?php

namespace App\Models;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelSeminarDosen extends Model
{
    use HasFactory;

    protected $table = 'seminar_dosen';
    protected $fillable = [
        'encrypt_id',
        'nama',
        'tahun',
        'scala',
        'uraian',
        'url',
        'dosen_id'
    ];
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
