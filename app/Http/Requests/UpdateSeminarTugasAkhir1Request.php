<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSeminarTugasAkhir1Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(['jurusan', 'ta1']);
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
            'sumber_penelitian' => 'required|in:Dosen,Mahasiswa',
            'judul_ta' => 'required',
            'sks' => 'required|numeric',
            'ipk' => 'required',
            'toefl' => 'required|numeric',
            'berkas_ta_satu' => 'nullable|mimes:pdf|max:1024',
            'status_admin' => 'required|in:Valid,Invalid,Process',
            'status_koor' => 'required|in:Selesai,Belum Selesai,Perbaikan, Tidak Lulus',
            'id_pembimbing_satu' => 'required|exists:dosen,encrypt_id',
            'id_pembahas' => 'required|exists:dosen,encrypt_id',
            'tanggal_seminar_ta_satu' => 'required|date',
            'jam_mulai_seminar_ta_satu' => 'required',
            'jam_selesai_seminar_ta_satu' => 'required',
            'id_lokasi' => 'required|exists:lokasi,encrypt_id',
            'no_berkas_ba_seminar_ta_satu' => 'required',
            'berkas_ba_seminar_ta_satu' => 'nullable|mimes:pdf|max:1024',
            'berkas_nilai_seminar_ta_satu' => 'nullable|mimes:pdf|max:1024',
            'berkas_ppt_seminar_ta_satu' => 'nullable|mimes:pdf|max:1024',
            'nilai' => 'required|numeric',
            'huruf_mutu' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'tahun_akademik.required' => 'Tahun akademik harus diisi',
            'semester.required' => 'Semester harus diisi',
            'sumber_penelitian.required' => 'Sumber penelitian harus diisi',
            'judul_ta.required' => 'Judul tugas akhir harus diisi',
            'sks.required' => 'SKS harus diisi',
            'ipk.required' => 'IPK harus diisi',
            'toefl.required' => 'TOEFL harus diisi',
            'berkas_ta_satu.mimes' => 'Berkas tugas akhir harus bertipe pdf',
            'berkas_ta_satu.max' => 'Berkas tugas akhir maksimal 1 MB',
            'status_admin.required' => 'Status admin harus diisi',
            'status_koor.required' => 'Status koordinator harus diisi',
            'id_pembimbing_satu.required' => 'Pembimbing 1 harus diisi',
            'id_pembahas.required' => 'Pembahas harus diisi',
            'tanggal_seminar_ta_satu.required' => 'Tanggal seminar harus diisi',
            'jam_mulai_seminar_ta_satu.required' => 'Jam mulai seminar harus diisi',
            'jam_selesai_seminar_ta_satu.required' => 'Jam selesai seminar harus diisi',
            'id_lokasi.required' => 'Lokasi seminar harus diisi',
            'no_berkas_ba_seminar_ta_satu.required' => 'Nomor berkas BA seminar harus diisi',
            'berkas_ba_seminar_ta_satu.mimes' => 'Berkas BA seminar harus bertipe pdf',
            'berkas_ba_seminar_ta_satu.max' => 'Berkas BA seminar maksimal 1 MB',
            'berkas_nilai_seminar_ta_satu.mimes' => 'Berkas nilai seminar harus bertipe pdf',
            'berkas_nilai_seminar_ta_satu.max' => 'Berkas nilai seminar maksimal 1 MB',
            'berkas_ppt_seminar_ta_satu.mimes' => 'Berkas PPT seminar harus bertipe pdf',
            'berkas_ppt_seminar_ta_satu.max' => 'Berkas PPT seminar maksimal 1 MB',
            'nilai.required' => 'Nilai harus diisi',
            'huruf_mutu.required' => 'Huruf mutu harus diisi'
        ];
    }
}
