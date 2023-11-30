<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaLitabmas extends Model
{
    use HasFactory;
    protected $table = 'anggota_litabmas_dosen';
    protected $fillable = [
        'Posisi',
        'dosen_id',
        'litabmas_id',
        'created_at',
        'updated_at'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
    public function litabmas()
    {
        return $this->belongsTo(LitabmasDosen::class, 'litabmas_id', 'id');
    }
}
