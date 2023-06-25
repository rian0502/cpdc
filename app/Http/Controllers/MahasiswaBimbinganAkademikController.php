<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaBimbinganAkademikController extends Controller
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
            'mahasiswa' => Mahasiswa::select('id', 'nama_mahasiswa', 'npm','angkatan', 'id_dosen')->where('id_dosen', auth()->user()->dosen->first()->id)->get(),
        ];
        return view('dosen.mahasiswa.bimbingan.akademik.index',$data);
    }


    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        return view('dosen.mahasiswa.bimbingan.akademik.show', compact('mahasiswa'));
    }

 
}
