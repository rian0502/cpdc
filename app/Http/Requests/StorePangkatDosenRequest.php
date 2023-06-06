<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePangkatDosenRequest extends FormRequest
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
        $pangkat = [
            'III A',
            'III B',
            'III C',
            'IV A',
            'IV B',
            'IV C',
            'IV D',
            'IV E',
        ];
        return [
            'kepangkatan' => 'required|string|in:' . implode(',', $pangkat),
            'tanggal_sk' => 'required|date',
            'file_sk' => 'required|file|mimes:pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'kepangkatan.required' => 'Kepangkatan tidak boleh kosong',
            'kepangkatan.string' => 'Kepangkatan harus berupa string',
            'kepangkatan.in' => 'Kepangkatan tidak valid',
            'tanggal_sk.required' => 'Tanggal SK tidak boleh kosong',
            'tanggal_sk.date' => 'Tanggal SK tidak valid',
            'file_sk.required' => 'File SK tidak boleh kosong',
            'file_sk.file' => 'File SK tidak valid',
            'file_sk.mimes' => 'File SK harus berupa PDF',
            'file_sk.max' => 'File SK maksimal 2MB',
        ];
    }
}
