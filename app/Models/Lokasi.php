<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $fillable = [
        'encrypt_id',
        'nama_lokasi', 
        'lantai_tingkat',
        'nama_gedung',
        'created_at',
        'updated_at'
    ];
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_lokasi');
    }
    public function laboratoriums()
    {
        return $this->hasMany(Laboratorium::class, 'id_lokasi');
    }
    public function sopLabs()
    {
        return $this->hasMany(SopLab::class, 'id_lokasi');
    }

}
