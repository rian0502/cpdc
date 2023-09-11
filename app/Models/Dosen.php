<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\LitabmasDosen;
use App\Models\PublikasiDosen;
use App\Models\AnggotaLitabmas;
use App\Models\OrganisasiDosen;
use App\Models\HistoryJabatanDosen;
use App\Models\HistoryPangkatDosen;
use App\Models\AnggotaPublikasiDosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    protected $fillable = [
        'nip',
        'encrypt_id',
        'nidn',
        'nama_dosen',
        'no_hp',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'alamat',
        'status',
        'user_id',
        'foto_profile',
        'created_at',
        'updated_at'
    ];
    public function litabmas()
    {
        return $this->hasManyThrough(
            LitabmasDosen::class,
            AnggotaLitabmas::class,
            'dosen_id',
            'id',
            'id',
            'litabmas_id'
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_dosen');
    }
    public function organisasi()
    {
        return $this->hasMany(OrganisasiDosen::class, 'dosen_id')->orderBy('tahun_menjabat', 'desc');
    }
    public function jabatan()
    {
        return $this->hasMany(HistoryJabatanDosen::class, 'dosen_id');
    }
    public function jabatanTerakhir(){
        return $this->hasOne(HistoryJabatanDosen::class, 'dosen_id')->orderBy('tgl_sk', 'desc');
    }
    public function pangkatTerakhir(){
        return $this->hasOne(HistoryPangkatDosen::class, 'dosen_id')->orderBy('tgl_sk', 'desc');
    }
    public function pangkat()
    {
        return $this->hasMany(HistoryPangkatDosen::class, 'dosen_id');
    }
    public function publikasi()
    {
        return $this->hasManyThrough(
            PublikasiDosen::class,
            AnggotaPublikasiDosen::class,
            'id_dosen',
            'id',
            'id',
            'id_publikasi'
        );
    }
    public function seminar()
    {
        return $this->hasMany(ModelSPDosen::class, 'dosen_id')->where('jenis', 'Seminar')->orderBy('tahun', 'desc');
    }
    public function penghargaan()
    {
        return $this->hasMany(ModelSPDosen::class, 'dosen_id')->where('jenis', 'Penghargaan')->orderBy('tahun', 'desc');
    }
}
