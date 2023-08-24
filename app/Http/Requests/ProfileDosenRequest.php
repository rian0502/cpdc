<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileDosenRequest extends FormRequest
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
        $jabatan = ['Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar', 'Tenaga Pengajar'];
        $kepangkatan = ['III A', 'III B', 'III C', 'IV A', 'IV B', 'IV C', 'IV D', 'IV E'];
        return [
            'nama_dosen' => 'required|string|max:255|min:3',
            'nip' => 'required|numeric|digits:18',
            'nidn' => 'required|numeric|digits:10',
            'no_hp' => 'required|numeric|digits_between:10,13',
            'alamat' => 'required|string|max:255|min:3',
            'tempat_lahir' => 'required|string|max:255|min:3',
            'tanggal_lahir' => 'required|date',
            'jabatan' => ['required', 'string', 'max:255', 'in: ' . implode(',', $jabatan)],
            'tanggal_sk_jabatan' => 'required|date',
            'file_sk_jabatan' => 'required|mimes:pdf|max:1048',
            'kepangkatan' => ['required', 'string', 'max:255', 'in: ' . implode(',', $kepangkatan)],
            'tanggal_sk_pangkat' => 'required|date',
            'file_sk_pangkat' => 'nullable|mimes:pdf|max:2048',
            'foto_profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ];
    }

    public function messages()
    {
        return [
            'nama_dosen.required' => 'Nama Dosen tidak boleh kosong',
            'nama_dosen.string' => 'Nama Dosen harus berupa huruf',
            'nama_dosen.max' => 'Nama Dosen maksimal 255 karakter',
            'nama_dosen.min' => 'Nama Dosen minimal 3 karakter',
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.numeric' => 'NIP harus berupa angka',
            'nip.digits' => 'NIP harus berjumlah 18 karakter',
            'nidn.required' => 'NIDN tidak boleh kosong',
            'nidn.numeric' => 'NIDN harus berupa angka',
            'nidn.digits' => 'NIDN harus berjumlah 10 karakter',
            'no_hp.required' => 'No HP tidak boleh kosong',
            'no_hp.numeric' => 'No HP harus berupa angka',
            'no_hp.digits_between' => 'No HP harus berjumlah 10-13 karakter',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.string' => 'Alamat harus berupa huruf',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'alamat.min' => 'Alamat minimal 3 karakter',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'tempat_lahir.string' => 'Tempat Lahir harus berupa huruf',
            'tempat_lahir.max' => 'Tempat Lahir maksimal 255 karakter',
            'tempat_lahir.min' => 'Tempat Lahir minimal 3 karakter',
            'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal',
            'tanggal_sk.date' => 'Tanggal SK harus berupa tanggal',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'jabatan.string' => 'Jabatan harus berupa huruf',
            'jabatan.max' => 'Jabatan maksimal 255 karakter',
            'jabatan.in_str' => 'Jabatan tidak sesuai',
            'kepangkatan.required' => 'Kepangkatan tidak boleh kosong',
            'kepangkatan.string' => 'Kepangkatan harus berupa huruf',
            'kepangkatan.max' => 'Kepangkatan maksimal 255 karakter',
            'kepangkatan.in_str' => 'Kepangkatan tidak sesuai',
            'foto_profile.required' => 'Foto Profile tidak boleh kosong',
            'foto_profile.image' => 'Foto Profile harus berupa gambar',
            'foto_profile.mimes' => 'Foto Profile harus berupa file gambar',
            'foto_profile.max' => 'Foto Profile maksimal 2MB',
            'file_sk.mimes' => 'File SK harus berupa file PDF',
            'file_sk.max' => 'File SK maksimal 2MB',
            'tanggal_sk_jabatan.required' => 'Tanggal SK Jabatan tidak boleh kosong',
            'tanggal_sk_jabatan.date' => 'Tanggal SK Jabatan harus berupa tanggal',
            'file_sk_jabatan.required' => 'File SK Jabatan tidak boleh kosong',
            'file_sk_jabatan.mimes' => 'File SK Jabatan harus berupa file PDF',
            'file_sk_jabatan.max' => 'File SK Jabatan maksimal 2MB',
            'tanggal_sk_pangkat.required' => 'Tanggal SK Pangkat tidak boleh kosong',
            'tanggal_sk_pangkat.date' => 'Tanggal SK Pangkat harus berupa tanggal',
            'file_sk_pangkat.mimes' => 'File SK Pangkat harus berupa file PDF',
            'file_sk_pangkat.max' => 'File SK Pangkat maksimal 2MB',
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
