<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->jenis_akun == 'mahasiswa' || $this->jenis_akun == 'mahasiswaS2') {
            return [
                'email' => 'required|email|unique:users,email',
                'nama_lengkap' => 'required|string|max:255|min:2',
                'angkatan' => 'required|integer|min:2000|max:2025',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'npm' => 'required|integer|exists:base_npm,npm|unique:mahasiswa,npm',
                'id_dosen' => 'required|exists:dosen,encrypt_id',
                'password' => 'required|string|min:8|max:255|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/',
                'password_confirm' => 'required|same:password',
                'jenis_akun' => 'required|in:mahasiswa,mahasiswaS2',
                'berkas_upload' => 'required|mimes:pdf|max:1048',
            ];
        }
        return [
            'email' => 'required|email|unique:users,email',
            'nama_lengkap' => 'required|string|max:255|min:2',
            'angkatan' => 'required|integer|min:2000|max:2025',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'npm' => 'required|integer|exists:base_npm,npm|unique:mahasiswa,npm',
            'id_dosen' => 'nullable|exists:dosen,encrypt_id',
            'password' => 'required|string|min:8|max:255|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/',
            'password_confirm' => 'required|same:password',
            'jenis_akun' => 'required|in:alumni',
            'berkas_upload' => 'required|mimes:pdf|max:1048',
        ];
    }
    public function messages()
    {
        if ($this->jenis_akun == 'mahasiswa' || $this->jenis_akun == 'mahasiswaS2') {
            return [
                'email.required' => 'Email Harus diisi',
                'email.email' => 'Email Tidak Valid',
                'email.unique' => 'Email Sudah Terdaftar',
                'nama_lengkap.required' => 'Nama Lengkap Harus diisi',
                'nama_lengkap.string' => 'Nama Lengkap Harus Berupa Huruf',
                'nama_lengkap.max' => 'Nama Lengkap Maksimal 255 Karakter',
                'nama_lengkap.min' => 'Nama Lengkap Minimal 2 Karakter',
                'angkatan.required' => 'Angkatan Harus diisi',
                'angkatan.integer' => 'Angkatan Harus Berupa Angka',
                'angkatan.min' => 'Angkatan Minimal 2000',
                'angkatan.max' => 'Angkatan Maximal 2025',
                'gender.required' => 'Jenis Kelamhin Harus dipilih',
                'gender.in' => 'Jenis Kelamin Tidak Valid',
                'npm.required' => 'NPM Harus diisi',
                'npm.integer' => 'NPM Harus Berupa Angka',
                'npm.exists' => 'NPM Tidak Terdaftar',
                'npm.unique' => 'NPM Sudah Terdaftar',
                'password.required' => 'Password Harus diisi',
                'password.string' => 'Password Harus Berupa Huruf',
                'password.min' => 'Password Minimal 8 Karakter',
                'password.max' => 'Password Maksimal 255 Karakter',
                'password.regex' => 'Password Harus Mengandung Huruf Besar, Huruf Kecil, Angka, dan Simbol',
                'password_confirm.required' => 'Konfirmasi Password Harus diisi',
                'password_confirm.same' => 'Konfirmasi Password Tidak Sama',
                'id_dosen.required' => 'Dosen Pembimbing Akademik Harus diisi',
                'id_dosen.exists' => 'Dosen Pembimbing Akademik Tidak Terdaftar',
                'jenis_akun.required' => 'Jenis Akun Harus dipilih',
                'jenis_akun.in' => 'Jenis Akun Tidak Valid',
                'berkas_upload.required' => 'Berkas Upload Harus diisi',
                'berkas_upload.mimes' => 'Berkas Upload Harus Berupa PDF',
                'berkas_upload.max' => 'Berkas Upload Maksimal 1 MB',
            ];
        }
        return [
            'email.required' => 'Email Harus diisi',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Terdaftar',
            'nama_lengkap.required' => 'Nama Lengkap Harus diisi',
            'nama_lengkap.string' => 'Nama Lengkap Harus Berupa Huruf',
            'nama_lengkap.max' => 'Nama Lengkap Maksimal 255 Karakter',
            'nama_lengkap.min' => 'Nama Lengkap Minimal 2 Karakter',
            'angkatan.required' => 'Angkatan Harus diisi',
            'angkatan.integer' => 'Angkatan Harus Berupa Angka',
            'angkatan.min' => 'Angkatan Minimal 2000',
            'angkatan.max' => 'Angkatan Maximal 2025',
            'gender.required' => 'Jenis Kelamhin Harus dipilih',
            'gender.in' => 'Jenis Kelamin Tidak Valid',
            'npm.required' => 'NPM Harus diisi',
            'npm.integer' => 'NPM Harus Berupa Angka',
            'npm.exists' => 'NPM Tidak Terdaftar',
            'npm.unique' => 'NPM Sudah Terdaftar',
            'password.required' => 'Password Harus diisi',
            'password.string' => 'Password Harus Berupa Huruf',
            'password.min' => 'Password Minimal 8 Karakter',
            'password.max' => 'Password Maksimal 255 Karakter',
            'password.regex' => 'Password Harus Mengandung Huruf Besar, Huruf Kecil, Angka, dan Simbol',
            'password_confirm.required' => 'Konfirmasi Password Harus diisi',
            'password_confirm.same' => 'Konfirmasi Password Tidak Sama',
            'id_dosen.exists' => 'Dosen Pembimbing Akademik Tidak Terdaftar',
            'jenis_akun.required' => 'Jenis Akun Harus dipilih',
            'jenis_akun.in' => 'Jenis Akun Tidak Valid',
            'berkas_upload.required' => 'Berkas Upload Harus diisi',
            'berkas_upload.mimes' => 'Berkas Upload Harus Berupa PDF',
            'berkas_upload.max' => 'Berkas Upload Maksimal 1 MB',
        ];
    }

    protected function prepareForValidation()
    {
        $input = $this->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = strip_tags($value);
            }
        }
        $this->replace($input);
    }
}
