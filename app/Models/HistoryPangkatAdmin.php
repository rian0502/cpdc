<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPangkatAdmin extends Model
{
    use HasFactory;

    protected $table = 'history_pangkat_admin';
    protected $fillable = [
        'encrypt_id',
        'pangkat',
        'tgl_sk',
        'file_sk',
        'administrasi_id',
        'created_at',
        'updated_at'
    ];

    public function administrasi()
    {
        return $this->belongsTo(Administrasi::class, 'administrasi_id', 'id');
    }
}
