<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBaSeminarTaDua extends Model
{
    use HasFactory;
    protected $table = 'ba_seminar_ta_dua';
    protected $fillable = [
        'encrypt_id',
        'no_berkas_ba_seminar_ta_dua',
        'berkas_ba_seminar_ta_dua',
        'berkas_nilai_seminar_ta_dua',
        'berkas_ppt_seminar_ta_dua',
        'nilai',
        'huruf_mutu',
        'id_seminar',
        'created_at',
        'updated_at'
    ];

    public function seminar()
    {
        return $this->belongsTo(ModelSeminarTaDua::class, 'id_seminar');
    }
}
