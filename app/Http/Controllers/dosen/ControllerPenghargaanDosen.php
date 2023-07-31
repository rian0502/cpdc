<?php

namespace App\Http\Controllers\dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenghargaanDosenRequest;
use App\Models\ModelPenghargaanDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ControllerPenghargaanDosen extends Controller
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
            $data = ModelPenghargaanDosen::whereBetween('tahun', [$startDate, $endDate])->orderBy('tahun', 'desc');
            return DataTables::of($data)->toJson();
        } else if ($request->ajax() && $startDate == null && $endDate == null) {
            $data = ModelPenghargaanDosen::orderBy('tahun', 'desc');
            return DataTables::of($data)->toJson();
        }

        return view('dosen.penghargaan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dosen.penghargaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenghargaanDosenRequest $request)
    {
        //
        $insert = ModelPenghargaanDosen::create([
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'scala' => $request->scala,
            'uraian' => $request->uraian,
            'url' => $request->url,
            'dosen_id' => auth()->user()->dosen->id,
        ]);
        ModelPenghargaanDosen::find($insert->id)->update([
            'encrypt_id' => Crypt::encrypt($insert->id),
        ]);
        return redirect()->route('dosen.penghargaan.index')->with('success', 'Penghargaan berhasil ditambahkan');
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
        try {
            $data = [
                'penghargaan' => ModelPenghargaanDosen::findOrFail(Crypt::decrypt($id)),
            ];
            return view('dosen.penghargaan.show', $data);
        } catch (\Exception $e) {
            return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
        }
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
        try {
            $penghargaan = ModelPenghargaanDosen::findOrFail(Crypt::decrypt($id));
            if ($penghargaan->dosen_id != auth()->user()->dosen->id) {
                return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
            }
            $data = [
                'penghargaan' => $penghargaan,
            ];
            return view('dosen.penghargaan.edit', $data);
        } catch (\Exception $e) {
            return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePenghargaanDosenRequest $request, $id)
    {
        //
        try {
            $penghargaan = ModelPenghargaanDosen::findOrFail(Crypt::decrypt($id));
            $penghargaan->update([
                'nama' => $request->nama,
                'tahun' => $request->tahun,
                'scala' => $request->scala,
                'uraian' => $request->uraian,
                'url' => $request->url,
            ]);
            return redirect()->route('dosen.penghargaan.index')->with('success', 'Penghargaan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
        }
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
        try {
            $penghargaan = ModelPenghargaanDosen::findOrFail(Crypt::decrypt($id));
            if ($penghargaan->dosen_id != auth()->user()->dosen->id) {
                return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
            }
            $penghargaan->delete();
            return redirect()->route('dosen.penghargaan.index')->with('success', 'Penghargaan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
        }
    }
    public function chartPenghargaanDosen(Request $request)
    {
        $starDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($starDate && $endDate) {
            $Penghargaan = ModelPenghargaanDosen::select('scala', DB::raw('COUNT(*) as scala_count'))->whereBetween('tahun', [$starDate, $endDate])->groupBy('scala')->get();
        } else {
            $Penghargaan = ModelPenghargaanDosen::select('scala', DB::raw('COUNT(*) as scala_count'))->groupBy('scala')->get();
        }

        return response()->json($Penghargaan);
    }

    public function chartTahunPenghargaanDosen(Request $request)
    {
        $starDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($starDate && $endDate) {
            $tahun = ModelPenghargaanDosen::select(DB::raw('YEAR(tahun) as year'), DB::raw('COUNT(*) as total'))
                ->whereBetween(DB::raw('YEAR(tahun)'), [$starDate, $endDate])
                ->groupBy(DB::raw('YEAR(tahun)'))
                ->get()
                ->map(function ($item) {
                    return [
                        'tahun' => $item->year,
                        'total' => $item->total
                    ];
                })
                ->values()
                ->toArray();
        } else {
            $tahun = ModelPenghargaanDosen::select(DB::raw('YEAR(tahun) as year'), DB::raw('COUNT(*) as total'))
                ->groupBy(DB::raw('YEAR(tahun)'))
                ->get()
                ->map(function ($item) {
                    return [
                        'tahun' => $item->year,
                        'total' => $item->total
                    ];
                })
                ->values()
                ->toArray();
        }
        return response()->json($tahun);
    }
}
