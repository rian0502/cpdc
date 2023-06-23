<?php

namespace App\Http\Controllers\tugas_akhir_satu;

use Illuminate\Http\Request;
use App\Models\ModelSeminarKP;
use App\Http\Controllers\Controller;

class PenjadwalanTaSatu extends Controller
{
    //

    public function index()
    {
        $data = [
            'seminar' => ModelSeminarKP::select('id', 'encrypt_id', 'judul_kp', 'mitra', 'rencana_seminar', 'id_mahasiswa')->where('proses_admin', '=', 'Valid')->get()
        ];
        return view('koor.ta1.jadwal.index', $data);
    }

    public function create()
    
    {
        $data = [
            'seminar' => ModelSeminarKP::select('id', 'encrypt_id', 'judul_kp', 'mitra', 'rencana_seminar', 'id_mahasiswa')->where('proses_admin', '=', 'Valid')->get()
        ];
        return view('koor.ta1.jadwal.create', $data);
    }
    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $data = [
            'seminar' => ModelSeminarKP::select('id', 'encrypt_id', 'judul_kp', 'mitra', 'rencana_seminar', 'id_mahasiswa')->where('proses_admin', '=', 'Valid')->get()
        ];
        return view('koor.ta1.jadwal.create', $data);
    }
    public function update(Request $request, $id)
    {
    }
}
