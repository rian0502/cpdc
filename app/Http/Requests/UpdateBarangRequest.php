<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('admin lab');;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->request->get('ket') || $this->request->get('jumlah_akhir')) {
            return [
                'nama_barang' => 'required|max:255',
                'jumlah_akhir' => 'required|numeric|min:0',
                'id_lokasi' => 'required|exists:lokasi,encrypt_id',
                'id_model' => 'required|exists:model_barang,encrypt_id',
                'ket' => 'required|max:255|string',
                'jumlah_akhir' => 'required|numeric|min:0',
            ];
        } else {
            return [
                'nama_barang' => 'required|max:255',
                'id_lokasi' => 'required|exists:lokasi,encrypt_id',
                'id_model' => 'required|exists:model_barang,encrypt_id',
            ];
        }
    }
    public function messages()
    {
        if ($this->request->get('ket') || $this->request->get('jumlah_akhir')) {
            return [
                'nama_barang.required' => 'Nama Barang harus diisi',
                'nama_barang.max' => 'Nama Barang maksimal 255 karakter',
                'id_model.required' => 'Model Barang harus diisi',
                'id_model.exists' => 'Model Barang tidak ditemukan',
                'id_lokasi.required' => 'Lokasi Barang harus diisi',
                'id_lokasi.exists' => 'Lokasi Barang tidak ditemukan',
                'ket.required' => 'Keterangan harus diisi',
                'ket.max' => 'Keterangan maksimal 255 karakter',
                'jumlah_akhir.required' => 'Jumlah Akhir Barang harus diisi',
                'jumlah_akhir.numeric' => 'Jumlah Akhir Barang harus berupa angka',
                'jumlah_akhir.min' => 'Jumlah Akhir Barang tidak boleh kurang dari 0',
            ];
        } else {
            return [
                'nama_barang.required' => 'Nama Barang harus diisi',
                'nama_barang.max' => 'Nama Barang maksimal 255 karakter',
                'id_model.required' => 'Model Barang harus diisi',
                'id_model.exists' => 'Model Barang tidak ditemukan',
                'id_lokasi.required' => 'Lokasi Barang harus diisi',
                'id_lokasi.exists' => 'Lokasi Barang tidak ditemukan',
            ];
        }
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
