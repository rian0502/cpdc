<?php

namespace App\Http\Controllers\tugas_akhir_satu;

use Illuminate\Http\Request;
use App\Models\ModelSeminarKP;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenjadwalanSeminarTaSatu;
use App\Models\Lokasi;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Support\Facades\Crypt;

class PenjadwalanTaSatu extends Controller
{
    //koor

    public function index()
    {
        $data = [
            'seminar' => ModelSeminarTaSatu::select('id', 'encrypt_id', 'judul_ta', 'periode_seminar', 'id_mahasiswa')->where('status_admin', '!=', 'Valid')->get(),
        ];
        return view('koor.ta1.jadwal.index', $data);
    }

    public function create(Request $request)
    {
        try {
            $id = array_key_last($request->except('_token'));

            $seminar =  ModelSeminarTaSatu::find(Crypt::decrypt($id));
            $data = [
                'locations' => Lokasi::all(),
                'seminar' => $seminar,
                'mahasiswa' => $seminar->mahasiswa,
            ];
            return view('koor.ta1.jadwal.create', $data);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function store(StorePenjadwalanSeminarTaSatu $request)
    {
        try{
            $id = Crypt::decrypt(array_key_last($request->except('_token')));

            
        }catch (\Exception $e){
            return redirect()->back();
        }
        

        return dd($request->all());
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
