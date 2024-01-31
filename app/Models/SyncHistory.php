<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncHistory extends Model
{
    use HasFactory;
    protected $table = 'sync_histories';
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
    ];

}
