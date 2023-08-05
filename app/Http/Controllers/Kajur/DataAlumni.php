<?php

namespace App\Http\Controllers\Kajur;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class DataAlumni extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = User::role(['mahasiswa', 'alumni'])->with('mahasiswa', 'mahasiswa.kegiatanTerakhir', 'mahasiswa.pendataanAlumni');

            $data = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswa');
            })->whereHas('roles', function ($query) {
                $query->where('name', 'alumni');
            })->with('mahasiswa', 'mahasiswa.kegiatanTerakhir', 'mahasiswa.pendataanAlumni');

            return DataTables::of($data)
                ->addIndexColumn()->editColumn('mahasiswa.kegiatanTerakhir.jabatan', function ($data) {
                    return $data->mahasiswa->kegiatanTerakhir->jabatan;
                })
                ->addIndexColumn()->editColumn('mahasiswa.kegiatanTerakhir.tempat', function ($data) {
                    return $data->mahasiswa->kegiatanTerakhir->tempat;
                })
                ->addIndexColumn()->editColumn('mahasiswa.kegiatanTerakhir.status', function ($data) {
                    return $data->mahasiswa->kegiatanTerakhir->status;
                })
                ->addIndexColumn()->editColumn('mahasiswa.kegiatanTerakhir.tahun_masuk', function ($data) {
                    return $data->mahasiswa->kegiatanTerakhir->tahun_masuk;
                })
                ->addIndexColumn()->editColumn('mahasiswa.pendataanAlumni.masa_studi', function ($data) {
                    return $data->mahasiswa->pendataanAlumni->masa_studi;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($data) {
                    return $data->mahasiswa->npm;
                })->toJson();
        }
        $data = [
            'mahasiswa' => Mahasiswa::all(),
        ];
        return view('jurusan.data_alumni.index', $data);
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
        return view('jurusan.data_alumni.show');
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
