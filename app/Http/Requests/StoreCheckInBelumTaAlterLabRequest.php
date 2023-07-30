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
            'ket2' => 'required|min:20|max:255|string',
            'nama_kegiatan2' => 'required|min:5|max:255|string',
            'jam_mulai2' => 'required|date_format:H:i:s',
            'jam_selesai2' => 'required|date_format:H:i:s|after:jam_mulai',
        ];
    }
    public function messages()
    {
        return [
            'nama_kegiatan2.required' => 'Judul Penelitian harus diisi',
            'nama_kegiatan2.min' => 'Judul Penelitian minimal 5 karakter',
            'nama_kegiatan2.max' => 'Judul Penelitian maksimal 255 karakter',
            'nama_kegiatan2.string' => 'Judul Penelitian harus berupa Kata',
            'ket2.required' => 'Keterangan harus diisi',
            'ket2.min' => 'Keterangan minimal 20 karakter',
            'ket2.max' => 'Keterangan maksimal 255 karakter',
            'ket2.string' => 'Keterangan harus berupa Kata',
            'jam_mulai2.required' => 'Jam Mulai harus diisi',
            'jam_mulai2.date_format' => 'Jam Mulai harus berformat jam:menit:detik',
            'jam_selesai2.required' => 'Jam Selesai harus diisi',
            'jam_selesai2.date_format' => 'Jam Selesai harus berformat jam:menit:detik',
            'jam_selesai2.after' => 'Jam Selesai harus setelah Jam Mulai'
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
