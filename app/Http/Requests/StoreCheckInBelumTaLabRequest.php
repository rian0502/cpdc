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
            'ket' => 'required|min:20|max:255|string',
            'nama_kegiatan' => 'required|min:5|max:255|string',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
        ];
    }
    public function messages()
    {
        return [
            'nama_kegiatan.required' => 'Judul Penelitian harus diisi',
            'nama_kegiatan.min' => 'Judul Penelitian minimal 5 karakter',
            'nama_kegiatan.max' => 'Judul Penelitian maksimal 255 karakter',
            'nama_kegiatan.string' => 'Judul Penelitian harus berupa Kata',
            'ket.required' => 'Keterangan harus diisi',
            'ket.min' => 'Keterangan minimal 20 karakter',
            'ket.max' => 'Keterangan maksimal 255 karakter',
            'ket.string' => 'Keterangan harus berupa Kata',
            'jam_mulai.required' => 'Jam Mulai harus diisi',
            'jam_mulai.date_format' => 'Jam Mulai harus berformat jam:menit:detik',
            'jam_selesai.required' => 'Jam Selesai harus diisi',
            'jam_selesai.date_format' => 'Jam Selesai harus berformat jam:menit:detik',
            'jam_selesai.after' => 'Jam Selesai harus lebih besar dari Jam Mulai'
        ];
    }
    public function prepareForValidation()
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
