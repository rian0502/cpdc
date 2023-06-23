<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePenjadwalanSeminarTaSatu extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('ta1');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tanggal_seminar_ta_satu' => ['required', 'date', 'after_or_equal:tomorrow'],
            'jam_mulai_seminar_ta_satu' => ['required', 'date_format:H:i'],
            'jam_selesai_seminar_ta_satu' => ['required', 'date_format:H:i', 'after:jam_mulai_seminar_ta_satu'],
            'id_lokasi' => ['required', 'exists:lokasi,encrypt_id']
        ];
    }
    public function messages()
    {
        return [
            'tanggal_seminar_ta_satu.required' => 'Tanggal seminar harus diisi',
            'tanggal_seminar_ta_satu.date' => 'Tanggal seminar harus berupa tanggal',
            'tanggal_seminar_ta_satu.after_or_equal' => 'Tanggal seminar Minimal besok',
            'jam_mulai_seminar_ta_satu.required' => 'Jam mulai seminar harus diisi',
            'jam_mulai_seminar_ta_satu.date_format' => 'Jam mulai seminar harus berupa jam',
            'jam_selesai_seminar_ta_satu.required' => 'Jam selesai seminar harus diisi',
            'jam_selesai_seminar_ta_satu.date_format' => 'Jam selesai seminar harus berupa jam',
            'jam_selesai_seminar_ta_satu.after' => 'Jam selesai seminar harus setelah jam mulai seminar',
            'id_lokasi.required' => 'Lokasi seminar harus diisi',
            'id_lokasi.exists' => 'Lokasi seminar tidak valid',
        ];
    }
}
