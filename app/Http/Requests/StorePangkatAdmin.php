<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StorePangkatAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(["admin lab", "admin berkas"]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $pangkat = ['I A', 'I B', 'I C', 'I D', 'II A', 'II B', 'II C', 'II D', 'III A', 'III B', 'III C', 'III D', 'IV A', 'IV B', 'IV C', 'IV d', 'IV E'];
        return [
            'kepangkatan' => ['required', 'string', 'in:' . implode(',', $pangkat)],
            'tanggal_sk' => ['required', 'date'],
            'file_sk' => ['required', 'file', 'mimes:pdf', 'max:1048'],
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
            'file_sk.max' => 'File SK maksimal 1MB',
        ];
    }
}
