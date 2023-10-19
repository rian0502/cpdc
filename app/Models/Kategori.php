<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = [
        'nama_kategori',
        'ket',
        'encrypt_id',
        'created_at',
        'updated_at'
    ];

    public function barangs()
    {
        return $this->hasMany(ModelBarang::class, 'id_kategori');
    }
}
