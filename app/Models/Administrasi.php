<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;
    protected $table = 'administrasi';
    protected $fillable = [
        'nip',
        'encrypt_id',
        'nama_administrasi',
        'no_hp',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat',
        'jenis_kelamin',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function historyPangkatAdmin()
    {
        return $this->hasMany(HistoryPangkatAdmin::class, 'administrasi_id');
    }
}
