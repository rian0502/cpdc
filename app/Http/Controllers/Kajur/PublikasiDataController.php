<?php

namespace App\Http\Controllers\Kajur;

use Illuminate\Http\Request;
use App\Models\PublikasiDosen;
use App\Models\SyncHistory;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PublikasiDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $startDate = $request->input('startDate', null);
    $endDate = $request->input('endDate', null);

    if ($startDate && $endDate) {
        $data = PublikasiDosen::with('dosen')->whereBetween('tahun', [$startDate, $endDate])->orderBy('tahun', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_dosen', function ($row) {
                // Jika dosen tidak ada, kembalikan string kosong
                return optional($row->dosen)->nama_dosen ?? '';
            })
            ->toJson();
    } else if ($request->ajax() && $startDate == null && $endDate == null) {
        $data = PublikasiDosen::with('dosen')->orderBy('tahun', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_dosen', function ($row) {
                // Jika dosen tidak ada, kembalikan string kosong
                return optional($row->dosen)->nama_dosen ?? '';
            })
            ->toJson();
    }

    //last sync
    $lastSync = SyncHistory::latest()->first();

    return view('jurusan.publikasi.index', compact('lastSync'));
}


    public function pieChartScala(Request $request){
        //get per scala untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = PublikasiDosen::select('scala', DB::raw('count(*) as total'))
            ->whereBetween('tahun', [$startDate, $endDate])
            ->groupBy('scala');
            return response()->json($data);
        }
        else{
            $data = PublikasiDosen::select('scala', DB::raw('count(*) as total'))
            ->groupBy('scala')
            ->get();
            return response()->json($data);
        }

    }
    public function pieChartKategori(Request $request){
        //get per capaian untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = PublikasiDosen::select('kategori', DB::raw('count(*) as total'))
            ->whereBetween('tahun', [$startDate, $endDate])
            ->groupBy('kategori')
            ->get();
            return response()->json($data);
        }
        else{
            $data = PublikasiDosen::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->get();
            return response()->json($data);
        }

    }
    public function pieChartKategoriLitabmas(Request $request){
        //get per capaian untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = PublikasiDosen::select('kategori_litabmas', DB::raw('count(*) as total'))
            ->whereBetween('tahun', [$startDate, $endDate])
            ->groupBy('kategori_litabmas')
            ->get();
            return response()->json($data);
        }
        else{
            $data = PublikasiDosen::select('kategori_litabmas', DB::raw('count(*) as total'))
            ->groupBy('kategori_litabmas')
            ->get();
            return response()->json($data);
        }

    }
    public function  barChartTahun(Request $request){
        //get per scala untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        //prestasi pertahun
        if ($startDate && $endDate) {
            $data = PublikasiDosen::select(DB::raw('tahun as year'), DB::raw('count(*) as total'))
            ->whereBetween('tahun', [$startDate, $endDate])
            ->groupBy('year')
            ->get();
            return response()->json($data);
        }
        else{
            $data = PublikasiDosen::select(DB::raw('tahun as year'), DB::raw('count(*) as total'))
            ->groupBy('year')
            ->get();
            return response()->json($data);
        }

    }
}
