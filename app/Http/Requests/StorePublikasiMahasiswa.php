<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePublikasiMahasiswa extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole([
            'mahasiswa',
            'mahasiswaS2',
            'alumni', 
            'alumniS2'
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul' => [
                'required',
                'string',
                'max:255'
            ],
            'nama_publikasi' => [
                'required',
                'string',
                'max:255'
            ],
            'vol' => [
                'nullable',
                'string',
                'max:255'
            ],
            'halaman' => [
                'nullable',
                'string',
                'max:255'
            ],
            'tahun' => [
                'required',
                'date_format:Y'
            ],
            'url' => [
                'required',
                'url',
            ],
            'scala' => [
                'required',
                'in:Nasional,Internasional'
            ],
            'anggota' => [
                'required',
                'min:1'
            ],
        ];
    }
}
