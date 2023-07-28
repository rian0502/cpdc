<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSeminarDosenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(['dosen']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => ['string', 'required', 'min:3', 'max:255'],
            'tahun' => ['required', 'date'],
            'scala' => ['required', 'string', 'in:Nasional,Internasional,Provinsi,Kabupaten/Kota,Universitas'],
            'uraian' => ['required', 'string', 'min:3', 'max:1255'],
            'url' => ['required', 'url', 'min:3', 'max:255'],
        ];
    }
    public function messages()
    {
        return [
            'nama.required' => 'Nama seminar harus diisi',
            'nama.min' => 'Nama seminar minimal 3 karakter',
            'nama.max' => 'Nama seminar maksimal 255 karakter',
            'tahun.required' => 'Tahun seminar harus diisi',
            'tahun.date' => 'Tahun seminar harus berupa tanggal',
            'scala.required' => 'Scala seminar harus diisi',
            'scala.in' => 'Scala seminar harus salah satu dari: Nasional,Internasional,Provinsi,Kabupaten/Kota,Universitas',
            'uraian.required' => 'Uraian seminar harus diisi',
            'uraian.min' => 'Uraian seminar minimal 3 karakter',
            'uraian.max' => 'Uraian seminar maksimal 1255 karakter',    
            'url.required' => 'URL seminar harus diisi',
        ];
    }
}
