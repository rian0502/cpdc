<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBaTaSatuRequest extends FormRequest
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
            'nilai' => 'required|numeric|min:0|max:100',
            'no_berkas_ba_seminar_ta_satu' => 'required|string|max:255',
            'nilai_mutu' => ['required', 'string'],
            'berkas_ppt_seminar_ta_satu' => 'required|url',
            'berkas_ba_seminar_ta_satu' => 'nullable|mimes:pdf|max:2048',
            'berkas_nilai_seminar_ta_satu' => 'nullable|mimes:pdf|max:2048',
            'tgl_realisasi_seminar' => 'required|date',
        ];
    }
    public function messages()
    {
        return [
            'nilai.required' => 'Nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai harus berupa angka',
            'nilai.min' => 'Nilai minimal 0',
            'nilai.max' => 'Nilai maksimal 100',
            'no_berkas_ba_seminar_ta_satu.required' => 'Nomor Berkas Berita Acara Seminar TA 1 tidak boleh kosong',
            'no_berkas_ba_seminar_ta_satu.string' => 'Nomor Berkas Berita Acara Seminar TA 1 harus berupa karakter',
            'no_berkas_ba_seminar_ta_satu.max' => 'Nomor Berkas Berita Acara Seminar TA 1 maksimal 255 karakter',
            'nilai_mutu.required' => 'Nilai Mutu tidak boleh kosong',
            'nilai_mutu.string' => 'Nilai Mutu harus berupa huruf',
            'berkas_ppt_seminar_ta_satu.required' => 'Berkas PPT Seminar TA 1 tidak boleh kosong',
            'berkas_ppt_seminar_ta_satu.url' => 'Berkas PPT Seminar TA 1 harus berupa URL',
            'berkas_ba_seminar_ta_satu.mimes' => 'Berkas Berita Acara Seminar TA 1 harus berupa file pdf',
            'berkas_ba_seminar_ta_satu.max' => 'Berkas Berita Acara Seminar TA 1 maksimal 1MB',
            'berkas_nilai_seminar_ta_satu.mimes' => 'Berkas Nilai Seminar TA 1 harus berupa file pdf',
            'berkas_nilai_seminar_ta_satu.max' => 'Berkas Nilai Seminar TA 1 maksimal 1MB',
            
        ];
    }
}
