<?php

namespace App\Http\Controllers\mahasiswa_s2\ta1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBaTaSatuS2Request;
use App\Models\ModelBaSeminarTaDua;
use App\Models\ModelBaSeminarTaDuaS2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ControllerMahasiswaS2BaTaSatu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("mahasiswaS2.ta1.ba.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBaTaSatuS2Request $request)
    {
        $id_seminar = Auth::user()->mahasiswa->taSatuS2->id;
        $file_ba = $request->file('file_ba');
        $name_file_ba = $file_ba->hashName();
        $file_ba->move('uploads/ba_seminar_tesis_1', $name_file_ba);
        $file_nilai = $request->file('file_nilai');
        $name_file_nilai = $file_nilai->hashName();
        $file_nilai->move('uploads/nilai_seminar_tesis_1', $name_file_nilai);
        $insert = ModelBaSeminarTaDuaS2::create([
            'no_ba' => $request->no_ba,
            'nilai' => $request->nilai,
            'nilai_mutu' => $request->nilai_mutu,
            'ppt' => $request->ppt,
            'file_ba' => $name_file_ba,
            'file_nilai' => $name_file_nilai,
            'id_seminar' => $id_seminar
        ]);
        $insert_id = $insert->id;
        $update = ModelBaSeminarTaDuaS2::find($insert_id);
        $update->encrypt_id = Crypt::encrypt($insert_id);
        $update->save();
        return redirect()->route('mahasiswa.seminarta1s2.index')->with('status', 'Berhasil menambahkan berita acara seminar tesis 1');

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("mahasiswaS2.ta1.ba.edit");
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
