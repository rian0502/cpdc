<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class StoreCheckInLabRequest extends FormRequest
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
            'ket_per_ta' => 'required|min:20|max:255',
            'jam_mulai_per_ta' => 'required|date_format:H:i|before:jam_selesai_per_ta',
            'jam_selesai_per_ta' => 'required|date_format:H:i|after:jam_mulai_per_ta',
        ];
    }
    public function messages()
    {
        return [
            'ket_per_ta.required' => 'Keterangan harus diisi',
            'ket_per_ta.min' => 'Keterangan minimal 20 karakter',
            'ket_per_ta.max' => 'Keterangan maksimal 255 karakter',
            'jam_mulai_per_ta.required' => 'Jam Mulai harus diisi',
            'jam_mulai_per_ta.date_format' => 'Jam Mulai harus berformat jam:menit',
            'jam_mulai_per_ta.before' => 'Jam Mulai harus lebih kecil dari jam selesai',
            'jam_selesai_per_ta.required' => 'Jam Selesai harus diisi',
            'jam_selesai_per_ta.date_format' => 'Jam Selesai harus berformat jam:menit',
            'jam_selesai_per_ta.after' => 'Jam Selesai harus lebih besar dari Jam Mulai',
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
