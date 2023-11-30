<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMahasiswaBaKpRequest extends FormRequest
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
            'nilai_lapangan' => 'required|numeric|min:0|max:100',
            'nilai_akd' => 'required|numeric|min:0|max:100',
            'nilai_akhir' => 'required|numeric|min:0|max:100',
            'nilai_mutu' => 'required|string',
            'berkas_ba_seminar_kp' => 'required|mimes:pdf|max:2048',
            'laporan_kp' => 'required|mimes:pdf|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'nilai_lapangan.required' => 'Nilai Pembimbing Lapangan tidak boleh kosong',
            'nilai_lapangan.numeric' => 'Nilai Pembimbing Lapangan harus berupa angka',
            'nilai_lapangan.min' => 'Nilai Pembimbing Lapangan minimal 0',
            'nilai_lapangan.max' => 'Nilai Pembimbing Lapangan maksimal 100',
            'nilai_akd.required' => 'Nilai Dosen Pembimbing tidak boleh kosong',
            'nilai_akd.numeric' => 'Nilai Dosen Pembimbing harus berupa angka',
            'nilai_akd.min' => 'Nilai Dosen Pembimbing minimal 0',
            'nilai_akd.max' => 'Nilai Dosen Pembimbing maksimal 100',
            'nilai_akhir.required' => 'Nilai Akhir tidak boleh kosong',
            'nilai_akhir.numeric' => 'Nilai Akhir harus berupa angka',
            'nilai_akhir.min' => 'Nilai Akhir minimal 0',
            'nilai_akhir.max' => 'Nilai Akhir maksimal 100',
            'nilai_mutu.required' => 'Nilai Mutu tidak boleh kosong',
            'nilai_mutu.string' => 'Nilai Mutu harus berupa Huruf',
            'laporan_kp.required' => 'Laporan KP tidak boleh kosong',
            'laporan_kp.mimes' => 'Laporan KP harus berupa file pdf',
            'laporan_kp.max' => 'Laporan KP maksimal 1MB',
            'berkas_ba_seminar_kp.required' => 'Berkas Berita Acara Seminar KP tidak boleh kosong',
            'berkas_ba_seminar_kp.mimes' => 'Berkas Berita Acara Seminar KP harus berupa file pdf',
            'berkas_ba_seminar_kp.max' => 'Berkas Berita Acara Seminar KP maksimal MB',
        ];
    }
}
