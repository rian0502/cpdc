<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriRequest extends FormRequest
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
            'nama_kategori' => 'required|max:100',
            'ket' => 'required|max:200'
        ];
    }
    public function messages()
    {
        return [
            'nama_kategori.required' => 'Nama Kategori harus diisi',
            'nama_kategori.max' => 'Nama Kategori maksimal 100 karakter',
            'ket.required' => 'Keterangan harus diisi',
            'ket.max' => 'Keterangan maksimal 200 karakter'
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
