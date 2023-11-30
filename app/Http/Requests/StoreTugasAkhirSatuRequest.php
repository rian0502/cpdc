<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTugasAkhirSatuRequest extends FormRequest
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
        $data = ['Ganjil', 'Genap'];
        $sumber = ['Dosen', 'Mahasiswa'];

        return [
            'semester' => 'required|in:' . implode(',', $data),
            'sks' => 'required|numeric',
            'ipk' => 'required|numeric|min:0|max:4',
            'id_pembimbing_satu' => 'required|exists:dosen,encrypt_id',
            'pembahas' => 'required|exists:dosen,encrypt_id',
            'periode_seminar' => 'required|string',
            'toefl' => 'required|numeric|min:0|max:677',
            'judul_ta' => 'required|string|max:255|min:5',
            'agreement' => 'required',
            'berkas_seminar_ta_satu' => 'required|mimes:pdf|max:1048',
            'sumber_penelitian' => 'required|in:' . implode(',', $sumber),
        ];
    }
    public function messages()
    {
        return [
            'id_pembimbing_satu.required' => 'Dosen Pembimbing 1 Harus dipilih',
            'id_pembimbing_satu.exists' => 'Dosen Pembimbing 1 tidak ditemukan',
            'pembahas.required' => 'Dosen Pembahas Harus dipilih',
            'pembahas.exists' => 'Dosen Pembahas tidak ditemukan',
            'periode_seminar.required' => 'Periode Seminar Harus dipilih',
            'periode_seminar.string' => 'Periode Seminar harus berupa string',
            'toefl.required' => 'Nilai TOEFL Harus diisi',
            'toefl.numeric' => 'Nilai TOEFL harus berupa angka',
            'toefl.min' => 'Nilai TOEFL minimal 0',
            'toefl.max' => 'Nilai TOEFL maksimal 677',
            'judul_ta.required' => 'Judul Tugas Akhir Harus diisi',
            'judul_ta.string' => 'Judul Tugas Akhir harus berupa string',
            'judul_ta.max' => 'Judul Tugas Akhir maksimal 255 karakter',
            'judul_ta.min' => 'Judul Tugas Akhir minimal 5 karakter',
            'agreement.required' => 'Agreement Harus diisi',
            'berkas_seminar_ta_satu.required' => 'Berkas Seminar Harus diisi',
            'berkas_seminar_ta_satu.mimes' => 'Berkas Seminar harus berupa file pdf',
            'berkas_seminar_ta_satu.max' => 'Berkas Seminar maksimal 1MB',
            'ipk.required' => 'IPK Harus diisi',
            'ipk.numeric' => 'IPK harus berupa angka',
            'ipk.min' => 'IPK minimal 0',
            'ipk.max' => 'IPK maksimal 4',
            'sks.required' => 'SKS Harus diisi',
            'sks.numeric' => 'SKS harus berupa angka',
            'semester.required' => 'Semester Harus diisi',
            'semester.in' => 'Semester harus berupa Ganjil atau Genap',
            'sumber_penelitian.required' => 'Sumber Penelitian Harus diisi',
            'sumber_penelitian.in' => 'Sumber Penelitian harus berupa Dosen atau Mahasiswa',

        ];
    }
}
