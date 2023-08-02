<?php

namespace App\Http\Controllers\dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenghargaanDosenRequest;
use App\Models\ModelSPDosen;
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
            $data = ModelSPDosen::where('jenis', 'Penghargaan')->whereBetween('tahun', [$startDate, $endDate])->orderBy('tahun', 'desc');
            return DataTables::of($data)->toJson();
        } else if ($request->ajax() && $startDate == null && $endDate == null) {
            $data = ModelSPDosen::where('jenis', 'Penghargaan')->orderBy('tahun', 'desc');
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
        $insert = ModelSPDosen::create([
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'scala' => $request->scala,
            'uraian' => $request->uraian,
            'url' => $request->url,
            'jenis' => 'Penghargaan',
            'dosen_id' => auth()->user()->dosen->id,
        ]);
        ModelSPDosen::find($insert->id)->update([
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
                'penghargaan' => ModelSPDosen::findOrFail(Crypt::decrypt($id)),
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
            $penghargaan = ModelSPDosen::findOrFail(Crypt::decrypt($id));
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
            $penghargaan = ModelSPDosen::findOrFail(Crypt::decrypt($id));
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
            $penghargaan = ModelSPDosen::findOrFail(Crypt::decrypt($id));
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
            $Penghargaan = ModelSPDosen::select('scala', DB::raw('COUNT(*) as scala_count'))->where('jenis', 'Penghargaan')
                ->whereBetween('tahun', [$starDate, $endDate])->groupBy('scala')->get();
        } else {
            $Penghargaan = ModelSPDosen::select('scala', DB::raw('COUNT(*) as scala_count'))->where('jenis', 'Penghargaan')
                ->groupBy('scala')->get();
        }

        return response()->json($Penghargaan);
    }

    public function chartTahunPenghargaanDosen(Request $request)
    {
        $starDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($starDate && $endDate) {
            $tahun = ModelSPDosen::select(DB::raw('YEAR(tahun) as year'), DB::raw('COUNT(*) as total'))
                ->where('jenis', 'Penghargaan')
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
            $tahun = ModelSPDosen::select(DB::raw('YEAR(tahun) as year'), DB::raw('COUNT(*) as total'))
                ->where('jenis', 'Penghargaan')
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
