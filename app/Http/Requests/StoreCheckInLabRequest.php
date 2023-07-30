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
            'ket' => 'required|min:20|max:255',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
        ];
    }
    public function messages()
    {
        return [
            'ket.required' => 'Keterangan harus diisi',
            'ket.min' => 'Keterangan minimal 20 karakter',
            'ket.max' => 'Keterangan maksimal 255 karakter',
            'jam_mulai.required' => 'Jam Mulai harus diisi',
            'jam_mulai.date_format' => 'Jam Mulai harus berformat jam:menit:detik',
            'jam_selesai.required' => 'Jam Selesai harus diisi',
        ];
    }

    protected function prepareForValidation()
    {
        $this->request->set('jam_selesai', date('H:i:s', strtotime($this->request->get('jam_selesai'))));
        $this->request->set('jam_mulai', date('H:i:s', strtotime($this->request->get('jam_mulai'))));
        $input = $this->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = strip_tags($value);
            }
        }
        $this->replace($input);
    }
}
