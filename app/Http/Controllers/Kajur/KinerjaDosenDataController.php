<?php

namespace App\Http\Controllers\Kajur;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKinerjaDosen;
use App\Models\ModelKinerjaDosen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KinerjaDosenDataController extends Controller
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
        if ($request->ajax() && $startDate && $endDate) {
            $data = ModelKinerjaDosen::with('dosen')->where('tahun_akademik', $startDate)->where('semester', $endDate)->orderBy('tahun_akademik', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()->editColumn('dosen.nama_dosen', function ($data) {
                    return $data->dosen->nama_dosen;
                })
                ->toJson();
        } else if ($request->ajax() && $startDate == null && $endDate == null) {
            $data = ModelKinerjaDosen::with('dosen')->orderBy('tahun_akademik', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()->editColumn('dosen.nama_dosen', function ($data) {
                    return $data->dosen->nama_dosen;
                })->toJson();
        }

        return view('jurusan.kinerja_dosen.index');
    }


    public function chartAvarageKinerja(Request $request)
    {
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);

        $query = ModelKinerjaDosen::query();

        if ($startDate && $endDate) {
            $query->where('tahun_akademik', $startDate)
                ->where('semester', $endDate);
        }

        $data = [
            'sks_pendidikan_avg' => round($query->avg('sks_pendidikan')),
            'sks_pendidikan_median' => round($this->calculateMedianSKS('sks_pendidikan', $query)),
            'sks_pendidikan_max' => round($query->max('sks_pendidikan')),
            'sks_pendidikan_min' => round($query->min('sks_pendidikan')),

            'sks_penelitian_avg' => round($query->avg('sks_penelitian')),
            'sks_penelitian_median' => round($this->calculateMedianSKS('sks_penelitian', $query)),
            'sks_penelitian_max' => round($query->max('sks_penelitian')),
            'sks_penelitian_min' => round($query->min('sks_penelitian')),

            'sks_pengabdian_avg' => round($query->avg('sks_pengabdian')),
            'sks_pengabdian_median' => round($this->calculateMedianSKS('sks_pengabdian', $query)),
            'sks_pengabdian_max' => round($query->max('sks_pengabdian')),
            'sks_pengabdian_min' => round($query->min('sks_pengabdian')),

            'sks_penunjang_avg' => round($query->avg('sks_penunjang')),
            'sks_penunjang_median' => round($this->calculateMedianSKS('sks_penunjang', $query)),
            'sks_penunjang_max' => round($query->max('sks_penunjang')),
            'sks_penunjang_min' => round($query->min('sks_penunjang')),
        ];

        return response()->json($data);
    }

    private function calculateMedianSKS($column, $query)
    {
        $values = $query->pluck($column)->toArray();

        if (count($values) === 0) {
            return 0; // Handle jika tidak ada data
        }

        sort($values);
        $count = count($values);
        $middle = floor(($count - 1) / 2);

        if ($count % 2) {
            return $values[$middle];
        } else {
            return ($values[$middle] + $values[$middle + 1]) / 2;
        }
    }


    public function chartTotalKinerja(Request $request)
    {
        $starDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);

        $query = ModelKinerjaDosen::with('dosen');
        $highestTotalPenilaian = ModelKinerjaDosen::join('dosen', 'kinerja_dosen.dosen_id', '=', 'dosen.id')
            ->selectRaw('SUM(sks_pendidikan + sks_penelitian + sks_pengabdian + sks_penunjang) as total_penilaian')
            ->groupBy('dosen.id')
            ->orderByDesc('total_penilaian')
            ->value('total_penilaian');

        $lowestTotalPenilaian = ModelKinerjaDosen::join('dosen', 'kinerja_dosen.dosen_id', '=', 'dosen.id')
            ->selectRaw('SUM(sks_pendidikan + sks_penelitian + sks_pengabdian + sks_penunjang) as total_penilaian')
            ->groupBy('dosen.id')
            ->orderBy('total_penilaian')
            ->value('total_penilaian');
        if ($starDate && $endDate) {
            $query->where('tahun_akademik', $starDate)
                ->where('semester', $endDate);
            $highestTotalPenilaian = ModelKinerjaDosen::join('dosen', 'kinerja_dosen.dosen_id', '=', 'dosen.id')
                ->selectRaw('SUM(sks_pendidikan + sks_penelitian + sks_pengabdian + sks_penunjang) as total_penilaian')
                ->where('tahun_akademik', $starDate)
                ->where('semester', $endDate)->groupBy('dosen.id')
                ->orderByDesc('total_penilaian')
                ->value('total_penilaian');

            $lowestTotalPenilaian = ModelKinerjaDosen::join('dosen', 'kinerja_dosen.dosen_id', '=', 'dosen.id')
                ->selectRaw('SUM(sks_pendidikan + sks_penelitian + sks_pengabdian + sks_penunjang) as total_penilaian')
                ->where('tahun_akademik', $starDate)
                ->where('semester', $endDate)->groupBy('dosen.id')
                ->orderBy('total_penilaian')
                ->value('total_penilaian');
        }


        $data['total_avg'] = round($query->avg('sks_pendidikan') + $query->avg('sks_penelitian') + $query->avg('sks_pengabdian') + $query->avg('sks_penunjang'));
        $data['total_median'] = round($this->calculateMedian('sks_pendidikan', $query) + $this->calculateMedian('sks_penelitian', $query) + $this->calculateMedian('sks_pengabdian', $query) + $this->calculateMedian('sks_penunjang', $query));
        $data['total_max'] = round(
            $highestTotalPenilaian
        );

        $data['total_min'] = round($lowestTotalPenilaian);



        return response()->json($data);
    }

    protected function calculateMedian($column, $query)
    {
        $totalRows = $query->count();
        $middleRow = floor(($totalRows - 1) / 2);

        return $query->select($column)
            ->orderBy($column)
            ->limit(1)
            ->offset($middleRow)
            ->pluck($column)
            ->first();
    }
}
