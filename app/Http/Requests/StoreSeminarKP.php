<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeminarKP extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('mahasiswa');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $smster = ['Ganjil', 'Genap'];
        $region = ['Unila', 'Dalam Lampung', 'Luar Lampung'];
        return [
            'mitra' => ['required', 'string', 'max:255', 'min:3'],
            'semester' => ['required', 'in:' . implode(',', $smster)],
            'tahun_akademik' => ['required', 'string'],
            'region' => ['required', 'in:' . implode(',', $region)],
            'sks' => ['required', 'numeric'],
            'judul_kp' => ['required', 'string', 'max:255', 'min:3'],
            'id_dospemkp' => ['required', 'string', 'exists:dosen,encrypt_id'],
            'pembimbing_lapangan' => ['required', 'string', 'max:255', 'min:3'],
            'ni_pemlap' => ['required', 'numeric', 'min:3'],
            'rencana_seminar' => ['required'],
            'toefl' => ['nullable','numeric', 'max:600'],
            'ipk' => ['required', 'numeric', 'max:4', 'min:1'],
            'berkas_seminar_pkl' => ['required', 'mimes:pdf', 'max:2048'],
            'agreement' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'mitra.required' => 'Nama mitra harus diisi',
            'mitra.string' => 'Nama mitra harus berupa string',
            'mitra.max' => 'Nama mitra maksimal 255 karakter',
            'mitra.min' => 'Nama mitra minimal 3 karakter',
            'semester.required' => 'Semester harus diisi',
            'semester.in' => 'Semester harus berupa Ganjil atau Genap',
            'tahun_akademik.required' => 'Tahun akademik harus diisi',
            'tahun_akademik.string' => 'Tahun akademik harus berupa string',
            'region.required' => 'Region harus diisi',
            'region.in' => 'Region harus berupa Unila, Dalam Lampung, atau Luar Lampung',
            'sks.required' => 'SKS harus diisi',
            'sks.numeric' => 'SKS harus berupa angka',
            'judul_kp.required' => 'Judul KP harus diisi',
            'judul_kp.string' => 'Judul KP harus berupa string',
            'judul_kp.max' => 'Judul KP maksimal 255 karakter',
            'judul_kp.min' => 'Judul KP minimal 3 karakter',
            'id_dospemkp.required' => 'Dosen pembimbing harus diisi',
            'id_dospemkp.string' => 'Dosen pembimbing harus berupa string',
            'id_dospemkp.exists' => 'Dosen pembimbing tidak ditemukan',
            'pembimbing_lapangan.required' => 'Pembimbing lapangan harus diisi',
            'pembimbing_lapangan.string' => 'Pembimbing lapangan harus berupa string',
            'pembimbing_lapangan.max' => 'Pembimbing lapangan maksimal 255 karakter',
            'pembimbing_lapangan.min' => 'Pembimbing lapangan minimal 3 karakter',
            'ni_pemlap.required' => 'NI pembimbing lapangan harus diisi',
            'ni_pemlap.numeric' => 'NI pembimbing lapangan harus berupa angka',
            'ni_pemlap.min' => 'NI pembimbing lapangan minimal 3 karakter',
            'rencana_seminar.required' => 'Rencana seminar harus diisi',
            'toefl.required' => 'Nilai TOEFL harus diisi',
            'toefl.max' => 'Nilai TOEFL maksimal 255 karakter',
            'ipk.required' => 'IPK harus diisi',
            'ipk.numeric' => 'IPK harus berupa angka',
            'ipk.max' => 'IPK maksimal 4',
            'ipk.min' => 'IPK minimal 1',
            'berkas_seminar_pkl.required' => 'Berkas seminar harus diunggah',
            'berkas_seminar_pkl.mimes' => 'Berkas seminar harus berupa pdf',
            'berkas_seminar_pkl.max' => 'Berkas seminar maksimal 1MB',
            'agreement.required' => 'Anda harus menyetujui persyaratan seminar KP',
        ];
    }
}
