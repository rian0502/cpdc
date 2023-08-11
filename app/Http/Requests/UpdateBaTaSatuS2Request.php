<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBaTaSatuS2Request extends FormRequest
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
            'no_ba' => ['required', 'string', 'min:5'],
            'nilai_mutu' => ['required', 'string', 'min:1', 'max:2'],
            'ppt' => ['required', 'url'],
            'file_nilai' => ['nullable', 'file', 'mimes:pdf', 'max:1024'],
            'file_ba' => ['nullable', 'file', 'mimes:pdf', 'max:1024'],
        ];
    }
    public function messages()
    {
        return [
            'nilai.required' => 'Nilai harus diisi',
            'nilai.numeric' => 'Nilai harus berupa angka',
            'nilai.min' => 'Nilai minimal 0',
            'nilai.max' => 'Nilai maksimal 100',
            'no_ba.required' => 'Nomor BA harus diisi',
            'no_ba.string' => 'Nomor BA harus berupa string',
            'no_ba.min' => 'Nomor BA minimal 5 karakter',
            'nilai_mutu.required' => 'Nilai mutu harus diisi',
            'nilai_mutu.string' => 'Nilai mutu harus berupa string',
            'nilai_mutu.min' => 'Nilai mutu minimal 1 karakter',
            'nilai_mutu.max' => 'Nilai mutu maksimal 2 karakter',
            'ppt.required' => 'Link PPT harus diisi',
            'ppt.url' => 'Link PPT harus berupa URL',
            'file_nilai.file' => 'File nilai harus berupa file',
            'file_nilai.mimes' => 'File nilai harus berupa PDF',
            'file_nilai.max' => 'File nilai maksimal 1 MB',
            'file_ba.file' => 'File BA harus berupa file',
            'file_ba.mimes' => 'File BA harus berupa PDF',
            'file_ba.max' => 'File BA maksimal 1 MB',
        ];
    }
}
