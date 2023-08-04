<?php

namespace App\Http\Controllers\Kajur;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\AktivitasMahasiswaS2;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AktivitasDataS2Controller extends Controller
{

    public function index(Request $request)
    {
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);

        if ($startDate && $endDate) {
            $data = AktivitasMahasiswaS2::with('mahasiswa')->whereBetween('tanggal', [$startDate, $endDate])->orderBy('tanggal', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()->editColumn('mahasiswa.nama_mahasiswa', function ($row) {
                    return $row->mahasiswa->nama_mahasiswa;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($row) {
                    return $row->mahasiswa->npm;
                })
                ->toJson();
        }  else if ($request->ajax()&& $startDate == null && $endDate == null) {
            $data = AktivitasMahasiswaS2::with('mahasiswa')->orderBy('tanggal', 'desc');
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
            $data = AktivitasMahasiswaS2::select('peran', DB::raw('count(*) as total'))
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->groupBy('peran')
                ->get();
            return response()->json($data);
        } else {
            $data = AktivitasMahasiswaS2::select('peran', DB::raw('count(*) as total'))
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
            $data = AktivitasMahasiswaS2::select(DB::raw('YEAR(tanggal) as year'), DB::raw('count(*) as total'))
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->groupBy('year')
                ->get();
            return response()->json($data);
        } else {
            $data = AktivitasMahasiswaS2::select(DB::raw('YEAR(tanggal) as year'), DB::raw('count(*) as total'))
                ->groupBy('year')
                ->get();
            return response()->json($data);
        }
    }
}
