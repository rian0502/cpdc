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
        $kategori_litabmas = ['Penelitian', 'Pengabdian'];
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
            'Prosiding Nasional',
            'Paten',
            'Paten Sederhana',
            'Hak Cipta',
            'Desain Produk Industri',
            'Teknologi Tepat Guna',
            'Buku ber-ISBN',
            'Book Chapter'
        ];
        return [
            'nama_publikasi' => 'required|string|min:3|max:255',
            'vol' =>['nullable', 'numeric', 'max:9999999'],
            'halaman' => 'nullable|max:255',
            'judul' => 'required|string|min:3|max:255',
            'tahun' => 'required|numeric|min:4|digits:4',
            'url' => 'nullable|url',
            'kategori_litabmas' => 'required|string|min:3|max:25|in:' . implode(',', $kategori_litabmas),
            'scala' => 'required|string|min:3|max:25|in:' . implode(',', $regional),
            'kategori' => 'required|string|min:3|max:50|in:' . implode(',', $kategori),
            'anggota.*' => ['nullable', 'string', 'max:255', 'min:3', 'exists:dosen,encrypt_id', 'distinct'],
            'anggota_external' => ['nullable', 'string']
        ];
    }
    public function messages()
    {
        return [
            'vol.max' => 'Maximal 255 Karakter ',
            'halaman.max' => 'Maximal 255 Karakter ',
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
            'kategori_litabmas.required' => 'kategori_litabmas tidak boleh kosong',
            'kategori_litabmas.string' => 'kategori_litabmas harus berupa huruf',
            'kategori_litabmas.max' => 'kategori_litabmas maksimal 25 karakter',
            'kategori_litabmas.min' => 'kategori_litabmas minimal 3 karakter',
            'kategori_litabmas.in' => 'kategori_litabmas harus berupa Penelitian atau Pengabdian',
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
