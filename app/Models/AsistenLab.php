<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenLab extends Model
{
    use HasFactory;
    protected $table = 'asisten_lab';
    protected $fillable = [
        'id_actity_lab',
        'id_mahasiswa'
    ];
    public function aktivitas(){
        return $this->belongsTo(ActivityLab::class, 'id_actity_lab', 'id');
    }
    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }
}
