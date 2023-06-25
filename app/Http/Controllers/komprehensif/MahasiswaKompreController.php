<?php

namespace App\Http\Controllers\komprehensif;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\ModelSeminarTaSatu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class MahasiswaKompreController extends Controller
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
            'dosens' => Dosen::select('id', 'encrypt_id', 'nama_dosen')->get(),
            // 'seminar' => ModelSeminarTaSatu::find(Crypt::decrypt($id)),
        ];
        return view('mahasiswa.kompre.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'dosens' => Dosen::select('encrypt_id', 'nama_dosen')->get(),
        ];
        return view('mahasiswa.kompre.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return view('mahasiswa.kompre.detail');
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
        return view('mahasiswa.kompre.edit', $data);
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
