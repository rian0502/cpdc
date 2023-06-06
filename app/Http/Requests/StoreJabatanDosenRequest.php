<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreJabatanDosenRequest extends FormRequest
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
            'jaban' => ['required','string','in:"' . implode('","', $jaban) . '"'],
            'tanggal_sk_jabatan' => ['required','date'],
            'file_sk_jabatan' => ['required','file','mimes:pdf','max:2048'],
        ];
    }
    public function messages()
    {
        return [
            'jaban.required' => 'Jabatan tidak boleh kosong',
            'jaban.string' => 'Jabatan harus berupa string',
            'jaban.in' => 'Jabatan tidak valid',
            'tanggal_sk_jabatan.required' => 'Tanggal SK Jabatan tidak boleh kosong',
            'tanggal_sk_jabatan.date' => 'Tanggal SK Jabatan tidak valid',
            'file_sk_jabatan.required' => 'File SK Jabatan tidak boleh kosong',
            'file_sk_jabatan.file' => 'File SK Jabatan tidak valid',
            'file_sk_jabatan.mimes' => 'File SK Jabatan harus berupa PDF',
            'file_sk_jabatan.max' => 'File SK Jabatan maksimal 2MB',
        ];
    }
}
