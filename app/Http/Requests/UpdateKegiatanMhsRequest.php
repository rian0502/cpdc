<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateKegiatanMhsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasAnyRole(['mahasiswa','alumni','mahasiswaS2']);
    }

    public function rules()
    {
        $peran = ["Ketua", "Anggota", "Peserta"];
        return [
            "nama_aktivitas" => ["required", "string", "max:255", "min:3"],
            "tanggal" => ["required", "date"],
            "sks_konversi" => ["required", "numeric", "min:0"],
            "peran" => ["required", "string", "in:" . implode(",", $peran)],
            "file_aktivitas" => ["nullable", "file", "mimes:pdf", "max:2048"]
        ];
    }

    public function messages()
    {
        return [
            "nama_aktivitas.required" => "Nama kegiatan harus diisi",
            "nama_aktivitas.string" => "Nama kegiatan harus berupa string",
            "nama_aktivitas.max" => "Nama kegiatan maksimal 255 karakter",
            "nama_aktivitas.min" => "Nama kegiatan minimal 3 karakter",
            "tanggal.required" => "Tanggal kegiatan harus diisi",
            "tanggal.date" => "Tanggal kegiatan harus berupa tanggal",
            "sks_konversi.required" => "SKS konversi harus diisi",
            "sks_konversi.numeric" => "SKS konversi harus berupa angka",
            "sks_konversi.min" => "SKS konversi minimal 0",
            "peran.required" => "Peran harus diisi",
            "peran.string" => "Peran harus berupa string",
            "peran.in" => "Peran tidak Valid",
            "file_aktivitas.file" => "File aktivitas harus berupa file",
            "file_aktivitas.mimes" => "File aktivitas harus berupa pdf",
            "file_aktivitas.max" => "File aktivitas maksimal 2MB"
        ];
    }
}
