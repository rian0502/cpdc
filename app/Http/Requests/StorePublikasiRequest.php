<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StorePublikasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('dosen');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $regional = ['Nasional', 'Internasional'];
        $litabmas = ['Penelitian', 'Pengabdian'];
        $kategori = [
            'Buku Referensi', 
            'Monograf', 
            'Buku Nasional', 
            'Buku Internasional', 
            'Artikel Internasional Bereputasi',
            'Artikel Internasional Terindkes',
            'Jurnal Nasional Terakreditasi Dikti',
            'Jurnal Nasional',
            'Jurnal Ilmiah',
            'Prosiding Internasional Terindeks',
            'Prosiding Internasional',
            'Prosiding Nasional'
        ];
        return [
            'nama_publikasi' => 'required|string|min:3|max:255',
            'volume' =>['nullable', 'numeric', 'max:9999999'],
            'no_halaman' => 'nullable|max:255',
            'judul' => 'required|string|min:3|max:255',
            'tahun' => 'required|numeric|min:4|digits:4',
            'url' => 'nullable|url',
            'litabmas' => 'required|string|min:3|max:25|in:' . implode(',', $litabmas),
            'scala' => 'required|string|min:3|max:25|in:' . implode(',', $regional),
            'kategori' => 'required|string|min:3|max:25|in:' . implode(',', $kategori),
            'anggota.*' => ['nullable', 'string', 'max:255', 'min:3', 'exists:dosen,encrypt_id', 'distinct'],
            'anggota_external' => ['nullable', 'string']
        ];
    }
    public function messages()
    {
        return [
            'volumen.max' => 'Maximal 255 Karakter ',
            'no_halaman.max' => 'Maximal 255 Karakter ',
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.string' => 'Judul harus berupa huruf',
            'judul.max' => 'Judul maksimal 255 karakter',
            'judul.min' => 'Judul minimal 3 karakter',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.integer' => 'Tahun harus berupa angka',
            'tahun.min' => 'Tahun minimal 4 karakter',
            'tahun.digits' => 'Tahun maksimal 4 Digit',
            'url.url' => 'Link harus berupa URL Publikasi',
            'daerah.required' => 'Daerah tidak boleh kosong',
            'daerah.string' => 'Daerah harus berupa huruf',
            'daerah.max' => 'Daerah maksimal 255 karakter',
            'daerah.min' => 'Daerah minimal 3 karakter',
            'litabmas.required' => 'Litabmas tidak boleh kosong',
            'litabmas.string' => 'Litabmas harus berupa huruf',
            'litabmas.max' => 'Litabmas maksimal 25 karakter',
            'litabmas.min' => 'Litabmas minimal 3 karakter',
            'litabmas.in' => 'Litabmas harus berupa Penelitian atau Pengabdian',
            'scala.required' => 'Skala tidak boleh kosong',
            'scala.string' => 'Skala harus berupa huruf',
            'scala.max' => 'Skala maksimal 25 karakter',
            'scala.min' => 'Skala minimal 3 karakter',
            'scala.in' => 'Skala harus berupa Nasional atau Internasional',
            'kategori.required' => 'Kategori tidak boleh kosong',
            'kategori.string' => 'Kategori harus berupa huruf',
            'kategori.max' => 'Kategori maksimal 25 karakter',
            'kategori.min' => 'Kategori minimal 3 karakter',
            'kategori.in' => 'Kategori Harus Sesuai',
            'anggota.*.string' => 'Anggota harus berupa huruf',
            'anggota.*.max' => 'Anggota maksimal 255 karakter',
            'anggota.*.min' => 'Anggota minimal 3 karakter',
            'anggota.*.exists' => 'Anggota tidak terdaftar',
            'anggota.*.distinct' => 'Anggota tidak boleh sama',
            'anggota_external.string' => 'Nama Nama Anggota Harus Beruapa Huruf',
            'nama_publikasi.required' => 'Nama Publikasi tidak boleh kosong',
            'nama_publikasi.string' => 'Nama Publikasi harus berupa huruf',
            'nama_publikasi.max' => 'Nama Publikasi maksimal 255 karakter',
            'nama_publikasi.min' => 'Nama Publikasi minimal 3 karakter',
            
        ];
    }
}
