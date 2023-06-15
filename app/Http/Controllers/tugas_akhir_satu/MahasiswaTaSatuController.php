<?php

namespace App\Http\Controllers\tugas_akhir_satu;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class MahasiswaTaSatuController extends Controller
{
    public function index(){

        return view('tugas_akhir_satu.mahasiswa_ta_satu.index');
    }
}
