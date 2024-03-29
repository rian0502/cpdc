<?php

namespace App\Http\Controllers\dosen;

use App\Models\ModelSPDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreSeminarDosenRequest;

class ControllerSeminarDosen extends Controller
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
            $data = ModelSPDosen::with('dosen')->whereBetween('tanggal', [$startDate, $endDate])->orderBy('tanggal', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()->editColumn('dosen.nama', function ($data) {
                    return $data->dosen->nama_dosen ?? '-';
                })->toJson();
        } else if ($request->ajax() && $startDate == null && $endDate == null) {
            $data = ModelSPDosen::with('dosen')->orderBy('tanggal', 'desc');
            return DataTables::of($data)
            ->addIndexColumn()->editColumn('dosen.nama', function ($data) {
                return $data->dosen->nama_dosen ?? '-';
            })->toJson();
        }


        return view('dosen.seminar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dosen.seminar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeminarDosenRequest $request)
    {
        //
        $insert = ModelSPDosen::create([
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'scala' => $request->scala,
            'uraian' => $request->uraian,
            'url' => $request->url,
            'dosen_id' => Auth::user()->dosen->id,
        ]);
        ModelSPDosen::find($insert->id)->update([
            'encrypt_id' => Crypt::encrypt($insert->id),
        ]);
        return redirect()->route('dosen.seminar.index')->with('success', 'Seminar berhasil ditambahkan');
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
            $seminar = ModelSPDosen::findOrFail(Crypt::decrypt($id));
            return view('dosen.seminar.show', compact('seminar'));
        } catch (\Exception $e) {
            return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
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
            $seminar = ModelSPDosen::findOrFail(Crypt::decrypt($id));
            if ($seminar->dosen_id != Auth::user()->dosen->id) {
                return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
            }
            return view('dosen.seminar.show', compact('seminar'));
        } catch (\Exception $e) {
            return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSeminarDosenRequest $request, $id)
    {
        //
        try {
            $seminar = ModelSPDosen::findOrFail(Crypt::decrypt($id));
            if ($seminar->dosen_id != Auth::user()->dosen->id) {
                return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
            }
            $seminar->update([
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'scala' => $request->scala,
                'uraian' => $request->uraian,
                'url' => $request->url,
            ]);
            return redirect()->route('dosen.seminar.index')->with('success', 'Seminar berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
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
            $seminar = ModelSPDosen::findOrFail(Crypt::decrypt($id));
            if ($seminar->dosen_id != Auth::user()->dosen->id) {
                return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
            }
            $seminar->delete();
            return redirect()->route('dosen.seminar.index')->with('success', 'Seminar berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
        }
    }

    public function chartSeminarDosen(Request $request)
    {
        $starDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($starDate && $endDate) {
            $seminar = ModelSPDosen::select('scala', DB::raw('COUNT(*) as scala_count'))
                ->whereBetween('tanggal', [$starDate, $endDate])->groupBy('scala')->get();
        } else {
            $seminar = ModelSPDosen::select('scala', DB::raw('COUNT(*) as scala_count'))
                ->groupBy('scala')->get();
        }

        return response()->json($seminar);
    }

    public function chartTanggalSeminarDosen(Request $request)
    {
        $starDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        if ($starDate && $endDate) {
            $tanggal = ModelSPDosen::select(DB::raw('YEAR(tanggal) as year'), DB::raw('COUNT(*) as total'))
                ->whereBetween(DB::raw('tanggal'), [$starDate, $endDate])
                ->groupBy(DB::raw('YEAR(tanggal)'))
                ->get()
                ->map(function ($item) {
                    return [
                        'tanggal' => $item->year,
                        'total' => $item->total
                    ];
                })
                ->values()
                ->toArray();
        } else {
            $tanggal = ModelSPDosen::select(DB::raw('YEAR(tanggal) as year'), DB::raw('COUNT(*) as total'))
                ->groupBy(DB::raw('YEAR(tanggal)'))
                ->get()
                ->map(function ($item) {
                    return [
                        'tanggal' => $item->year,
                        'total' => $item->total
                    ];
                })
                ->values()
                ->toArray();
        }
        return response()->json($tanggal);
    }
}
