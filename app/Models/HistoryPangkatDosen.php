<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPangkatDosen extends Model
{
    use HasFactory;
    protected $table = 'history_kepangkatan_dosen';
    protected  $fillable = [
        'encrypted_id',
        'kepangkatan',
        'tgl_sk',
        'file_sk',
        'dosen_id'
    ];
    public function dosen(){
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
}
