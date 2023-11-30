<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreModelBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('sudo');;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_model' => 'required|max:100',
            'merk' => 'required|max:100',
            'id_kategori' => 'required|exists:kategori,encrypt_id',
        ];
    }

    public function messages()
    {
        return [
            'nama_model.required' => 'Nama model harus diisi',
            'nama_model.max' => 'Nama model maksimal 100 karakter',
            'merk.required' => 'Merk harus diisi',
            'merk.max' => 'Merk maksimal 100 karakter',
            'id_kategori.required' => 'Kategori harus diisi',
            'id_kategori.exists' => 'Kategori tidak ditemukan',
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
