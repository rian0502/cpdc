<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCheckInAlternativLabRequest extends FormRequest
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
            'ket_alternatif' => 'required|min:20|max:255',
            'jam_mulai_alternatif' => 'required|date_format:H:i',
            'jam_selesai_alternatif' => 'required|date_format:H:i|after:jam_mulai_alternatif',
        ];
    }
    public function messages()
    {
        return [
            'ket_alternatif.required' => 'Keterangan harus diisi',
            'ket_alternatif.min' => 'Keterangan minimal 20 karakter',
            'ket_alternatif.max' => 'Keterangan maksimal 255 karakter',
            'jam_mulai_alternatif.required' => 'Jam mulai harus diisi',
            'jam_mulai_alternatif.date_format' => 'Jam mulai tidak valid',
            'jam_selesai_alternatif.required' => 'Jam selesai harus diisi',
            'jam_selesai_alternatif.date_format' => 'Jam selesai tidak valid',
            'jam_selesai_alternatif.after' => 'Jam selesai harus lebih besar dari jam mulai',
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
