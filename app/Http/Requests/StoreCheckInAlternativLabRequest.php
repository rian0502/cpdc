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
            'ket2' => 'required|min:20|max:255',
            'jam_mulai2' => 'required|date_format:H:i:s',
            'jam_selesai2' => 'required|date_format:H:i:s|after:jam_mulai',
        ];
    }
    public function messages()
    {
        return [
            'ket2.required' => 'Keterangan harus diisi',
            'ket2.min' => 'Keterangan minimal 20 karakter',
            'ket2.max' => 'Keterangan maksimal 255 karakter',
            'jam_mulai2.required' => 'Jam mulai harus diisi',
            'jam_mulai2.date_format' => 'Jam mulai tidak valid',
            'jam_selesai2.required' => 'Jam selesai harus diisi',
            'jam_selesai2.date_format' => 'Jam selesai tidak valid',
            'jam_selesai2.after' => 'Jam selesai harus setelah jam mulai',
        ];
    }
    public function prepareForValidation()
    {
        $this->request->set('jam_selesai2', date('H:i:s', strtotime($this->request->get('jam_selesai2'))));
        $this->request->set('jam_mulai2', date('H:i:s', strtotime($this->request->get('jam_mulai2'))));
        $input = $this->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = strip_tags($value);
            }
        }
        $this->replace($input);
    }
}
