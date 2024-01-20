<?php

namespace App\Models;

use App\Models\Dosen;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\ValidationException; //
class ModelKinerjaDosen extends Model
{
    use HasFactory;
    protected $table = 'kinerja_dosen';
    protected $fillable =  [
        'encrypted_id',
        'semester',
        'tahun_akademik',
        'sks_pendidikan',
        'sks_penelitian',
        'sks_pengabdian',
        'sks_penunjang',
        'dosen_id',
        'created_at',
        'updated_at'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->validateUnique();
        });
    }

    public function validateUnique()
    {
        try {
            $validator = Validator::make(
                ['tahun_akademik' => $this->tahun_akademik],
                [
                    'tahun_akademik' => [
                        'required',
                        Rule::unique('kinerja_dosen')
                            ->where('semester', $this->semester)
                            ->where('dosen_id', $this->dosen_id)
                    ]
                ]
            );

            if ($validator->fails()) {
                return true;
            }
        } catch (ValidationException $e) {
            // Catch the validation exception and handle it
            return true;
        }
    }
}
