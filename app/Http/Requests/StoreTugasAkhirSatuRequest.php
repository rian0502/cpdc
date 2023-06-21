<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTugasAkhirSatuRequest extends FormRequest
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
        $data = ['Ganjil', 'Genap'];
        
        return [
            'semester' => 'required|in:'.implode(',', $data),
            'sks' => 'required|numeric',
            'ipk' => 'required|numeric',
            'id_pembimbing_satu' => 'required|exists:dosen,encrypt_id',
            'pembahas' => 'required|exists:dosen,encrypt_id',
            'periode_seminar' => 'required|string',
            'toefl' => 'required|numeric',
            'judul_ta' => 'required|string|max:255|min:5',
            'agreement' => 'required',
            'berkas_seminar_pkl' => 'required|mimes:pdf|max:2048'
        ];
    }
    
}
