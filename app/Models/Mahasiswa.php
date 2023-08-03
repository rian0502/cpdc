<?php

namespace App\Models;

use App\Models\User;
use App\Models\Dosen;
use App\Models\ModelSeminarKP;
use App\Models\AktivitasAlumni;
use App\Models\ModelSeminarTaDua;
use App\Models\PrestasiMahasiswa;
use App\Models\AktivitasMahasiswa;
use App\Models\ModelSeminarKompre;
use App\Models\ModelSeminarTaSatu;
use App\Models\ModelPendataanAlumni;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'npm',
        'nama_mahasiswa',
        'tanggal_lahir',
        'tempat_lahir',
        'no_hp',
        'alamat',
        'jenis_kelamin',
        'tanggal_masuk',
        'angkatan',
        'semester',
        'status',
        'id_dosen',
        'user_id',
        'created_at',
        'updated_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
    public function aktivitas()
    {
        return $this->hasMany(AktivitasMahasiswa::class);
    }
    public function prestasi()
    {
        return $this->hasMany(PrestasiMahasiswa::class);
    }
    public function seminar_kp()
    {
        return $this->hasOne(ModelSeminarKP::class, 'id_mahasiswa');
    }
    public function ta_satu()
    {
        return $this->hasOne(ModelSeminarTaSatu::class, 'id_mahasiswa');
    }
    public function ta_dua()
    {
        return $this->hasOne(ModelSeminarTaDua::class, 'id_mahasiswa');
    }
    public function komprehensif()
    {
        return $this->hasOne(ModelSeminarKompre::class, 'id_mahasiswa');
    }
    public function taSatuS2()
    {
        return $this->hasOne(ModelSeminarTaSatuS2::class, 'id_mahasiswa');
    }
    public function taDuaS2()
    {
        return $this->hasOne(ModelSeminarTaDuaS2::class, 'id_mahasiswa');
    }
    public function komprehensifS2()
    {
        return $this->hasOne(ModelKompreS2::class, 'id_mahasiswa');
    }
    public function aktivitasAlumni()
    {
        return $this->hasMany(AktivitasAlumni::class, 'mahasiswa_id');
    }
    public function kegiatanTerakhir()
    {
        return $this->hasOne(AktivitasAlumni::class, 'mahasiswa_id')->latest('tahun_masuk')
            ->withDefault([
                'id' => '-',
                'tempat' => '-',
                'alamat' => '-',
                'jabatan' => '-',
                'tahun_masuk' => date('Y:m:d'),
                'hubungan' => '-',
                'gaji' => '-',
                'status' => '-'
            ]);
    }
    public function pendataanAlumni()
    {
        return $this->hasOne(ModelPendataanAlumni::class, 'mahasiswa_id');
    }

    public function asisten_lab()
    {
        return $this->hasManyThrough(
            Laboratorium::class,
            AsistenLab::class,
            'id_mahasiswa',
            'id',
            'id',
            'id_actity_lab'
        );
    }
    public function assistenLabDateBeetwen($start, $end)
    {
        return $this->hasManyThrough(
            Laboratorium::class,
            AsistenLab::class,
            'id_mahasiswa',
            'id',
            'id',
            'id_actity_lab'
        )->whereBetween('tanggal_kegiatan', [$start, $end])->get();
    }
}
