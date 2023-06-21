<?php

namespace App\Http\Controllers\tugas_akhir_satu;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeminarKP;
use App\Http\Requests\StoreTugasAkhirSatuRequest;
use App\Http\Requests\StoreTugasAkhirSatuStore;
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


        if($request->id_pembimbing_dua == 'new'){
            $validation = $request->validate([
                'pbl2_nama' => 'required|string|max:255|min:3',
                'pbl2_nip' => 'required|numeric|max:18|min:18',
            ],[
                'pbl2_nama.required' => 'Nama Dosen Pembimbing 2 tidak boleh kosong',
                'pbl2_nama.string' => 'Nama Dosen Pembimbing 2 harus berupa string',
                'pbl2_nama.max' => 'Nama Dosen Pembimbing 2 maksimal 255 karakter',
                'pbl2_nama.min' => 'Nama Dosen Pembimbing 2 minimal 3 karakter',
                'pbl2_nip.required' => 'NIP Dosen Pembimbing 2 tidak boleh kosong',
                'pbl2_nip.numeric' => 'NIP Dosen Pembimbing 2 harus berupa angka',
                'pbl2_nip.max' => 'NIP Dosen Pembimbing 2 maksimal 18 karakter',
                'pbl2_nip.min' => 'NIP Dosen Pembimbing 2 minimal 18 karakter',
            ]);

        }else{
            $validation = $request->validate([
                'id_pembimbing_dua' => 'required|exists:dosen,encrypt_id',
            ],[
                'id_pembimbing_dua.required' => 'Dosen Pembimbing 2 Harus dipilih',
                'id_pembimbing_dua.exists' => 'Dosen Pembimbing 2 tidak ditemukan',
            ]);


        }
    }
}
