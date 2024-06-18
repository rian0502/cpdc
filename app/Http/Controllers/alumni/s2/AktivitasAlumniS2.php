<?php

namespace App\Http\Controllers\alumni\s2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AktivitasAlumniS2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mahasiswaS2.alumni.aktivitas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswaS2.alumni.aktivitas.create');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('mahasiswaS2.alumni.aktivitas.show');
    }


}
