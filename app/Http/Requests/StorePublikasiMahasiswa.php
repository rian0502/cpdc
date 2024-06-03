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
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul harus diisi.',
            'judul.max' => 'Judul tidak boleh lebih dari :max karakter.',
            'nama_publikasi.required' => 'Nama publikasi harus diisi.',
            'nama_publikasi.max' => 'Nama publikasi tidak boleh lebih dari :max karakter.',
            'vol.max' => 'Volume tidak boleh lebih dari :max karakter.',
            'halaman.max' => 'Halaman tidak boleh lebih dari :max karakter.',
            'tahun.required' => 'Tahun harus diisi.',
            'tahun.date_format' => 'Format tahun tidak valid. Gunakan format tahun YYYY.',
            'url.required' => 'URL harus diisi.',
            'url.url' => 'URL tidak valid.',
            'scala.required' => 'Skala harus dipilih.',
            'scala.in' => 'Skala harus Nasional atau Internasional.',
        ];
    }

}
