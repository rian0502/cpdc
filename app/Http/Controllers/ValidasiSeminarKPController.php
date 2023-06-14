<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelSeminarKP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ValidasiSeminarKPController extends Controller
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
            'seminar' => ModelSeminarKP::select('encrypt_id', 'proses_admin', 'mitra', 'id_mahasiswa')->where('proses_admin', '!=', 'Valid')->get()
        ];
        return view('admin.admin_berkas.validasi.seminar.kp.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.admin_berkas.validasi.seminar.kp.create');
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
        return view('admin.admin_berkas.validasi.seminar.kp.store');
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
            'seminar' => ModelSeminarKP::find(Crypt::decrypt($id)),
        ];
        return view('admin.admin_berkas.validasi.seminar.kp.edit', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'seminar' => ModelSeminarKP::find(Crypt::decrypt($id)),
        ];
        return view('admin.admin_berkas.validasi.seminar.kp.edit', $data);
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
        $seminar = ModelSeminarKP::find(Crypt::decrypt($id));
        $seminar->proses_admin = $request->proses_admin;
        if ($request->proses_admin != 'Valid'){
            if ($request->keterangan != null){
                return redirect()->back()->with('error', 'Keterangan harus diisi');
            }
            $seminar->keterangan = $request->keterangan;
        }else{
            $seminar->keterangan = '';
        }
        $seminar->updated_at = date('Y-m-d H:i:s');
        $seminar->save();
        return redirect()->route('berkas.validasi.seminar.kp.index')->with('success', 'Berhasil Mengubah data');
    }

}
