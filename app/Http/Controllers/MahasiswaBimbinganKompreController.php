<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\ModelSeminarTaDua;
use App\Models\ModelSeminarKompre;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Routing\Controller;
use App\Models\ModelBaSeminarKompre;
use App\Models\ModelBaSeminarTaSatu;
use Illuminate\Support\Facades\Auth;

class MahasiswaBimbinganKompreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seminar = ModelSeminarTaSatu::where('id_pembimbing_satu', Auth::user()->dosen->id)->orWhere('id_pembimbing_dua', Auth::user()->dosen->id)->get();

        return view('dosen.mahasiswa.bimbingan.kompre.index', compact('seminar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        $seminarTa1 = ModelSeminarTaSatu::where('id_mahasiswa', $mahasiswa->id)->first();
        $seminarTa2 = ModelSeminarTaDua::where('id_mahasiswa', $mahasiswa->id)->first();

        $sidangKompre = ModelSeminarKompre::where('id_mahasiswa', $mahasiswa->id)->first();
        $BaTaSatu = ModelBaSeminarTaSatu::where('id_seminar', $seminarTa1->id)->first();
        $BaTaDua = ModelBaSeminarTaSatu::where('id_seminar', $seminarTa1->id)->first();

        $data = [
            'mahasiswa' => $mahasiswa,
            'seminarTa1' => $seminarTa1,
            'seminarTa2' => $seminarTa2,
            'sidangKompre' => $sidangKompre,
            'berita_acara' => $BaTaSatu,
            'ba_ta2' => $BaTaDua,
            'ta1' => $mahasiswa->ta_satu,
        ];
        return view('dosen.mahasiswa.bimbingan.kompre.show', $data);
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
