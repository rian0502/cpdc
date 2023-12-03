<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSeminarPKLRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(['jurusan', 'pkl']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul_kp' => 'required',
            'semester' => 'in:Ganjil,Genap',
            'tahun_akademik' => 'required',
            'mitra' => 'required',
            'region' => 'required|in:Unila,Dalam Lampung,Luar Lampung',
            'pembimbing_lapangan' => 'required',
            'ni_pemlap' => 'required',
            'toefl' => 'required',
            'sks' => 'required',
            'ipk' => 'required',
            'berkas_seminar_pkl' => 'nullable|mimes:pdf|max:1024',
            'status_seminar' => 'required|in:Selesai,Belum Selesai,Perbaikan,Tidak Lulus',
            'proses_admin' => 'required|in:Proses,Valid,Invalid',
            'id_dospemkp' => 'required',
            'tanggal_skp' => 'required|date',
            'jam_mulai_skp' => 'required',
            'jam_selesai_skp' => 'required',
            'id_lokasi' => 'required|exists:lokasi,encrypt_id',
            'no_ba_seminar_kp' => 'required',
            'nilai_lapangan' => 'required|numeric|min:0|max:100',
            'nilai_akd' => 'required|numeric|min:0|max:100',
            'nilai_akhir' => 'required|numeric|min:0|max:100',
            'nilai_mutu' => 'required',
            'berkas_ba_seminar_kp' => 'nullable|mimes:pdf|max:1024',
            'laporan_kp' => 'nullable|mimes:pdf|max:1024',
        ];
    }
    public function messages()
    {
        return [
            'judul_kp.required' => 'Judul Kerja Praktik harus diisi',
            'semester.in' => 'Semester harus diisi',
            'tahun_akademik.required' => 'Tahun Ajaran harus diisi',
            'mitra.required' => 'Mitra harus diisi',
            'region.required' => 'Region harus diisi',
            'region.in' => 'Region harus diisi',
            'pembimbing_lapangan.required' => 'Pembimbing Lapangan harus diisi',
            'ni_pemlap.required' => 'NI Pembimbing Lapangan harus diisi',
            'toefl.required' => 'TOEFL harus diisi',
            'sks.required' => 'SKS harus diisi',
            'ipk.required' => 'IPK harus diisi',
            'berkas_seminar_pkl.mimes' => 'Berkas Seminar harus berupa file pdf',
            'berkas_seminar_pkl.max' => 'Berkas Seminar maksimal 1 MB',
            'status_seminar.required' => 'Status Seminar harus diisi',
            'status_seminar.in' => 'Status Seminar harus diisi',
            'proses_admin.required' => 'Proses Admin harus diisi',
            'proses_admin.in' => 'Proses Admin harus diisi',
            'id_dospemkp.required' => 'Dosen Pembimbing harus diisi',
            'tanggal_skp.required' => 'Tanggal Seminar harus diisi',
            'tanggal_skp.date' => 'Tanggal Seminar harus diisi',
            'jam_mulai_skp.required' => 'Jam Mulai Seminar harus diisi',
            'jam_selesai_skp.required' => 'Jam Selesai Seminar harus diisi',
            'id_lokasi.required' => 'Lokasi Seminar harus diisi',
            'id_lokasi.exists' => 'Lokasi Seminar harus sesuai',
            'no_ba_seminar_kp.required' => 'Nomor BA Seminar harus diisi',
            'nilai_lapangan.required' => 'Nilai Lapangan harus diisi',
            'nilai_lapangan.numeric' => 'Nilai Lapangan harus berupa angka',
            'nilai_lapangan.min' => 'Nilai Lapangan minimal 0',
            'nilai_lapangan.max' => 'Nilai Lapangan maksimal 100',
            'nilai_akd.required' => 'Nilai AKD harus diisi',
            'nilai_akd.numeric' => 'Nilai AKD harus berupa angka',
            'nilai_akd.min' => 'Nilai AKD minimal 0',
            'nilai_akd.max' => 'Nilai AKD maksimal 100',
            'nilai_akhir.required' => 'Nilai Akhir harus diisi',
            'nilai_akhir.numeric' => 'Nilai Akhir harus berupa angka',
            'nilai_akhir.min' => 'Nilai Akhir minimal 0',
            'nilai_akhir.max' => 'Nilai Akhir maksimal 100',
            'nilai_mutu.required' => 'Nilai Mutu harus diisi',
            'berkas_ba_seminar_kp.mimes' => 'Berkas BA Seminar harus berupa file pdf',
            'berkas_ba_seminar_kp.max' => 'Berkas BA Seminar maksimal 1 MB',
            'laporan_kp.mimes' => 'Laporan Kerja Praktik harus berupa file pdf',
            'laporan_kp.max' => 'Laporan Kerja Praktik maksimal 1 MB',
        ];
    }
}
