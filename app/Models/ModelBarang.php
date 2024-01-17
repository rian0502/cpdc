<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBarang extends Model
{
    use HasFactory;
    protected $table = 'model_barang';
    protected $fillable = [
        'encrypt_id',
        'nama_model',
        'merk',
        'id_kategori',
        'created_at',
        'updated_at'
    ];
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_model');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
