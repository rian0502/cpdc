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
        $jam_mulai = date('H:i:s');
        if(Auth::user()->lokasi_id == null){
            return [

                'id_lokasi' => 'required|exists:lokasi,encrypt_id',
                'jam_selesai' => ['required','after:'.$jam_mulai],
                'ket' => 'required|min:20|max:255',
            ];
        }else{
            return [
                'jam_selesai' => ['required', 'date_format:H:i:s', 'after:'.$jam_mulai],
                'ket' => 'required|min:20|max:255',
            ];
        }
    }
    public function messages()
    {
        if(Auth::user()->lokasi_id == null){
            return [
                'id_lokasi.required' => 'Lokasi harus diisi',
                'id_lokasi.exists' => 'Lokasi tidak valid',
                'jam_selesai.required' => 'Jam Selesai harus diisi',
                'jam_selesai.after' => 'Jam Selesai harus lebih besar dari Jam Mulai',
                'ket.required' => 'Keterangan harus diisi',
                'ket.min' => 'Keterangan minimal 20 karakter',
                'ket.max' => 'Keterangan maksimal 255 karakter',
            ];
        }else{
            return [
                'jam_selesai.required' => 'Jam Selesai harus diisi',
                'jam_selesai.after' => 'Jam Selesai harus lebih besar dari Jam Mulai',
                'ket.required' => 'Keterangan harus diisi',
                'ket.min' => 'Keterangan minimal 20 karakter',
                'ket.max' => 'Keterangan maksimal 255 karakter'
            ];
        }
    }
    protected function prepareForValidation()
    {
        $this->request->set('jam_selesai', date('H:i:s', strtotime($this->request->get('jam_selesai'))));
        $input = $this->all();
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = strip_tags($value);
            }
        }
        $this->replace($input);
    }
}
