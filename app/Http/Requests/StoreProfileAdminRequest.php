<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProfileAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(['admin lab', 'admin berkas']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $pangkat = ['I A', 'I B', 'I C', 'I D', 'II A', 'II B', 'II C', 'II D', 'III A', 'III B', 'III C', 'III D', 'IV A', 'IV B', 'IV C', 'IV d', 'IV E'];
        return [
            'nama_administrasi' => 'required|string|min:3|max:255',
            'nip' => 'required|numeric|digits:18',
            'no_hp' => 'required|numeric|digits_between:10,13',
            'tempat_lahir' => 'required|string|min:3|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|min:3|max:255',
            'tanggal_sk' => 'required|date',
            'kepangkatan' => ['required','string','in:"' . implode('","', $pangkat) . '"'],
            'file_sk' => 'required|mimes:pdf|max:1048',
            'gender' => 'required|in:Laki-laki,Perempuan',
        ];
    }

    public function messages()
    {
        return [
            'nama_administrasi.required' => 'Nama harus diisi',
            'nama_administrasi.string' => 'Nama harus berupa string',
            'nama_administrasi.min' => 'Nama minimal 3 karakter',
            'nama_administrasi.max' => 'Nama maksimal 255 karakter',
            'nip.required' => 'NIP harus diisi',
            'nip.numeric' => 'NIP harus berupa angka',
            'nip.digits' => 'NIP harus 18 digit',
            'no_hp.required' => 'Nomor HP harus diisi',
            'no_hp.numeric' => 'Nomor HP harus berupa angka',
            'no_hp.digits_between' => 'Nomor HP harus 10-13 digit',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tempat_lahir.string' => 'Tempat lahir harus berupa string',
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter',
            'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.string' => 'Alamat harus berupa string',
            'alamat.min' => 'Alamat minimal 3 karakter',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'tanggal_sk.required' => 'Tanggal SK harus diisi',
            'tanggal_sk.date' => 'Tanggal SK harus berupa tanggal',
            'kepangkatan.required' => 'Kepangkatan harus diisi',
            'kepangkatan.in' => 'Kepangkatan tidak valid',
            'file_sk.required' => 'File SK harus diisi',
            'file_sk.mimes' => 'File SK harus berupa file pdf',
            'file_sk.max' => 'File SK maksimal 2 MB',
            'gender.required' => 'Gender Harus dipilih',
            'gender.in' => 'Gender Tidak Valid'
        ];
    }
}
