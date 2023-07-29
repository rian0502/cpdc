<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreActivityLab extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('admin lab');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $perluan = ['Praktikum', 'Penelitian', 'Lainnya', 'Ujian', 'PKL', 'PKM', 'MBKM'];
        $validasi = [
            'tanggal_kegiatan' => 'required|date',
            'keperluan' => 'required|in:' . implode(',', $perluan),
            'nama_kegiatan' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
            'ket' => 'required|string|max:255',
            'jumlah_mahasiswa' => 'required|integer|min:1',
        ];
        if ($this->keperluan == 'Praktikum') {
            $validasi['anggota_asistensi'] = 'required|min:1|exists:mahasiswa,id';
        }
        return $validasi;
    }
    public function messages()
    {
        $message = [
            'tanggal_kegiatan.required' => 'Tanggal Kegiatan harus diisi',
            'tanggal_kegiatan.date' => 'Tanggal Kegiatan harus berupa tanggal',
            'keperluan.required' => 'Keperluan harus diisi',
            'keperluan.in' => 'Keperluan tidak valid',
            'nama_kegiatan.required' => 'Nama Kegiatan harus diisi',
            'nama_kegiatan.string' => 'Nama Kegiatan harus berupa Kata',
            'nama_kegiatan.max' => 'Nama Kegiatan maksimal 255 karakter',
            'jam_mulai.required' => 'Jam Mulai harus diisi',
            'jam_mulai.date_format' => 'Jam Mulai tidak valid',
            'jam_selesai.required' => 'Jam Selesai harus diisi',
            'jam_selesai.date_format' => 'Jam Selesai tidak valid',
            'jam_selesai.after' => 'Jam Selesai harus lebih besar dari Jam Mulai',
            'ket.required' => 'Keterangan harus diisi',
            'ket.string' => 'Keterangan harus berupa Kata',
            'ket.max' => 'Keterangan maksimal 255 karakter',
            'jumlah_mahasiswa.required' => 'Jumlah Peserta harus diisi',
            'jumlah_mahasiswa.integer' => 'Jumlah Peserta harus berupa angka',
            'jumlah_mahasiswa.min' => 'Jumlah Peserta minimal 1',

        ];
        if ($this->keperluan == 'Praktikum') {
            $message['anggota_asistensi.required'] = 'Anggota Asistensi harus diisi';
            $message['anggota_asistensi.min'] = 'Anggota Asistensi minimal 1';
            $message['anggota_asistensi.exists'] = 'Anggota Asistensi tidak valid';
        }
        return $message;
    }

    protected function prepareForValidation()
    {
        $this->request->set('jam_mulai', date('H:i:s', strtotime($this->request->get('jam_mulai'))));
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
