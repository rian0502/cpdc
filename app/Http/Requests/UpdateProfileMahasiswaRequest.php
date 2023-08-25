<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileMahasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasAnyRole(['mahasiswa', 'alumni', 'mahasiswaS2']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_mahasiswa' => 'required|min:3|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|numeric|digits_between:10,13',
            'alamat' => 'required|min:3|max:255',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'tanggal_masuk' => 'required|date',
            'tempat_lahir' => 'required|min:3|max:255',
            'angkatan' => 'required|numeric|digits:4',
            'semester' => 'required|numeric|digits_between:1,2',
            'id_dosen' => 'required|exists:dosen,encrypt_id',
            'foto_profile' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ];
    }
    public function messages()
    {
        return [
            'nama_mahasiswa.required' => 'Nama mahasiswa tidak boleh kosong',
            'nama_mahasiswa.min' => 'Nama mahasiswa minimal 3 karakter',
            'nama_mahasiswa.max' => 'Nama mahasiswa maksimal 255 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
            'no_hp.required' => 'Nomor HP tidak boleh kosong',
            'no_hp.numeric' => 'Nomor HP harus berupa angka',
            'no_hp.digits_between' => 'Nomor HP minimal 10 digit dan maksimal 13 digit',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.min' => 'Alamat minimal 3 karakter',
            'gender.required' => 'Jenis Kelamin Harus dipilih salah satu',
            'gender.in' => 'Jenis Kelamin Laki-laki atau Perempuan',
            'tanggal_masuk.required' => 'Tanggal masuk tidak boleh kosong',
            'tanggal_masuk.date' => 'Tanggal masuk harus berupa tanggal',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter',
            'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter',
            'angkatan.required' => 'Angkatan tidak boleh kosong',
            'angkatan.numeric' => 'Angkatan harus berupa angka',
            'angkatan.digits' => 'Angkatan harus 4 digit',
            'semester.required' => 'Semester tidak boleh kosong',
            'semester.numeric' => 'Semester harus berupa angka',
            'semester.digits_between' => 'Semester minimal 1 digit dan maksimal 2 digit',
            'id_dosen.required' => 'Dosen Pembimbing Akademik Harus dipilih',
            'id_dosen.exists' => 'Dosen Pembimbing Akademik tidak ditemukan',
            'foto_profile.image' => 'Foto profile harus berupa gambar',
            'foto_profile.mimes' => 'Foto profile harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto_profile.max' => 'Foto profile maksimal 1MB',
        ];
    }
}
