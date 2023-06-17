<?php

namespace App\Http\Controllers\tugas_akhir_satu;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MahasiswaTaSatuController extends Controller
{
    public function index(){
        if (Auth::user()->mahasiswa->ta_satu()->count() > 0){
            return view('mahasiswa.ta1.index');
        }
        return redirect()->route('mahasiswa.seminar.tugas_akhir_1.create');
    }
    public function create(){
        $data = [
            'dosens' => Dosen::select('id', 'encrypt_id', 'nama_dosen')->get(),
        ];
        return view('mahasiswa.ta1.create', $data);
    }
    public function store(Request $request){
        return dd($request->all());
    }
}
