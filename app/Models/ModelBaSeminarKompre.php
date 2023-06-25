<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBaSeminarKompre extends Model
{
    use HasFactory;
    protected $table = 'ba_seminar_komprehensif';
    protected $fillable = [
        'encrypt_id',
        'ba_seminar_komprehensif',
        'no_ba_berkas',
        'berkas_nilai_kompre',
        'laporan_ta',
        'nilai',
        'huruf_mutu',
    ];

    public function seminar()
    {
        return $this->belongsTo(ModelSeminarKompre::class, 'id_seminar');
    }
}
