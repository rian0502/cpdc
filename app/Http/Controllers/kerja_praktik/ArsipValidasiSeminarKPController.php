<?php

namespace App\Http\Controllers\kerja_praktik;

use Illuminate\Http\Request;
use App\Models\ModelSeminarKP;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class ArsipValidasiSeminarKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        //
        if ($request->ajax()) {
            $seminar = ModelSeminarKP::query()->with('mahasiswa');
            return DataTables::of($seminar)
                ->addIndexColumn()->editColumn('mahasiswa.nama', function ($seminar) {
                    return $seminar->mahasiswa->nama;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($seminar) {
                    return $seminar->mahasiswa->npm;
                })->toJson();
        }

        return view('admin.admin_berkas.validasi.seminar.kp.arsip.index');
    }

    public function edit($id)
    {
        $data = [
            'seminar' => ModelSeminarKP::find(Crypt::decrypt($id)),
        ];
        return view('admin.admin_berkas.validasi.seminar.kp.arsip.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function Update(Request $request, $id)
    {
        $seminar = ModelSeminarKP::find(Crypt::decrypt($id));
        $seminar->proses_admin = $request->proses_admin;
        if ($request->proses_admin != 'Valid') {
            $this->validate($request, [
                'keterangan' => 'required'
            ],[
                'keterangan.required' => 'Berikan Pesan Jika Data Masih terdapat Kesalahan.'

            ]);

            $seminar->keterangan = $request->keterangan;
        } else {
            $seminar->keterangan = '';
        }
        $seminar->updated_at = date('Y-m-d H:i:s');
        $seminar->save();
        return redirect()->route('berkas.arsip_validasi.seminar.kp.index')->with('success', 'Berhasil Mengubah data');
    }
}
