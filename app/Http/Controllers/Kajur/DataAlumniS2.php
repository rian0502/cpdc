<?php

namespace App\Http\Controllers\Kajur;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class DataAlumniS2 extends Controller
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
                $query->where('name', 'mahasiswaS2');
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
}
