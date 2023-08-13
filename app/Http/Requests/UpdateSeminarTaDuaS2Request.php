<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSeminarTaDuaS2Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('mahasiswaS2');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->id_pembimbing_2 != 'new') {
            return [
                'semester' => ['required', 'in:Ganjil,Genap'],
                'tahun_akademik' => ['required'],
                'sks' => ['required', 'numeric', 'min:1'],
                'ipk' => ['required', 'numeric', 'min:1'],
                'periode_seminar' => ['required', 'string'],
                'toefl' => ['required', 'numeric', 'min:1'],
                'judul_ta' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'in:on'],
                'berkas_ta_dua' => ['nullable', 'file', 'mimes:pdf', 'max:1048'],
                'id_pembimbing_1' => ['required', 'exists:dosen,encrypt_id'],
                'id_pembimbing_2' => ['required', 'exists:dosen,encrypt_id'],
            ];
        } else {
            return [
                'semester' => ['required', 'in:Ganjil,Genap'],
                'tahun_akademik' => ['required'],
                'sks' => ['required', 'numeric', 'min:1'],
                'ipk' => ['required', 'numeric', 'min:1'],
                'periode_seminar' => ['required', 'string'],
                'toefl' => ['required', 'numeric', 'min:1'],
                'judul_ta' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'in:on'],
                'berkas_ta_dua' => ['nullable', 'file', 'mimes:pdf', 'max:1048'],
                'id_pembimbing_1' => ['required', 'exists:dosen,encrypt_id'],
            ];
        }
    }
    public function messages()
    {
        return [
            'id_pembimbing_1.required' => 'Pembimbing 1 tidak boleh kosong',
            'id_pembimbing_1.exists' => 'Pembimbing 1 tidak ditemukan',
            'id_pembimbing_2.required' => 'Pembimbing 2 tidak boleh kosong',
            'id_pembimbing_2.exists' => 'Pembimbing 2 tidak ditemukan',
            'semester.required' => 'Semester tidak boleh kosong',
            'semester.in' => 'Semester tidak valid',
            'tahun_akademik.required' => 'Tahun akademik tidak boleh kosong',
            'sks.required' => 'SKS tidak boleh kosong',
            'sks.numeric' => 'SKS harus berupa angka',
            'sks.min' => 'SKS minimal 1',
            'ipk.required' => 'IPK tidak boleh kosong',
            'ipk.numeric' => 'IPK harus berupa angka',
            'ipk.min' => 'IPK minimal 1',
            'periode_seminar.required' => 'Periode seminar tidak boleh kosong',
            'toefl.required' => 'TOEFL tidak boleh kosong',
            'toefl.numeric' => 'TOEFL harus berupa angka',
            'toefl.min' => 'TOEFL minimal 1',
            'judul_ta.required' => 'Judul Tugas Akhir tidak boleh kosong',
            'judul_ta.string' => 'Judul Tugas Akhir harus berupa string',
            'judul_ta.max' => 'Judul Tugas Akhir maksimal 255 karakter',
            'agreement.required' => 'Agreement tidak boleh kosong',
            'agreement.in' => 'Agreement tidak valid',
            'berkas_ta_dua.file' => 'Berkas Tugas Akhir harus berupa file',
            'berkas_ta_dua.mimes' => 'Berkas Tugas Akhir harus berupa file pdf',
            'berkas_ta_dua.max' => 'Berkas Tugas Akhir maksimal 1MB',

        ];
    }
}
