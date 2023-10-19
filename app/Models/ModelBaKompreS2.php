<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBaKompreS2 extends Model
{
    use HasFactory;
    protected $table = 'ba_s2_kompre';
    protected $fillable = [
        'encrypt_id', 
        'no_ba',
        'nilai',
        'nilai_mutu',
        'pengesahan',
        'file_ba',
        'file_nilai',
        'id_seminar',
        'created_at',
        'updated_at'
    ];
    public function seminar(){
        return $this->belongsTo(ModelKompreS2::class, 'id_seminar');
    }
}
