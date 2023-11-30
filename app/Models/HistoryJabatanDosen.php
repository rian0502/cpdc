<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryJabatanDosen extends Model
{
    use HasFactory;
    protected $table = 'history_jabatan_dosen';
    protected $fillable = [
        'encrypted_id',
        'jabatan',
        'tgl_sk',
        'file_sk',
        'dosen_id'
    ];
    
    public function dosen(){
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
}
