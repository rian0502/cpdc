<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBaKompre extends FormRequest
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
        return [
            'no_ba_berkas' => 'required|string|max:255',
            'ba_seminar_komprehensif' => 'required|file|mimes:pdf|max:1048',
            'berkas_nilai_kompre' => 'required|file|mimes:pdf|max:1048',
            'laporan_ta' => 'required|url',
            'nilai' => 'required|numeric|min:0|max:100',
            'huruf_mutu' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'no_ba_berkas.required' => 'No BA Berkas harus diisi',
            'no_ba_berkas.string' => 'No BA Berkas harus berupa string',
            'no_ba_berkas.max' => 'No BA Berkas maksimal 255 karakter',
            'ba_seminar_komprehensif.required' => 'Berkas BA Seminar Komprehensif harus diisi',
            'ba_seminar_komprehensif.file' => 'Berkas BA Seminar Komprehensif harus berupa file',
            'ba_seminar_komprehensif.mimes' => 'Berkas BA Seminar Komprehensif harus berupa file pdf',
            'ba_seminar_komprehensif.max' => 'Berkas BA Seminar Komprehensif maksimal 1MB',
            'berkas_nilai_kompre.required' => 'Berkas Nilai Komprehensif harus diisi',
            'berkas_nilai_kompre.file' => 'Berkas Nilai Komprehensif harus berupa file',
            'berkas_nilai_kompre.mimes' => 'Berkas Nilai Komprehensif harus berupa file pdf',
            'berkas_nilai_kompre.max' => 'Berkas Nilai Komprehensif maksimal 1MB',
            'laporan_ta.required' => 'Laporan TA harus diisi',
            'laporan_ta.url' => 'Laporan TA harus berupa url',
            'nilai.required' => 'Nilai harus diisi',
            'nilai.numeric' => 'Nilai harus berupa angka',
            'nilai.min' => 'Nilai minimal 0',
            'nilai.max' => 'Nilai maksimal 100',
            'huruf_mutu.required' => 'Huruf Mutu harus diisi',
            'huruf_mutu.string' => 'Huruf Mutu harus berupa string',
            'huruf_mutu.max' => 'Huruf Mutu maksimal 255 karakter',
        ];
    }
}
