<?php

namespace App\Models;

use App\Models\ModelSeminarKP;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaSKP extends Model
{
    use HasFactory;
    protected $table = 'ba_seminar_kp';
    protected $fillable = [
        'encrypt_id',
        'no_ba_seminar_kp',
        'nilai_lapangan',
        'nilai_akd',
        'nilai_akhir',
        'nilai_mutu',
        'berkas_ba_seminar_kp',
        'laporan_kp',
        'id_seminar',
        'created_at',
        'updated_at'
    ];

    public function seminar()
    {
        return $this->belongsTo(ModelSeminarKP::class, 'id_seminar');
    }
}
