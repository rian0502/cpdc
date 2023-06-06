<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateJabatanDosenRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $jaban = ['Tenaga Pengajar', 'Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar'];
        return [
            'jabatan' => 'required|string|in:"' . implode('","', $jaban) . '"',
            'tanggal_sk' => 'required|date:Y-m-d',
            'file_sk' => 'required|file|mimes:pdf|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'jabatan.string' => 'Jabatan harus berupa string',
            'jabatan.in' => 'Jabatan tidak valid',
            'tanggal_sk.required' => 'Tanggal SK Jabatan tidak boleh kosong',
            'tanggal_sk.date' => 'Tanggal SK Jabatan tidak valid',
            'file_sk.required' => 'File SK Jabatan tidak boleh kosong',
            'file_sk.file' => 'File SK Jabatan tidak valid',
            'file_sk.mimes' => 'File SK Jabatan harus berupa PDF',
            'file_sk.max' => 'File SK Jabatan maksimal 2MB',
        ];
    }
}
