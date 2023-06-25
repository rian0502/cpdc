<?php

namespace App\Http\Controllers\Kajur;

use Illuminate\Http\Request;
use App\Models\LitabmasDosen;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LitabmasDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          //
          $startDate = $request->input('startDate', null);
          $endDate = $request->input('endDate', null);
          if ($startDate && $endDate) {
              $data = LitabmasDosen::whereBetween('tahun_penelitian', [$startDate, $endDate])->orderBy('tahun_penelitian', 'desc');
              return DataTables::of($data)->toJson();
          } else if ($request->ajax()&& $startDate == null && $endDate == null) {
              $data = LitabmasDosen::orderBy('tahun_penelitian', 'desc');
              return DataTables::of($data)->toJson();
          }
            return view('jurusan.litabmas.index');
    }


    public function pieChartKategoriLitabmas(Request $request){
        //get per capaian untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = LitabmasDosen::select('kategori', DB::raw('count(*) as total'))
            ->whereBetween('tahun_penelitian', [$startDate, $endDate])
            ->groupBy('kategori')
            ->get();
            return response()->json($data);
        }
        else{
            $data = LitabmasDosen::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
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
            $data = LitabmasDosen::select(DB::raw('tahun_penelitian as year'), DB::raw('count(*) as total'))
            ->whereBetween('tahun_penelitian', [$startDate, $endDate])
            ->groupBy('year')
            ->get();
            return response()->json($data);
        }
        else{
            $data = LitabmasDosen::select(DB::raw('tahun_penelitian as year'), DB::raw('count(*) as total'))
            ->groupBy('year')
            ->get();
            return response()->json($data);
        }

    }
}
