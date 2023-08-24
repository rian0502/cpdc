<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePendataanAlumniRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole(['mahasiswa', 'mahasiswaS2']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tahun_akademik' => 'required',
            'sks' => ['required', 'numeric', 'min:0'],
            'ipk' => ['required', 'numeric', 'min:1'],
            'tgl_lulus' => 'required|date',
            'masa_studi' => ['required', 'numeric', 'min:0'],
            'periode_wisuda' => 'required|string',
            'toefl' => ['required', 'numeric', 'min:0', 'max:677'],
            'berkas_pengesahan' => 'required|mimes:pdf|max:1048',
            'transkrip' => 'required|mimes:pdf|max:1048',
            'berkas_toefl' => 'required|mimes:pdf|max:1048',
        ];
    }
    public function messages()
    {
        return [
            'tahun_akademik.required' => 'Tahun Akademik tidak boleh kosong',
            'sks.required' => 'Jumlah SKS tidak boleh kosong',
            'sks.numeric' => 'Jumlah SKS harus berupa angka',
            'sks.min' => 'Jumlah SKS tidak boleh kurang dari 0',
            'ipk.required' => 'IPK tidak boleh kosong',
            'ipk.numeric' => 'IPK harus berupa angka',
            'ipk.min' => 'IPK tidak boleh kurang dari 1',
            'tgl_lulus.required' => 'Tanggal Lulus tidak boleh kosong',
            'tgl_lulus.date' => 'Tanggal Lulus harus berupa tanggal',
            'masa_studi.required' => 'Masa Studi tidak boleh kosong',
            'masa_studi.numeric' => 'Masa Studi harus berupa angka',
            'masa_studi.min' => 'Masa Studi tidak boleh kurang dari 0',
            'periode_wisuda.required' => 'Periode Wisuda tidak boleh kosong',
            'periode_wisuda.string' => 'Periode Wisuda harus berupa string',
            'toefl.required' => 'Nilai TOEFL tidak boleh kosong',
            'toefl.numeric' => 'Nilai TOEFL harus berupa angka',
            'toefl.min' => 'Nilai TOEFL tidak boleh kurang dari 0',
            'toefl.max' => 'Nilai TOEFL tidak boleh lebih dari 677',
            'berkas_pengesahan.required' => 'Berkas Pengesahan tidak boleh kosong',
            'berkas_pengesahan.mimes' => 'Berkas Pengesahan harus berupa file pdf',
            'berkas_pengesahan.max' => 'Berkas Pengesahan tidak boleh lebih dari 1MB',
            'transkrip.required' => 'Transkrip tidak boleh kosong',
            'transkrip.mimes' => 'Transkrip harus berupa file pdf',
            'transkrip.max' => 'Transkrip tidak boleh lebih dari 1MB',
            'berkas_toefl.required' => 'Berkas TOEFL tidak boleh kosong',
            'berkas_toefl.mimes' => 'Berkas TOEFL harus berupa file pdf',
            'berkas_toefl.max' => 'Berkas TOEFL tidak boleh lebih dari 1MB'
        ];
    }
}
