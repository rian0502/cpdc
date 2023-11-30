<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopLab extends Model
{
    use HasFactory;
    protected $table = 'sop_lab';
    protected $fillable = [
        'encrypt_id',
        'nama_sop',
        'id_lokasi',
        'file_sop',
        'created_at',
        'updated_at',
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id');
    }
}
