<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProfileMahasiswa extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|min:3|max:255',
            'tanggal_masuk' => 'required|date',
            'tempat_lahir' => 'required|string|min:3|max:255',
            'semester' => 'required|numeric|min:1|max:14',
            'foto_profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ];
    }
    public function messages()
    {
        return [
            'foto_profile.max' => 'Maximal 1MB',
            'foto_profile.image' => 'Format Gambar Harus jpeg,png,jpg,gif,svg',
            'foto_profile.mimes' => 'Format Gambar Harus jpeg,png,jpg,gif,svg',
            'foto_profile.required' => 'Foto Profile Harus diunggah',
            'tanggal_lahir.required' => 'Tanggal Lahir Harus diisi',
            'tanggal_lahir.date' => 'Tanggal Lahir Harus Berupa Tanggal',
            'alamat.required' => 'Alamat Harus diisi',
            'alamat.string' => 'Alamat Harus Berupa Kalimat',
            'alamat.min' => 'Alamat Minimal 3 Karakter',
            'alamat.max' => 'Alamat Maksimal 255 Karakter',
            'tanggal_masuk.required' => 'Tanggal Masuk Harus diisi',
            'tanggal_masuk.date' => 'Tanggal Masuk Harus Berupa Tanggal',
            'tempat_lahir.required' => 'Tempat Lahir Harus diisi',
            'tempat_lahir.string' => 'Tempat Lahir Harus Berupa Kalimat',
            'tempat_lahir.min' => 'Tempat Lahir Minimal 3 Karakter',
            'tempat_lahir.max' => 'Tempat Lahir Maksimal 255 Karakter',
            'semester.required' => 'Semester Harus diisi',
            'semester.numeric' => 'Semester Harus Berupa Angka',
            'semester.min' => 'Semester Minimal 1',
            'semester.max' => 'Semester Maksimal 14',
        ];
    }
}
