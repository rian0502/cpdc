<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSeminarKomprehensifRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(['jurusan', 'kompre']);
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
            'berkas_kompre' => 'nullable|mimes:pdf|max:1024',
            'status_admin' => 'required|in:Valid,Invalid,Process',
            'status_koor' => 'required|in:Selesai,Belum Selesai,Perbaikan, Tidak Lulus',
            'id_pembimbing_satu' => 'required|exists:dosen,encrypt_id',
            'id_pembahas' => 'required|exists:dosen,encrypt_id',
            'tanggal_komprehensif' => 'required|date',
            'jam_mulai_komprehensif' => 'required',
            'jam_selesai_komprehensif' => 'required',
            'id_lokasi' => 'required|exists:lokasi,encrypt_id',
            'no_ba_berkas' => 'required',
            'ba_seminar_komprehensif' => 'nullable|mimes:pdf|max:1024',
            'berkas_nilai_kompre' => 'nullable|mimes:pdf|max:1024',
            'laporan_ta' => 'required|url',
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
            'berkas_kompre.mimes' => 'Berkas tugas akhir harus bertipe pdf',
            'berkas_kompre.max' => 'Berkas tugas akhir maksimal 1 MB',
            'status_admin.required' => 'Status admin harus diisi',
            'status_koor.required' => 'Status koordinator harus diisi',
            'id_pembimbing_satu.required' => 'Pembimbing 1 harus diisi',
            'id_pembahas.required' => 'Pembahas harus diisi',
            'tanggal_komprehensif.required' => 'Tanggal seminar harus diisi',
            'tanggal_komprehensif.date' => 'Tanggal seminar harus berupa tanggal',
            'jam_mulai_komprehensif.required' => 'Jam mulai seminar harus diisi',
            'jam_selesai_komprehensif.required' => 'Jam selesai seminar harus diisi',
            'id_lokasi.required' => 'Lokasi seminar harus diisi',
            'no_ba_berkas.required' => 'Nomor berkas BA seminar harus diisi',
            'ba_seminar_komprehensif.mimes' => 'Berkas BA seminar harus bertipe pdf',
            'ba_seminar_komprehensif.max' => 'Berkas BA seminar maksimal 1 MB',
            'berkas_nilai_kompre.mimes' => 'Berkas nilai seminar harus bertipe pdf',
            'berkas_nilai_kompre.max' => 'Berkas nilai seminar maksimal 1 MB',
            'laporan_ta.required' => 'Berkas PPT seminar harus diisi',
            'laporan_ta.url' => 'Berkas PPT seminar harus berupa URL',
            'nilai.required' => 'Nilai harus diisi',
            'huruf_mutu.required' => 'Huruf mutu harus diisi'
        ];
    }
}
