<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePenghargaanDosenRequest extends FormRequest
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
            'nama.required' => 'Nama penghargaan harus diisi',
            'nama.string' => 'Nama penghargaan harus berupa Huruf',
            'nama.min' => 'Nama penghargaan minimal 3 karakter',
            'nama.max' => 'Nama penghargaan maksimal 255 karakter',
            'tahun.required' => 'Tahun penghargaan harus diisi',
            'tahun.date' => 'Tahun penghargaan harus berupa tanggal',
            'scala.required' => 'Scala penghargaan harus diisi',
            'scala.in' => 'Scala penghargaan harus salah satu dari: Nasional,Internasional,Provinsi,Kabupaten/Kota,Universitas',
            'uraian.required' => 'Uraian penghargaan harus diisi',
            'uraian.min' => 'Uraian penghargaan minimal 3 karakter',
            'uraian.max' => 'Uraian penghargaan maksimal 1255 karakter',
            'url.required' => 'URL penghargaan harus diisi',
            'url.url' => 'URL penghargaan harus berupa URL',
            'url.min' => 'URL penghargaan minimal 3 karakter',
            'url.max' => 'URL penghargaan maksimal 255 karakter',
        ];
    }
}
