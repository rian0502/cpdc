<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSidangKompreRequest extends FormRequest
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
        return [
            'semester' => 'required|in:'.implode(',', $data),
            'sks' => 'required|numeric',
            'ipk' => 'required|numeric|min:0|max:4',
            'id_pembimbing_satu' => 'required|exists:dosen,encrypt_id',
            'pembahas' => 'required|exists:dosen,encrypt_id',
            'periode_seminar' => 'required|string',
            'toefl' => 'required|numeric|min:0|max:677',
            'judul_ta' => 'required|string|max:255|min:5',
            'agreement' => 'required',
            'berkas_kompre' => 'nullable|mimes:pdf|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'semester.required' => 'Semester Harus dipilih',
            'semester.in' => 'Semester harus berupa Ganjil atau Genap',
            'sks.required' => 'SKS Harus diisi',
            'sks.numeric' => 'SKS harus berupa angka',
            'ipk.required' => 'IPK Harus diisi',
            'ipk.numeric' => 'IPK harus berupa angka',
            'ipk.min' => 'IPK minimal 0',
            'ipk.max' => 'IPK maksimal 4',
            'id_pembimbing_satu.required' => 'Dosen Pembimbing 1 Harus dipilih',
            'id_pembimbing_satu.exists' => 'Dosen Pembimbing 1 tidak ditemukan',
            'pembahas.required' => 'Dosen Pembahas Harus dipilih',
            'pembahas.exists' => 'Dosen Pembahas tidak ditemukan',
            'periode_seminar.required' => 'Periode Seminar Harus dipilih',
            'periode_seminar.string' => 'Periode Seminar harus sesuai pilihan',
            'toefl.required' => 'Nilai TOEFL Harus diisi',
            'toefl.numeric' => 'Nilai TOEFL harus berupa angka',
            'toefl.min' => 'Nilai TOEFL minimal 0',
            'toefl.max' => 'Nilai TOEFL maksimal 677',
            'judul_ta.required' => 'Judul TA Harus diisi',
            'judul_ta.string' => 'Judul TA harus berupa string',
            'judul_ta.max' => 'Judul TA maksimal 255 karakter',
            'judul_ta.min' => 'Judul TA minimal 5 karakter',
            'agreement.required' => 'Agreement harus di ceklis',
            'berkas_kompre.mimes' => 'Berkas seminar harus berupa pdf',
            'berkas_kompre.max' => 'Berkas seminar maksimal 2MB',
        ];
    }
}
