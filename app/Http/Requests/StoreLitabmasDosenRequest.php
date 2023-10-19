<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreLitabmasDosenRequest extends FormRequest
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

        $kategori = ['Penelitian', 'Pengabdian'];
        return [
            'nama_litabmas' => 'required|string|min:3|max:255',
            'kategori' => ['required', 'string', 'max:255', Rule::in($kategori)],
            'sumber_dana' => ['required', 'string', 'max:255', 'min:3'],
            'jumlah_dana' => 'required|numeric',
            'tahun_pelaksanaan' => 'required|numeric|digits:4',
            'angota.*' => ['nullable', 'string', 'max:255', 'min:3', 'exists:dosen,encrypt_id', 'distinct'],
            'anggota_external' => ['nullable', 'string', 'max:1255'],
            'url' => 'nullable|string|url',
            'anggota_mahasiswa' => ['nullable', 'string', 'max:1255'],
        ];
    }
    public function messages()
    {
        return [
            'nama_litabmas.required' => 'Nama Litabmas tidak boleh kosong',
            'nama_litabmas.string' => 'Nama Litabmas harus berupa huruf',
            'nama_litabmas.max' => 'Nama Litabmas maksimal 255 karakter',
            'nama_litabmas.min' => 'Nama Litabmas minimal 3 karakter',
            'kategori.required' => 'Kategori tidak boleh kosong',
            'kategori.string' => 'Kategori harus berupa huruf',
            'kategori.max' => 'Kategori maksimal 255 karakter',
            'kategori.in' => 'Kategori harus berupa Penelitian atau Pengabdian',
            'sumber_dana.required' => 'Sumber Dana tidak boleh kosong',
            'sumber_dana.string' => 'Sumber Dana harus berupa huruf',
            'sumber_dana.max' => 'Sumber Dana maksimal 255 karakter',
            'sumber_dana.min' => 'Sumber Dana minimal 3 karakter',
            'jumlah_dana.required' => 'Jumlah Dana tidak boleh kosong',
            'jumlah_dana.numeric' => 'Jumlah Dana harus berupa angka',
            'tahun_pelaksanaan.required' => 'Tahun Pelaksanaan tidak boleh kosong',
            'tahun_pelaksanaan.numeric' => 'Tahun Pelaksanaan harus berupa angka',
            'tahun_pelaksanaan.digits' => 'Tahun Pelaksanaan harus berjumlah 4 karakter',
            'anggota.*.string' => 'Anggota harus berupa huruf',
            'anggota.*.max' => 'Anggota maksimal 255 karakter',
            'anggota.*.min' => 'Anggota minimal 3 karakter',
            'anggota.*.exists' => 'Anggota tidak terdaftar',
            'anggota.*.distinct' => 'Anggota tidak boleh sama',
            'anggota_external.string' => 'Anggota External harus berupa huruf',
            'anggota_external.max' => 'Anggota External maksimal 255 karakter',
            'url.string' => 'URL harus berupa huruf',
            'url.url' => 'URL harus berupa URL',
            'anggota_mahasiswa.string' => 'Anggota Mahasiswa harus berupa huruf',
            'anggota_mahasiswa.max' => 'Anggota Mahasiswa maksimal 255 karakter',
            'anggota_mahasiswa.min' => 'Anggota Mahasiswa minimal 3 karakter'
        ];
    }
}
