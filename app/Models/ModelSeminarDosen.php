<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(ModelDosen::class);
    }
}
