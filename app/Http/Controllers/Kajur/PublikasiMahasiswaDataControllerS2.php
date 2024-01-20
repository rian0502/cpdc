<?php

namespace App\Http\Controllers\Kajur;


use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\ModelPublikasiMahasiswa;


class PublikasiMahasiswaDataControllerS2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
    {
        //get all data Publikasi mahasiswa dengan nama dan npm mahasiswa
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);

        $data = ModelPublikasiMahasiswa::with(['mahasiswa']);

        if ($request->ajax() && $startDate && $endDate) {
            $data = $data->whereBetween('tahun', [$startDate, $endDate])->orderBy('tahun', 'desc')
            ->whereHas(
                'mahasiswa.user.roles',
                function ($query) {
                    $query->where('name', 'mahasiswaS2');
                }
            )

            ;
            return DataTables::of($data)
                ->toJson();
        } elseif ($request->ajax() && $startDate == null && $endDate == null) {
            $data = $data->orderBy('tahun', 'desc')->whereHas(
                'mahasiswa.user.roles',
                function ($query) {
                    $query->where('name', 'mahasiswaS2');
                }
            );
            return DataTables::of($data)
                ->toJson();
        }


        return view('jurusan.publikasi_mahasiswa.index');
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
    public function pieChartPublikasi(Request $request)
    {
        //get per Publikasi untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = ModelPublikasiMahasiswa::with(['mahasiswa'])
            ->whereBetween('tahun', [$startDate, $endDate])
            ->whereHas(
                'mahasiswa.user.roles',
                function ($query) {
                    $query->where('name', 'mahasiswaS2');
                }
            )->select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')->get();
            return response()->json($data);
        } else {
            $data = ModelPublikasiMahasiswa::with(['mahasiswa'])
            ->whereHas(
                'mahasiswa.user.roles',
                function ($query) {
                    $query->where('name', 'mahasiswaS2');
                }
            )->select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')->get();
            return response()->json($data);
        }
    }
    public function pieChartScala(Request $request)
    {
        //get per scala untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = ModelPublikasiMahasiswa::with(['mahasiswa'])
            ->whereBetween('tahun', [$startDate, $endDate])
            ->whereHas(
                'mahasiswa.user.roles',
                function ($query) {
                    $query->where('name', 'mahasiswaS2');
                }
            )->select('scala', DB::raw('count(*) as total'))
            ->groupBy('scala')->get();
            return response()->json($data);
        } else {
            $data = ModelPublikasiMahasiswa::with(['mahasiswa'])
            ->whereHas(
                'mahasiswa.user.roles',
                function ($query) {
                    $query->where('name', 'mahasiswaS2');
                }
            )->select('scala', DB::raw('count(*) as total'))
            ->groupBy('scala')->get();
            return response()->json($data);
        }
    }

    public function  barChartPublikasi(Request $request)
    {
        //get per scala untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        //Publikasi pertahun
        if ($startDate && $endDate) {
            $data = ModelPublikasiMahasiswa::with(['mahasiswa'])
            ->whereBetween('tahun', [$startDate, $endDate])
            ->whereHas(
                'mahasiswa.user.roles',
                function ($query) {
                    $query->where('name', 'mahasiswaS2');
                }
            )
            ->select('tahun', DB::raw('count(*) as total'))->groupBy('tahun')->orderBy('tahun')->get();
            return response()->json($data);
        } else {
            $data = ModelPublikasiMahasiswa::with(['mahasiswa'])
            ->whereHas(
                'mahasiswa.user.roles',
                function ($query) {
                    $query->where('name', 'mahasiswaS2');
                }
            )
            ->select('tahun', DB::raw('count(*) as total'))->groupBy('tahun')->orderBy('tahun')->get();
            return response()->json($data);
        }
    }
}
