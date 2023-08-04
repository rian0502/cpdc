<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTaSatuS2Request extends FormRequest
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
        if ($this->id_pembimbing_dua != 'new') {
            return [
                'semester' => ['required', 'in:Ganjil,Genap'],
                'tahun_akademik' => ['required'],
                'sks' => ['required', 'numeric', 'min:1'],
                'ipk' => ['required', 'numeric', 'min:1'],
                'periode_seminar' => ['required', 'string'],
                'toefl' => ['required', 'numeric', 'min:1'],
                'sumber_penelitian' => ['required', 'in:Mahasiswa,Dosen'],
                'judul_ta' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'in:on'],
                'berkas_seminar_ta_satu' => ['required', 'file', 'mimes:pdf', 'max:1048'],
                'id_pembimbing_satu' => ['required', 'exists:dosen,encrypt_id'],
                'id_pembimbing_dua' => ['required', 'exists:dosen,encrypt_id'],
            ];
        } else {
            return [
                'semester' => ['required', 'in:Ganjil,Genap'],
                'tahun_akademik' => ['required'],
                'sks' => ['required', 'numeric', 'min:1'],
                'ipk' => ['required', 'numeric', 'min:1'],
                'periode_seminar' => ['required', 'string'],
                'toefl' => ['required', 'numeric', 'min:1'],
                'sumber_penelitian' => ['required', 'in:Mahasiswa,Dosen'],
                'judul_ta' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'in:on'],
                'berkas_seminar_ta_satu' => ['required', 'file', 'mimes:pdf', 'max:1048'],
                'id_pembimbing_satu' => ['required', 'exists:dosen,encrypt_id'],
            ];
        }
    }
    public function messages()
    {
        return [
            'semester.required' => 'Semester harus diisi',
            'semester.in' => 'Semester harus diisi dengan Ganjil atau Genap',
            'tahun_akademik.required' => 'Tahun akademik harus diisi',
            'sks.required' => 'SKS harus diisi',
            'sks.numeric' => 'SKS harus berupa angka',
            'sks.min' => 'SKS minimal 1',
            'ipk.required' => 'IPK harus diisi',
            'ipk.numeric' => 'IPK harus berupa angka',
            'ipk.min' => 'IPK minimal 1',
            'periode_seminar.required' => 'Periode harus diisi',
            'periode_seminar.string' => 'Periode harus berupa string',
            'toefl.required' => 'TOEFL harus diisi',
            'toefl.numeric' => 'TOEFL harus berupa angka',
            'toefl.min' => 'TOEFL minimal 1',
            'sumber_penelitian.required' => 'Sumber penelitian harus diisi',
            'sumber_penelitian.in' => 'Sumber penelitian harus diisi dengan Mahasiswa atau Dosen',
            'judul_ta.required' => 'Judul TA harus diisi',
            'judul_ta.string' => 'Judul TA harus berupa string',
            'judul_ta.max' => 'Judul TA maksimal 255 karakter',
            'agreement.required' => 'Agreement harus diisi',
            'agreement.in' => 'Agreement harus diisi dengan on',
            'berkas_seminar_ta_satu.required' => 'Berkas seminar TA satu harus diisi',
            'berkas_seminar_ta_satu.file' => 'Berkas seminar TA satu harus berupa file',
            'berkas_seminar_ta_satu.mimes' => 'Berkas seminar TA satu harus berupa pdf',
            'berkas_seminar_ta_satu.max' => 'Berkas seminar TA satu maksimal 1MB',
            'id_pembimbing_satu.required' => 'Pembimbing satu harus diisi',
            'id_pembimbing_satu.exists' => 'Pembimbing satu tidak ditemukan',
        ];
    }
}
