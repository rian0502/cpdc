<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseNPM extends Model
{
    use HasFactory;
    protected $table = 'base_npm';
    protected $fillable = [
        'npm',
        'status',
        'created_at',
        'updated_at'
    ];
}
