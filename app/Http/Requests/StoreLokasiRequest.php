<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreLokasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('jurusan');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_lokasi' => 'required|max:100',
            'nama_gedung' => 'required|max:100',
            'lantai_tingkat' => 'required|numeric|max:100',
        ];
    }
    public function messages()
    {
        return [
            'nama_lokasi.required' => 'Nama Lokasi harus diisi',
            'nama_lokasi.max' => 'Nama Lokasi maksimal 100 karakter',
            'nama_gedung.required' => 'Nama Gedung harus diisi',
            'nama_gedung.max' => 'Nama Gedung maksimal 100 karakter',
            'lantai_tingkat.required' => 'Lantai/Tingkat harus diisi',
            'lantai_tingkat.max' => 'Lantai/Tingkat maksimal 100 karakter',
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
