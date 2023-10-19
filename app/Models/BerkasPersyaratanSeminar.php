<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPersyaratanSeminar extends Model
{
    use HasFactory;
    protected $table = 'file_kelengkapan_seminar';
    protected $fillable = [
        'id',
        'encrypt_id',
        'nama_file',
        'path_file',
        'created_at',
        'updated_at',
    ];
}
