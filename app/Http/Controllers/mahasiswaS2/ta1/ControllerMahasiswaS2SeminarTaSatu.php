<?php

namespace App\Http\Controllers\mahasiswaS2\ta1;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ModelSeminarTaSatuS2;
use Illuminate\Support\Facades\Auth;
use App\Models\BerkasPersyaratanSeminar;

class ControllerMahasiswaS2SeminarTaSatu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $seminar = ModelSeminarTaSatuS2::where('id_mahasiswa', Auth::user()->mahasiswa->id)->first();
        if(!$seminar){
            return redirect()->route('mahasiswa.seminarta1s2.create');
        }
        return view("mahasiswaS2.ta1.index", compact('seminar'));
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
            'dosens' => Dosen::where('status', 'Aktif')->get(),
            'syarat' => BerkasPersyaratanSeminar::find(2),
        ];
        return view("mahasiswaS2.ta1.create", $data);
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
