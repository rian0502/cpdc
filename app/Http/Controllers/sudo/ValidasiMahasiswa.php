<?php

namespace App\Http\Controllers\sudo;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ValidasiMahasiswa extends Controller
{
    //
    public function index()
    {
        $data = [
            'mahasiswa' => Mahasiswa::with('user')->where('status_register', 0)->get(),
        ];
        return view('sudo.validasi.index', $data);
    }
}
