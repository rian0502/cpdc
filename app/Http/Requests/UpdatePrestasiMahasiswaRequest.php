<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePrestasiMahasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('mahasiswa');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $capaian = ['Juara 1', 'Juara 2', 'Juara 3', 'Harapan 1', 'Harapan 2', 'Harapan 3', 'Peserta'];
        $scala = ['Nasional', 'Internasional', 'Provinsi', 'Kabupaten/Kota', 'Universitas'];
        return [
            'nama_prestasi' => 'required|string|max:255',
            'scala' => 'required|in:' . implode(',', $scala),
            'capaian' => 'required|in:' . implode(',', $capaian),
            'tanggal' => 'required|date',
            'file_prestasi' => 'nullable|mimes:pdf|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'nama_prestasi.required' => 'Nama Prestasi tidak boleh kosong',
            'nama_prestasi.string' => 'Nama Prestasi harus berupa huruf',
            'nama_prestasi.max' => 'Nama Prestasi maksimal 255 karakter',
            'scala.required' => 'Scala tidak boleh kosong',
            'scala.in' => 'Scala harus salah satu dari: Nasional, Internasional, Provinsi, Kabupaten/Kota, Universitas',
            'capaian.required' => 'Capaian tidak boleh kosong',
            'capaian.in' => 'Capaian harus salah satu dari: Juara 1, Juara 2, Juara 3, Harapan 1, Harapan 2, Harapan 3, Peserta',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal harus berupa tanggal',
            'file_prestasi.mimes' => 'File Prestasi harus berupa file pdf',
            'file_prestasi.max' => 'File Prestasi maksimal 1MB',
        ];
    }
}
