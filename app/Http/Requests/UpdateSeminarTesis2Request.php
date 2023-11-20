<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeminarTesis2Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(['jurusan', 'ta2S2']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tahun_akademik' => 'required',
            'semester' => 'required|in:Ganjil,Genap',
            'periode_seminar' => 'required',
            'judul_ta' => 'required',
            'sks' => 'required|numeric',
            'ipk' => 'required',
            'toefl' => 'required|numeric',
            'berkas_ta_dua' => 'nullable|mimes:pdf|max:1024',
            'komentar' => 'nullable|string',
            'status_admin' => 'required|in:Valid,Invalid,Process',
            'status_koor' => 'required|in:Selesai,Belum Selesai,Perbaikan, Tidak Lulus',
            'id_pembimbing_1' => 'required|exists:dosen,encrypt_id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'id_lokasi' => 'required|exists:lokasi,encrypt_id',
            'no_ba' => 'required',
            'nilai' => 'required|numeric',
            'nilai_mutu' => 'required',
            'ppt' => 'required|url',
            'file_ba' => 'nullable|mimes:pdf|max:1024',
            'file_nilai' => 'nullable|mimes:pdf|max:1024',
        ];
    }
    public function messages()
    {
        return [
            'tahun_akademik.required' => 'Tahun akademik harus diisi',
            'semester.required' => 'Semester harus diisi',
            'semester.in' => 'Semester harus berupa Ganjil atau Genap',
            'periode_seminar.required' => 'Periode seminar harus diisi',
            'judul_ta.required' => 'Judul tesis harus diisi',
            'sks.required' => 'SKS harus diisi',
            'ipk.required' => 'IPK harus diisi',
            'toefl.required' => 'TOEFL harus diisi',
            'berkas_ta_dua.mimes' => 'Berkas tesis harus bertipe pdf',
            'berkas_ta_dua.max' => 'Berkas tesis maksimal 1 MB',
            'komentar.string' => 'Komentar harus berupa string',
            'status_admin.required' => 'Status admin harus diisi',
            'status_koor.required' => 'Status koordinator harus diisi',
            'id_pembimbing_1.required' => 'Pembimbing 1 harus diisi',
            'tanggal.required' => 'Tanggal seminar harus diisi',
            'jam_mulai.required' => 'Jam mulai seminar harus diisi',
            'jam_selesai.required' => 'Jam selesai seminar harus diisi',
            'id_lokasi.required' => 'Lokasi seminar harus diisi',
            'no_ba.required' => 'Nomor berita acara harus diisi',
            'nilai.required' => 'Nilai harus diisi',
            'nilai_mutu.required' => 'Nilai mutu harus diisi',
            'ppt.required' => 'Berkas PPT seminar harus diisi',
            'ppt.url' => 'Berkas PPT seminar harus berupa URL',
            'file_ba.mimes' => 'Berkas berita acara harus bertipe pdf',
            'file_ba.max' => 'Berkas berita acara maksimal 1 MB',
            'file_nilai.mimes' => 'Berkas nilai seminar harus bertipe pdf',
            'file_nilai.max' => 'Berkas nilai seminar maksimal 1 MB'
        ];
    }
}
