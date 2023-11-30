<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrganisasiDosenRequest extends FormRequest
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
        return [
            'nama_organisasi' => 'required|string|max:255|min:3',
            'jabatan' => 'required|string|max:255|min:3',
            'tahun_menjabat' => 'required|numeric|min:4',
            'tahun_berakhir' => 'required|numeric|min:4|gte:tahun_menjabat',
        ];
    }
    public function messages()
    {
        return [
            'nama_organisasi.required' => 'Nama Organisasi tidak boleh kosong',
            'nama_organisasi.string' => 'Nama Organisasi harus berupa huruf',
            'nama_organisasi.max' => 'Nama Organisasi maksimal 255 karakter',
            'nama_organisasi.min' => 'Nama Organisasi minimal 3 karakter',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'jabatan.string' => 'Jabatan harus berupa huruf',
            'jabatan.max' => 'Jabatan maksimal 255 karakter',
            'jabatan.min' => 'Jabatan minimal 3 karakter',
            'tahun_menjabat.required' => 'Tahun Menjabat tidak boleh kosong',
            'tahun_menjabat.numeric' => 'Tahun Menjabat harus berupa angka',
            'tahun_menjabat.min' => 'Tahun Menjabat minimal 4 karakter',
            'tahun_berakhir.required' => 'Tahun Berakhir tidak boleh kosong',
            'tahun_berakhir.numeric' => 'Tahun Berakhir harus berupa angka',
            'tahun_berakhir.min' => 'Tahun Berakhir minimal 4 karakter',
            'tahun_berakhir.gte' => 'Tahun Berakhir harus lebih besar dari Tahun Menjabat',
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
