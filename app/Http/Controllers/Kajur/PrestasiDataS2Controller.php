<?php

namespace App\Http\Controllers\Kajur;


use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\PrestasiMahasiswaS2;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class PrestasiDataS2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //get all data prestasi mahasiswa dengan nama dan npm mahasiswa
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);

        if ($startDate && $endDate) {
            $data = PrestasiMahasiswaS2::with('mahasiswa')->whereBetween('tanggal', [$startDate, $endDate])->orderBy('tanggal', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()->editColumn('mahasiswa.nama_mahasiswa', function ($row) {
                    return $row->mahasiswa->nama_mahasiswa;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($row) {
                    return $row->mahasiswa->npm;
                })
                ->addIndexColumn()->editColumn('dosen.nama_dosen', function ($row) {
                    return $row->dosen->nama_dosen??$row->nama_pembimbing;
                })
                ->addIndexColumn()->editColumn('dosen.nip', function ($row) {
                    return $row->dosen->nip??$row->nip_pembimbing;
                })
                ->toJson();
        } else if ($request->ajax() && $startDate == null && $endDate == null) {
            $data = PrestasiMahasiswaS2::with('mahasiswa')->orderBy('tanggal', 'desc');

            return DataTables::of($data)
                ->addIndexColumn()->editColumn('mahasiswa.nama_mahasiswa', function ($row) {
                    return $row->mahasiswa->nama_mahasiswa;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($row) {
                    return $row->mahasiswa->npm;
                })
                ->addIndexColumn()->editColumn('dosen.nama_dosen', function ($row) {
                    return $row->dosen->nama_dosen??$row->nama_pembimbing;
                })
                ->addIndexColumn()->editColumn('dosen.nip', function ($row) {
                    return $row->dosen->nip??$row->nip_pembimbing;
                })
                ->toJson();

            // dd($data);
        }
        return view('jurusan.prestasi.index');
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
    public function pieChartCapaian(Request $request)
    {
        //get per capaian untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = PrestasiMahasiswaS2::select('capaian', DB::raw('count(*) as total'))
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->groupBy('capaian')
                ->get();
            return response()->json($data);
        } else {
            $data = PrestasiMahasiswaS2::select('capaian', DB::raw('count(*) as total'))
                ->groupBy('capaian')
                ->get();
            return response()->json($data);
        }
    }
    public function pieChartScala(Request $request)
    {
        //get per scala untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = PrestasiMahasiswaS2::select('scala', DB::raw('count(*) as total'))
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->groupBy('scala')
                ->get();
            return response()->json($data);
        } else {
            $data = PrestasiMahasiswaS2::select('scala', DB::raw('count(*) as total'))
                ->groupBy('scala')
                ->get();
            return response()->json($data);
        }
    }

    public function  barChartPrestasi(Request $request)
    {
        //get per scala untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        //prestasi pertahun
        if ($startDate && $endDate) {
            $data = PrestasiMahasiswaS2::select(DB::raw('YEAR(tanggal) as year'), DB::raw('count(*) as total'))
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->groupBy('year')
                ->get();
            return response()->json($data);
        } else {
            $data = PrestasiMahasiswaS2::select(DB::raw('YEAR(tanggal) as year'), DB::raw('count(*) as total'))
                ->groupBy('year')
                ->get();
            return response()->json($data);
        }
    }
}
