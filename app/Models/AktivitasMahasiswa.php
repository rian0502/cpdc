<?php

namespace App\Models;


use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasMahasiswa extends Model
{
    use HasFactory;
    protected $table = "aktivitas_mahasiswa";
    protected $fillable = [
        "encrypt_id",
        "nama_aktivitas",
        "peran",
        "sks_konversi",
        "tanggal",
        "file_aktivitas",
        "mahasiswa_id",
        "created_at",
        "updated_at",
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
