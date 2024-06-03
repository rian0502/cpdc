<?php

namespace App\Http\Controllers\Kajur;

use App\Models\SyncHistory;
use Illuminate\Http\Request;
use App\Models\PublikasiDosen;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\AnggotaPublikasiDosen;
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

        $baseQuery = AnggotaPublikasiDosen::with('dosen', 'publikasi')->where('posisi','Ketua');

        if ($startDate && $endDate) {
            $data = $baseQuery->whereHas('publikasi', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tahun', [$startDate, $endDate]);
            })->with(['publikasi' => function($query) use ($startDate, $endDate) {
                $query->orderBy('tahun', 'desc');
            }])->get();
            return DataTables::of($data)
            ->addIndexColumn()->editColumn('nama_dosen', function ($row) {
                return $row->dosen ? $row->dosen->nama_dosen : '-';
            })
            ->addIndexColumn()->editColumn('judul', function ($row) {
                return $row->publikasi ? $row->publikasi->judul : '-';
            })
            ->addIndexColumn()->editColumn('nama_publikasi', function ($row) {
                return $row->publikasi ? $row->publikasi->nama_publikasi : '-';
            })
            ->addIndexColumn()->editColumn('kategori', function ($row) {
                return $row->publikasi ? $row->publikasi->kategori : '-';
            })
            ->addIndexColumn()->editColumn('scala', function ($row) {
                return $row->publikasi ? $row->publikasi->scala : '-';
            })
            ->addIndexColumn()->editColumn('kategori_litabmas', function ($row) {
                return $row->publikasi ? $row->publikasi->kategori_litabmas : '-';
            })
            ->addIndexColumn()->editColumn('jumlah_kutipan', function ($row) {
                return $row->publikasi ? $row->publikasi->jumlah_kutipan : '-';
            })
            ->addIndexColumn()->editColumn('tahun', function ($row) {
                return $row->publikasi ? $row->publikasi->tahun : '-';
            })
            ->addIndexColumn()->editColumn('encrypt_id_publikasi', function ($row) {
                return $row->publikasi ? $row->publikasi->encrypt_id : '-';
            })
            ->addIndexColumn()->editColumn('url', function ($row) {
                return $row->publikasi ? $row->publikasi->url : '-';
            })
            ->toJson();
        } else if ($request->ajax() && $startDate == null && $endDate == null) {
            $data = $baseQuery->with(['publikasi' => function($query) {
                $query->orderBy('tahun', 'desc');
            }])->get();

            return DataTables::of($data)
            ->addIndexColumn()->editColumn('nama_dosen', function ($row) {
                return $row->dosen ? $row->dosen->nama_dosen : '-';
            })
            ->addIndexColumn()->editColumn('judul', function ($row) {
                return $row->publikasi ? $row->publikasi->judul : '-';
            })
            ->addIndexColumn()->editColumn('nama_publikasi', function ($row) {
                return $row->publikasi ? $row->publikasi->nama_publikasi : '-';
            })
            ->addIndexColumn()->editColumn('kategori', function ($row) {
                return $row->publikasi ? $row->publikasi->kategori : '-';
            })
            ->addIndexColumn()->editColumn('scala', function ($row) {
                return $row->publikasi ? $row->publikasi->scala : '-';
            })
            ->addIndexColumn()->editColumn('kategori_litabmas', function ($row) {
                return $row->publikasi ? $row->publikasi->kategori_litabmas : '-';
            })
            ->addIndexColumn()->editColumn('jumlah_kutipan', function ($row) {
                return $row->publikasi ? $row->publikasi->jumlah_kutipan : '-';
            })
            ->addIndexColumn()->editColumn('tahun', function ($row) {
                return $row->publikasi ? $row->publikasi->tahun : '-';
            })
            ->addIndexColumn()->editColumn('encrypt_id_publikasi', function ($row) {
                return $row->publikasi ? $row->publikasi->encrypt_id : '-';
            })
            ->addIndexColumn()->editColumn('url', function ($row) {
                return $row->publikasi ? $row->publikasi->url : '-';
            })
            ->toJson();
        }

        //last sync
        $lastSync = SyncHistory::latest()->first();

        return view('jurusan.publikasi.index', compact('lastSync'));
    }


    public function pieChartScala(Request $request)
    {
        //get per scala untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = PublikasiDosen::select('scala', DB::raw('count(*) as total'))
                ->whereBetween('tahun', [$startDate, $endDate])
                ->groupBy('scala');
            return response()->json($data);
        } else {
            $data = PublikasiDosen::select('scala', DB::raw('count(*) as total'))
                ->groupBy('scala')
                ->get();
            return response()->json($data);
        }
    }
    public function pieChartKategori(Request $request)
    {
        //get per capaian untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = PublikasiDosen::select('kategori', DB::raw('count(*) as total'))
                ->whereBetween('tahun', [$startDate, $endDate])
                ->groupBy('kategori')
                ->get();
            return response()->json($data);
        } else {
            $data = PublikasiDosen::select('kategori', DB::raw('count(*) as total'))
                ->groupBy('kategori')
                ->get();
            return response()->json($data);
        }
    }
    public function pieChartKategoriLitabmas(Request $request)
    {
        //get per capaian untuk pie chart
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($startDate && $endDate) {
            $data = PublikasiDosen::select('kategori_litabmas', DB::raw('count(*) as total'))
                ->whereBetween('tahun', [$startDate, $endDate])
                ->groupBy('kategori_litabmas')
                ->get();
            return response()->json($data);
        } else {
            $data = PublikasiDosen::select('kategori_litabmas', DB::raw('count(*) as total'))
                ->groupBy('kategori_litabmas')
                ->get();
            return response()->json($data);
        }
    }
    public function  barChartTahun(Request $request)
    {
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
        } else {
            $data = PublikasiDosen::select(DB::raw('tahun as year'), DB::raw('count(*) as total'))
                ->groupBy('year')
                ->get();
            return response()->json($data);
        }
    }
}
