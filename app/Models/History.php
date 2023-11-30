<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'history';
    protected $fillable = [
        'id_barang', 
        'junlah_awal',
        'encrypt_id',
        'ket',
        'created_at',
        'updated_at'
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
