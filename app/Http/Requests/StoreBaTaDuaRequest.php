<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBaTaDuaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(['mahasiswa']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_berkas_ba_seminar_ta_dua' => 'required|string|max:255',
            'berkas_ba_seminar_ta_dua' => 'required|mimes:pdf|max:1048',
            'berkas_nilai_seminar_ta_dua' => 'required|mimes:pdf|max:1048',
            'berkas_ppt_seminar_ta_dua' => 'required|url',
            'nilai' => 'required|numeric|min:0|max:100',
            'huruf_mutu' => ['required', 'string'],
            'tgl_realisasi_seminar' => 'required|date',
        ];
    }
    public function messages()
    {
        return [
            'no_berkas_ba_seminar_ta_dua.required' => 'Nomor Berkas Berita Acara Seminar TA 2 tidak boleh kosong',
            'no_berkas_ba_seminar_ta_dua.string' => 'Nomor Berkas Berita Acara Seminar TA 2 harus berupa karakter',
            'no_berkas_ba_seminar_ta_dua.max' => 'Nomor Berkas Berita Acara Seminar TA 2 maksimal 255 karakter',
            'berkas_ba_seminar_ta_dua.required' => 'Berkas Berita Acara Seminar TA 2 tidak boleh kosong',
            'berkas_ba_seminar_ta_dua.mimes' => 'Berkas Berita Acara Seminar TA 2 harus berupa file pdf',
            'berkas_ba_seminar_ta_dua.max' => 'Berkas Berita Acara Seminar TA 2 maksimal 1MB',
            'berkas_ppt_seminar_ta_dua.required' => 'Berkas PPT Seminar TA 2 tidak boleh kosong',
            'berkas_ppt_seminar_ta_dua.url' => 'Berkas PPT Seminar TA 2 harus berupa URL',
            'nilai.required' => 'Nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai harus berupa angka',
            'nilai.min' => 'Nilai minimal 0',
            'nilai.max' => 'Nilai maksimal 100',
            'huruf_mutu.required' => 'Nilai Mutu tidak boleh kosong',
            'huruf_mutu.string' => 'Nilai Mutu harus berupa huruf',
            'berkas_nilai_seminar_ta_dua.required' => 'Berkas Nilai Seminar TA 2 tidak boleh kosong',
            'berkas_nilai_seminar_ta_dua.mimes' => 'Berkas Nilai Seminar TA 2 harus berupa file pdf',
            'berkas_nilai_seminar_ta_dua.max' => 'Berkas Nilai Seminar TA 2 maksimal 1MB',
            'tgl_realisasi_seminar.required' => 'Tanggal Realisasi Seminar TA 2 tidak boleh kosong',
            'tgl_realisasi_seminar.date' => 'Tanggal Realisasi Seminar TA 2 harus berupa tanggal',
        ];
    }
}
