<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiMahasiswaS2 extends Model
{
    use HasFactory;
    protected $table = 'prestasi_mahasiswa_s2';
    protected $fillable = [
        'id',
        'encrypt_id',
        'nama_prestasi',
        'scala',
        'capaian',
        'file_prestasi',
        'tanggal',
        'mahasiswa_id',
        'jenis',
        'id_pembimbing',
        'nama_pembimbing',
        'nip_pembimbing',
        'created_at',
        'updated_at',
    ];
    public function prestasi()
    {
        return $this->hasMany(PrestasiMahasiswaS2::class, 'id');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing');
    }
    public function getTahunAttribute()
    {
        return date('Y', strtotime($this->tanggal));
    }
}
