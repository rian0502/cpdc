<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublikasiMahasiswa;
use App\Models\ModelPublikasiMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PublikasiMahasiswa;

class PublikasiMahasiswaController extends Controller
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
        //
        return view('mahasiswa.publikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublikasiMahasiswa $request)
    {
        $insert = ModelPublikasiMahasiswa::create(
            [
                'nama_publikasi' => $request->nama_publikasi,
                'judul' => $request->judul,
                'tahun' => $request->tahun,
                'vol' => $request->vol,
                'halaman' => $request->halaman,
                'scala' => $request->scala,
                'kategori' => $request->kategori,
                'url' => $request->url,
                'anggota' => $request->anggota,
                'mahasiswa_id' => Auth::user()->mahasiswa->id,
            ]
        );
        ModelPublikasiMahasiswa::find($insert->id)->update(
            [
                'encrypt_id' => Crypt::encrypt($insert->id)
            ]
        );
        return redirect()->route('mahasiswa.profile.index')
            ->with('success', 'Publikasi berhasil ditambahkan');
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
