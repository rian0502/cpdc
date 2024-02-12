<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasMahasiswaS2 extends Model
{
    use HasFactory;
    protected $table = "aktivitas_mahasiswa_s2";
    protected $fillable = [
        "encrypt_id",
        "nama_aktivitas",
        "peran",
        "sks_konversi",
        "tanggal",
        "kategori",
        "file_aktivitas",
        "mahasiswa_id",
        "skala",
        "jenis",
        "kategori",
        "mahasiswa_id",
        "id_pembimbing",
        "nama_pembimbing",
        "nip_pembimbing",
        "created_at",
        "updated_at",
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing');
    }
}
