<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\ModelSeminarKP;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class MahasiswaBimbinganKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'kerja_praktik' => ModelSeminarKP::select('encrypt_id', 'judul_kp', 'mitra', 'tahun_akademik', 'id_dospemkp', 'id_mahasiswa')
                ->where('id_dospemkp', auth()->user()->dosen->id)->get(),
        ];
        return view('dosen.mahasiswa.bimbingan.kp.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dosen.mahasiswa.bimbingan.kp.create');
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
        //
        $data = [
            'mahasiswa' => Mahasiswa::find(Crypt::decrypt($id))
        ];
        return view('dosen.mahasiswa.bimbingan.kp.show', $data);
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
        return view('dosen.mahasiswa.bimbingan.kp.edit');
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
