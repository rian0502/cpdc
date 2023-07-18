<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileDosenRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nama_dosen' => 'required|string|max:255|min:3',
            'nip' => 'required|numeric|digits:18',
            'nidn' => 'required|numeric|digits:10',
            'no_hp' => 'required|numeric|digits_between:10,13',
            'alamat' => 'required|string|max:255|min:3',
            'tempat_lahir' => 'required|string|max:255|min:3',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'nama_dosen.required' => 'Nama tidak boleh kosong',
            'nama_dosen.string' => 'Nama harus berupa string',
            'nama_dosen.max' => 'Nama maksimal 255 karakter',
            'nama_dosen.min' => 'Nama minimal 3 karakter',
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.numeric' => 'NIP harus berupa angka',
            'nip.digits' => 'NIP harus 18 digit',
            'nidn.required' => 'NIDN tidak boleh kosong',
            'nidn.numeric' => 'NIDN harus berupa angka',
            'nidn.digits' => 'NIDN harus 10 digit',
            'no_hp.required' => 'Nomor HP tidak boleh kosong',
            'no_hp.numeric' => 'Nomor HP harus berupa angka',
            'no_hp.digits_between' => 'Nomor HP harus 10-13 digit',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.string' => 'Alamat harus berupa string',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'alamat.min' => 'Alamat minimal 3 karakter',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
            'tempat_lahir.string' => 'Tempat lahir harus berupa string',
            'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter',
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'gender.required' => 'Jenis Kelamin Harus dipilih salah satu',
            'gender.in' => 'Jenis Kelamin Laki-laki atau Perempuan',
            'foto_profile.image' => 'Foto profile harus berupa gambar',
            'foto_profile.mimes' => 'Foto profile harus berupa jpeg,png,jpg,gif,svg',
            'foto_profile.max' => 'Foto profile maksimal 1 MB',
        ];
    }
}
