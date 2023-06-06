<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreSopLabRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('admin lab');;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_sop' => 'required|string|max:255|min:3',
            'id_lokasi' => 'required|exists:lokasi,encrypt_id',
            'file_sop' => 'required|file|mimes:pdf|max:1060',
        ];
    }
    public function messages()
    {
        return [
            'id_lokasi.required' => 'Lokasi harus diisi',
            'id_lokasi.exists' => 'Lokasi tidak ditemukan',
            'file_sop.required' => 'File SOP harus diupload',
            'file_sop.file' => 'File SOP harus berupa file',
            'file_sop.mimes' => 'File SOP harus berupa file PDF',
            'file_sop.max' => 'File SOP maksimal 1MB',
            'nama_sop.required' => 'Nama SOP harus diisi',
            'nama_sop.string' => 'Nama SOP harus berupa string',
            'nama_sop.max' => 'Nama SOP maksimal 255 karakter',
            'nama_sop.min' => 'Nama SOP minimal 3 karakter',
        ];
    }
}
