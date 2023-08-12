<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBaSidangTesisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('mahasiswaS2');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nilai' => ['required', 'numeric', 'min:0', 'max:100'],
            'no_ba' => ['required', 'string', 'max:255'],
            'nilai_mutu' => ['required', 'string', 'max:3'],
            'pengesahan' => ['required', 'url'],
            'file_ba' => ['nullable', 'file', 'max:1048', 'mimes:pdf'],
            'file_nilai' => ['nullable', 'file', 'max:1048', 'mimes:pdf'],
        ];
    }
    public function messages()
    {
        return [
            'nilai.required' => 'Nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai harus berupa angka',
            'nilai.min' => 'Nilai minimal 0',
            'nilai.max' => 'Nilai maksimal 100',
            'no_ba.required' => 'Nomor BA tidak boleh kosong',
            'no_ba.string' => 'Nomor BA harus berupa string',
            'no_ba.max' => 'Nomor BA maksimal 255 karakter',
            'nilai_mutu.required' => 'Nilai Mutu tidak boleh kosong',
            'nilai_mutu.string' => 'Nilai Mutu harus berupa string',
            'nilai_mutu.max' => 'Nilai Mutu maksimal 3 karakter',
            'pengesahan.required' => 'Pengesahan tidak boleh kosong',
            'pengesahan.url' => 'Pengesahan harus berupa url',
            'file_ba.file' => 'File BA harus berupa file',
            'file_ba.max' => 'File BA maksimal 1MB',
            'file_ba.mimes' => 'File BA harus berupa pdf',
            'file_nilai.file' => 'File Nilai harus berupa file',
            'file_nilai.max' => 'File Nilai maksimal 1MB',
            'file_nilai.mimes' => 'File Nilai harus berupa pdf'
        ];
    }
}
