<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateBeritaAcara extends Model
{
    use HasFactory;
    protected $table = 'template_berita_acara';
    protected $fillable = ['nama', 'path'];
}
