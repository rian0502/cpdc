<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAktivitasAlumniRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('alumni');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $hubungan = ['Sangat Erat', 'Cukup Erat', 'Tidak Erat', 'Erat'];
        $status = ['Kerja', 'Kuliah', 'Wirausaha', 'Lainnya'];
        return [
            'tempat' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'tanggal_masuk' => ['required', 'date'],
            'gaji' => ['required', 'numeric'],
            'hubungan' => ['required', 'string', 'in:' . implode(',', $hubungan)],
            'status' => ['required', 'string', 'in:' . implode(',', $status)],
        ];
    }
    public function messages()
    {
        return [
            'tempat.required' => 'Tempat kerja tidak boleh kosong',
            'alamat.required' => 'Alamat kerja tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'tanggal_masuk.required' => 'Tanggal masuk tidak boleh kosong',
            'gaji.required' => 'Gaji tidak boleh kosong',
            'hubungan.required' => 'Hubungan tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'tempat.max' => 'Tempat kerja tidak boleh lebih dari 255 karakter',
            'alamat.max' => 'Alamat kerja tidak boleh lebih dari 255 karakter',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter',
            'tanggal_masuk.date' => 'Tanggal masuk harus berupa tanggal',
            'gaji.numeric' => 'Gaji harus berupa angka',
            'hubungan.in' => 'Hubungan harus berupa pilihan yang tersedia',
            'status.in' => 'Status harus berupa pilihan yang tersedia'
        ];
    }
}
