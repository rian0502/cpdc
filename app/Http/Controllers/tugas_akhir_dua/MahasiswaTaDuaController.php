<?php

namespace App\Http\Controllers\tugas_akhir_dua;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\ModelSeminarTaDua;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class MahasiswaTaDuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->mahasiswa->ta_dua->count() > 0) {
            $data = [
                'seminar' => ModelSeminarTaDua::where('id_mahasiswa', Auth::user()->mahasiswa->id)->latest()->first(),
                'mahasiswa' => Auth::user()->mahasiswa,
            ];
            return view('mahasiswa.ta2.index', $data);
        } else {
            return redirect()->route('mahasiswa.seminar.tugas_akhir_2.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->mahasiswa->ta_satu->first() == null) {
            return redirect()->route('mahasiswa.seminar.tugas_akhir_1.index')->with('error', 'Anda belum dapat menyelesaikan tugas akhir 1');
        }
        
        if (Auth::user()->mahasiswa->ta_satu->first()->status_koor != 'Selesai') {
            return redirect()->route('mahasiswa.seminar.tugas_akhir_1.index')->with('error', 'Anda belum dapat menyelesaikan tugas akhir 1');
        }
        return view('mahasiswa.ta2.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'periode_seminar' => ['required'],
            'agreement' => ['required'],
            'berkas_seminar_ta_dua' => ['required', 'mimes:pdf', 'max:2048', 'file', 'mimetypes:application/pdf'],
        ], [
            'periode_seminar.required' => 'Periode seminar tidak boleh kosong',
            'agreement.required' => 'agreement harus di ceklis',
            'berkas_seminar_ta_dua.required' => 'Berkas seminar tidak boleh kosong',
            'berkas_seminar_ta_dua.mimes' => 'Berkas seminar harus berupa pdf',
            'berkas_seminar_ta_dua.max' => 'Berkas seminar maksimal 1MB',
        ]);
        $mahasiswa = Auth::user()->mahasiswa;
        $seminar = $mahasiswa->ta_satu->first();
        $file = $request->file('berkas_seminar_ta_dua');
        $name_file = $file->hashName();
        $file->move('uploads/syarat_seminar_ta2', $name_file);
        $ta2 = [
            'tahun_akademik' => $seminar->tahun_akademik,
            'semester' => $seminar->semester,
            'periode_seminar' => $request->periode_seminar,
            'judul_ta' => $seminar->judul_ta,
            'sks' => $seminar->sks,
            'ipk' => $seminar->ipk,
            'toefl' => $seminar->toefl,
            'berkas_ta_dua' => $name_file,
            'agreement' => 1,
            'id_pembimbing_satu' => $seminar->id_pembimbing_satu,
            'id_pembahas' => $seminar->id_pembahas,
            'id_mahasiswa' => $seminar->id_mahasiswa,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if ($seminar->id_pembimbing_dua != null) {
            $ta2['id_pembimbing_dua'] = $seminar->id_pembimbing_dua;
        } else {
            $ta2['pbl2_nama'] = $seminar->pbl2_nama;
            $ta2['pbl2_nip'] = $seminar->pbl2_nip;
        }
        $insert = ModelSeminarTaDua::create($ta2);
        $id = $insert->id;
        $update = ModelSeminarTaDua::find($id);
        $update->encrypt_id = Crypt::encrypt($id);
        $update->save();
        return redirect()->route('mahasiswa.seminar.tugas_akhir_2.index')->with('success', 'Berhasil mengajukan seminar tugas akhir 2');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('mahasiswa.ta2.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = [
            'dosens' => Dosen::select('encrypt_id', 'nama_dosen')->get(),
        ];
        return view('mahasiswa.ta2.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
