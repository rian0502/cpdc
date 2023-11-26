<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelFailedJobs extends Model
{
    use HasFactory;
    protected $table = 'failed_jobs';
    protected $id = 'id';

    protected $fillable = [
        'id',
        'uuid',
        'connection',
        'queue',
        'payload',
        'exception',
        'failed_at'
    ];
}
