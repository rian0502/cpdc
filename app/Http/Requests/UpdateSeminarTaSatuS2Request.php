<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSeminarTaSatuS2Request extends FormRequest
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
                'berkas_seminar_ta_satu' => ['nullable', 'file', 'mimes:pdf', 'max:1048'],
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
                'sumber_penelitian' => ['required', 'in:Mahasiswa,Dosen'],
                'judul_ta' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'in:on'],
                'berkas_seminar_ta_satu' => ['nullable', 'file', 'mimes:pdf', 'max:1048'],
                'id_pembimbing_1' => ['required', 'exists:dosen,encrypt_id'],
            ];
        }
    }
    public function messages()
    {
        return [
            'semester.required' => 'Semester harus diisi.',
            'semester.in' => 'Semester harus diisi dengan Ganjil atau Genap.',
            'tahun_akademik.required' => 'Tahun akademik harus diisi.',
            'sks.required' => 'SKS harus diisi.',
            'sks.numeric' => 'SKS harus diisi dengan angka.',
            'sks.min' => 'SKS minimal 1.',
            'ipk.required' => 'IPK harus diisi.',
            'ipk.numeric' => 'IPK harus diisi dengan angka.',
            'ipk.min' => 'IPK minimal 1.',
            'periode_seminar.required' => 'Periode seminar harus diisi.',
            'toefl.required' => 'TOEFL harus diisi.',
            'toefl.numeric' => 'TOEFL harus diisi dengan angka.',
            'toefl.min' => 'TOEFL minimal 1.',
            'sumber_penelitian.required' => 'Sumber penelitian harus diisi.',
            'sumber_penelitian.in' => 'Sumber penelitian harus diisi dengan Mahasiswa atau Dosen.',
            'judul_ta.required' => 'Judul TA harus diisi.',
            'judul_ta.string' => 'Judul TA harus diisi dengan teks.',
            'judul_ta.max' => 'Judul TA maksimal 255 karakter.',
            'agreement.required' => 'Agreement harus diisi.',
            'agreement.in' => 'Agreement harus diisi dengan on.',
            'berkas_seminar_ta_satu.required' => 'Berkas seminar TA 1 harus diisi.',
            'berkas_seminar_ta_satu.file' => 'Berkas seminar TA 1 harus diisi dengan file.',
            'berkas_seminar_ta_satu.mimes' => 'Berkas seminar TA 1 harus diisi dengan file bertipe: pdf.',
            'berkas_seminar_ta_satu.max' => 'Berkas seminar TA 1 harus diisi dengan file berukuran maksimal 1 MB.',
            'id_pembimbing_1.required' => 'Pembimbing 1 harus diisi.',
            'id_pembimbing_1.exists' => 'Pembimbing 1 tidak ditemukan.',
            'id_pembimbing_2.required' => 'Pembimbing 2 harus diisi.',
            'id_pembimbing_2.exists' => 'Pembimbing 2 tidak ditemukan.',
        ];
    }
}
