<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreCheckInBelumTaLabRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasAnyRole(['mahasiswa', 'mahasiswaS2']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ket_bt' => 'required|min:20|max:255|string',
            'nama_kegiatan_bt' => 'required|min:5|max:255|string',
            'jam_mulai_bt' => 'required|date_format:H:i',
            'jam_selesai_bt' => 'required|date_format:H:i|after:jam_mulai_bt',
        ];
    }
    public function messages()
    {
        return [
            'nama_kegiatan_bt.required' => 'Judul Penelitian harus diisi',
            'nama_kegiatan_bt.min' => 'Judul Penelitian minimal 5 karakter',
            'nama_kegiatan_bt.max' => 'Judul Penelitian maksimal 255 karakter',
            'nama_kegiatan_bt.string' => 'Judul Penelitian harus berupa Kata',
            'ket_bt.required' => 'Keterangan harus diisi',
            'ket_bt.min' => 'Keterangan minimal 20 karakter',
            'ket_bt.max' => 'Keterangan maksimal 255 karakter',
            'ket_bt.string' => 'Keterangan harus berupa Kata',
            'jam_mulai_bt.required' => 'Jam Mulai harus diisi',
            'jam_mulai_bt.date_format' => 'Jam Mulai harus berformat jam:menit',
            'jam_selesai_bt.required' => 'Jam Selesai harus diisi',
            'jam_selesai_bt.date_format' => 'Jam Selesai harus berformat jam:menit',
            'jam_selesai_bt.after' => 'Jam Selesai harus lebih besar dari Jam Mulai'
        ];
    }
    public function prepareForValidation()
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
