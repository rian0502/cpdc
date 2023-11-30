<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreGelar extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('dosen');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'instansi_pendidikan' => 'required|string|max:255|min:1',
            'jurusan' => 'required|string|max:255|min:1',
            'tahun_lulus' => 'required|numeric|min:4',
            'nama_gelar' => 'required|string|max:255|min:1',
            'singkatan_gelar' => 'required|string|max:255|min:1',

        ];
    }

    public function messages()
    {
        return [
            'instansi_pendidikan.required' => 'Instansi Pendidikan tidak boleh kosong',
            'instansi_pendidikan.string' => 'Instansi Pendidikan harus berupa huruf',
            'instansi_pendidikan.max' => 'Instansi Pendidikan maksimal 255 karakter',
            'instansi_pendidikan.min' => 'Instansi Pendidikan minimal 1 karakter',
            'jurusan.required' => 'Jurusan tidak boleh kosong',
            'jurusan.string' => 'Jurusan harus berupa huruf',
            'jurusan.max' => 'Jurusan maksimal 255 karakter',
            'jurusan.min' => 'Jurusan minimal 1 karakter',
            'tahun_lulus.required' => 'Tahun Lulus tidak boleh kosong',
            'tahun_lulus.numeric' => 'Tahun Lulus harus berupa angka',
            'tahun_lulus.min' => 'Tahun Lulus minimal 4 karakter',
            'nama_gelar.required' => 'Nama Gelar tidak boleh kosong',
            'nama_gelar.string' => 'Nama Gelar harus berupa huruf',
            'nama_gelar.max' => 'Nama Gelar maksimal 255 karakter',
            'nama_gelar.min' => 'Nama Gelar minimal 1 karakter',
            'singkatan_gelar.required' => 'Singkatan Gelar tidak boleh kosong',
            'singkatan_gelar.string' => 'Singkatan Gelar harus berupa huruf',
            'singkatan_gelar.max' => 'Singkatan Gelar maksimal 255 karakter',
            'singkatan_gelar.min' => 'Singkatan Gelar minimal 1 karakter',
        ];


    }

    protected function prepareForValidation()
    {
        $input = $this->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = strip_tags($value);
            }
        }
        $this->replace($input);
    }
}
