<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBaSeminarTaSatu extends Model
{
    use HasFactory;

    protected $table = 'ba_seminar_ta_satu';
    protected $fillable = [
        'encrypt_id',
        'no_berkas_ba_seminar_ta_satu',
        'berkas_ba_seminar_ta_satu',
        'berkas_nilai_seminar_ta_satu',
        'berkas_ppt_seminar_ta_satu',
        'nilai',
        'huruf_mutu',
        'id_seminar'
    ];

    public function seminar_ta_satu()
    {
        return $this->belongsTo(ModelSeminarTaSatu::class, 'id_seminar');
    }
    public function seminar(){
        return $this->belongsTo(ModelSeminarTaSatu::class, 'id_seminar');
    }
}
