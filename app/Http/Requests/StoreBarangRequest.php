<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('admin lab');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_barang' => 'required|max:255',
            'jumlah_akhir' => 'required|numeric|min:0',
            'id_model' => 'required|exists:model_barang,encrypt_id',
        ];
    }
    public function messages()
    {
        return [
            'nama_barang.required' => 'Nama Barang harus diisi',
            'nama_barang.max' => 'Nama Barang maksimal 255 karakter',
            'jumlah_akhir.required' => 'Jumlah Barang harus diisi',
            'jumlah_akhir.numeric' => 'Jumlah Barang harus berupa angka',
            'jumlah_akhir.min' => 'Jumlah Barang tidak boleh kurang dari 0',
            'id_model.required' => 'Model Barang harus diisi',
            'id_model.exists' => 'Model Barang tidak ditemukan',
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
