<?php

namespace App\Http\Controllers\alumni\s2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PendataanAlumniS2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->mahasiswa->pendataanAlumni) {
            $pendataan = Auth::user()->mahasiswa->pendataanAlumni;
            return view('mahasiswaS2.alumni.pendataan.index', compact('pendataan'));
        }
        return redirect()->route('mahasiswa.pendataan_alumni_S2.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->mahasiswa->pendataanAlumni) {
            return redirect()->route('mahasiswa.pendataan_alumni_S2.index');
        }
        return view('mahasiswaS2.alumni.pendataan.create');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('mahasiswaS2.alumni.pendataan.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('mahasiswaS2.alumni.pendataan.edit');
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
