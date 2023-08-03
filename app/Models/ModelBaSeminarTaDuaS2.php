<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBaSeminarTaDuaS2 extends Model
{
    use HasFactory;
    protected $table = 'ba_s2_seminar_ta2';
    protected $fillable = [
        'encrypt_id',
        'no_ba',
        'nilai',
        'nilai_mutu',
        'ppt',
        'file_ba',
        'file_nilai',
        'id_seminar',
        'created_at',
        'updated_at'
    ];
    public function seminar()
    {
        return $this->belongsTo(ModelSeminarTaDuaS2::class, 'id_seminar');
    }
}
