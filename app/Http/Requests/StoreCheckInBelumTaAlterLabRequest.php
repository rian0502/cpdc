<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCheckInBelumTaAlterLabRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('mahasiswa');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ket_bta' => 'required|min:20|max:255|string',
            'nama_kegiatan_bta' => 'required|min:5|max:255|string',
            'jam_mulai_bta' => 'required|date_format:H:i',
            'jam_selesai_bta' => 'required|date_format:H:i|after:jam_mulai_bta',
        ];
    }
    public function messages()
    {
        return [
            'nama_kegiatan_bta.required' => 'Judul Penelitian harus diisi',
            'nama_kegiatan_bta.min' => 'Judul Penelitian minimal 5 karakter',
            'nama_kegiatan_bta.max' => 'Judul Penelitian maksimal 255 karakter',
            'nama_kegiatan_bta.string' => 'Judul Penelitian harus berupa Kata',
            'ket_bta.required' => 'Keterangan harus diisi',
            'ket_bta.min' => 'Keterangan minimal 20 karakter',
            'ket_bta.max' => 'Keterangan maksimal 255 karakter',
            'ket_bta.string' => 'Keterangan harus berupa Kata',
            'jam_mulai_bta.required' => 'Jam Mulai harus diisi',
            'jam_mulai_bta.date_format' => 'Jam Mulai harus berformat jam:menit',
            'jam_selesai_bta.required' => 'Jam Selesai harus diisi',
            'jam_selesai_bta.date_format' => 'Jam Selesai harus berformat jam:menit',
            'jam_selesai_bta.after' => 'Jam Selesai harus lebih besar dari Jam Mulai'
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
