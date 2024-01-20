<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreKinerjaDosen extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('dosen');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_akademik' => 'required',
            'sks_pendidikan' => 'required|numeric',
            'sks_penelitian' => 'required|numeric',
            'sks_pengabdian' => 'required|numeric',
            'sks_penunjang' => 'required|numeric',
        ];
    }
    
    public function messages()
    {
        return [
            'semester.required' => 'Semester harus diisi',
            'semester.in' => 'Semester harus diisi dengan Ganjil atau Genap',
            'tahun_akademik.required' => 'Tahun Akademik harus diisi',
            'sks_pendidikan.required' => 'SKS Pendidikan harus diisi',
            'sks_pendidikan.numeric' => 'SKS Pendidikan harus berupa angka',
            'sks_penelitian.required' => 'SKS Penelitian harus diisi',
            'sks_penelitian.numeric' => 'SKS Penelitian harus berupa angka',
            'sks_pengabdian.required' => 'SKS Pengabdian harus diisi',
            'sks_pengabdian.numeric' => 'SKS Pengabdian harus berupa angka',
            'sks_penunjang.required' => 'SKS Penunjang harus diisi',
            'sks_penunjang.numeric' => 'SKS Penunjang harus berupa angka',
        ];
    }
}
