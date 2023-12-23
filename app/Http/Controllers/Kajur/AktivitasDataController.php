<?php

namespace App\Http\Controllers\Kajur;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\AktivitasMahasiswa;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AktivitasDataController extends Controller
{

    public function index(Request $request)
    {
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);

        if ($startDate && $endDate) {
            $data = AktivitasMahasiswa::with('mahasiswa')
                ->whereBetween('tanggal', [$startDate, $endDate])->orderBy('tanggal', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()->editColumn('mahasiswa.nama_mahasiswa', function ($row) {
                    return $row->mahasiswa->nama_mahasiswa;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($row) {
                    return $row->mahasiswa->npm;
                })
                ->toJson();
        } elseif ($request->ajax() && $startDate == null && $endDate == null) {
            $data = AktivitasMahasiswa::with('mahasiswa')->orderBy('tanggal', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()->editColumn('mahasiswa.nama_mahasiswa', function ($row) {
                    return $row->mahasiswa->nama_mahasiswa;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($row) {
                    return $row->mahasiswa->npm;
                })
                ->toJson();
        }
        return view('jurusan.aktivitas.index');
    }
    public function pieChartPeran(Request $request)
    {
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = AktivitasMahasiswa::select('peran', DB::raw('count(*) as total'))
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->groupBy('peran')
                ->get();
            return response()->json($data);
        } else {
            $data = AktivitasMahasiswa::select('peran', DB::raw('count(*) as total'))
                ->groupBy('peran')
                ->get();
            return response()->json($data);
        }
    }
    public function  barChartAktivitas(Request $request)
    {
        //get per scala untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        //prestasi pertahun
        if ($startDate && $endDate) {
            $data = AktivitasMahasiswa::select(DB::raw('YEAR(tanggal) as year'), DB::raw('count(*) as total'))
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->groupBy('year')
                ->get();
            return response()->json($data);
        } else {
            $data = AktivitasMahasiswa::select(DB::raw('YEAR(tanggal) as year'), DB::raw('count(*) as total'))
                ->groupBy('year')
                ->get();
            return response()->json($data);
        }
    }
}
