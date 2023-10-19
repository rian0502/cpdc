<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSidangTesisS2Request extends FormRequest
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
                'berkas_kompre' => ['nullable', 'file', 'mimes:pdf', 'max:1048'],
                'id_pembimbing_1' => ['required', 'exists:dosen,encrypt_id'],
                'id_pembimbing_2' => ['required', 'exists:dosen,encrypt_id'],
                'draft_artikel' => ['nullable', 'file', 'mimes:pdf', 'max:1048'],
                'url_draft_artikel' => ['required', 'url', 'max:255'],
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
                'berkas_kompre' => ['nullable', 'file', 'mimes:pdf', 'max:1048'],
                'id_pembimbing_1' => ['required', 'exists:dosen,encrypt_id'],
                'draft_artikel' => ['nullable', 'file', 'mimes:pdf', 'max:1048'],
                'url_draft_artikel' => ['required', 'url', 'max:255'],
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
            'judul_ta.required' => 'Judul Tesis tidak boleh kosong',
            'judul_ta.string' => 'Judul Tesis harus berupa string',
            'judul_ta.max' => 'Judul Tesis maksimal 255 karakter',
            'agreement.required' => 'Anda harus menyetujui pernyataan ini',
            'agreement.in' => 'Anda harus menyetujui pernyataan ini',
            'berkas_kompre.file' => 'Berkas kompre harus berupa file',
            'berkas_kompre.mimes' => 'Berkas kompre harus berupa file pdf',
            'berkas_kompre.max' => 'Berkas kompre maksimal 1MB',
            'draft_artikel.file' => 'Draft artikel harus berupa file',
            'draft_artikel.mimes' => 'Draft artikel harus berupa file pdf',
            'draft_artikel.max' => 'Draft artikel maksimal 1MB',
            'url_draft_artikel.url' => 'URL draft artikel tidak valid',
            'url_draft_artikel.required' => 'URL draft artikel tidak boleh kosong',
            'url_draft_artikel.max' => 'URL draft artikel maksimal 255 karakter',
        ];
    }
}
