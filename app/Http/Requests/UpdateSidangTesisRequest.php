<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSidangTesisRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->hasRole(['jurusan', 'kompreS2']);
    }

    public function rules()
    {
        return [
            'tahun_akademik' => 'required',
            'semester' => 'required|in:Ganjil,Genap',
            'judul_ta' => 'required',
            'sks' => 'required|numeric',
            'ipk' => 'required',
            'draft_artikel' => 'nullable',
            'url_draft_artikel' => 'required|url',
            'toefl' => 'required|numeric',
            'berkas_ta_dua' => 'nullable|mimes:pdf|max:1024',
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
            'file_ba' => 'nullable|mimes:pdf|max:1024',
            'file_nilai' => 'nullable|mimes:pdf|max:1024',
            'pengesahan' => 'required|url',
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
            'draft_artikel.required' => 'Draft artikel harus diisi',
            'url_draft_artikel.required' => 'URL draft artikel harus diisi',
            'toefl.required' => 'Nilai TOEFL harus diisi',
            'berkas_ta_dua.required' => 'Berkas TA 2 harus diisi',
            'status_admin.required' => 'Status admin harus diisi',
            'status_koor.required' => 'Status koordinator harus diisi',
            'id_pembimbing_1.required' => 'Pembimbing 1 harus diisi',
            'tanggal.required' => 'Tanggal harus diisi',    
            'jam_mulai.required' => 'Jam mulai harus diisi',
            'jam_selesai.required' => 'Jam selesai harus diisi',
            'id_lokasi.required' => 'Lokasi harus diisi',
            'no_ba.required' => 'Nomor BA harus diisi',
            'nilai.required' => 'Nilai harus diisi',
            'nilai_mutu.required' => 'Nilai mutu harus diisi',
            'file_ba.required' => 'File BA harus diisi',
            'file_ba.mimes' => 'File BA harus berupa PDF',
            'file_ba.max' => 'File BA maksimal 1 MB',
            'file_nilai.required' => 'File nilai harus diisi',
            'file_nilai.mimes' => 'File nilai harus berupa PDF',    
            'file_nilai.max' => 'File nilai maksimal 1 MB',
            'pengesahan.required' => 'Pengesahan harus diisi',
            'pengesahan.url' => 'Pengesahan harus berupa URL',
        ];
    }
}
