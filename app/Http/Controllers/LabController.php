<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Laboratorium;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreActivityLab;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data = [
        //     'activities' => Laboratorium::all()
        // ];
        return view('admin.admin_lab.lab.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'locations' => Lokasi::all()
        ];
        return view('admin.admin_lab.lab.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityLab $request)
    {
        //
        $data = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan' => $request->keperluan,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
            'keterangan' => $request->ket,
            'created_at' => now()
        ];
        $insert = Laboratorium::create($data);
        $id = Crypt::encrypt($insert->id);
        $update = Laboratorium::where('id', $insert->id)->update(['encrypted_id' => $id]);
        if ($update) {
            return redirect()->route('lab.ruang.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('lab.ruang.index')->with('error', 'Data gagal ditambahkan');
        }
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
        $data = [
            'lab' => Laboratorium::where('id', Crypt::decrypt($id))->first(),
        ];
        return view('admin.admin_lab.lab.show', $data);
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
    public function chartAktivitasLab(Request $request)
    {
        $start = $request->input('startDate', null);
        $end = $request->input('endDate', null);

        $query = DB::table('activity_lab')
            ->join('lokasi', 'activity_lab.id_lokasi', '=', 'lokasi.id')
            ->select(
                'lokasi.nama_lokasi as lab',
                DB::raw('DAYOFWEEK(activity_lab.tanggal_kegiatan) as hari'),
                DB::raw('COUNT(activity_lab.id) as jumlah_kegiatan')
            )
            ->whereNotNull('activity_lab.tanggal_kegiatan')
            ->groupBy('lokasi.nama_lokasi', 'hari');

        if ($start != null && $end != null) {
            $query->whereBetween('activity_lab.tanggal_kegiatan', [$start, $end]);
        }

        $results = $query->get();

        $data = [];
        $labs = [];

        foreach ($results as $result) {
            $lab = $result->lab;
            $dayOfWeek = $result->hari;
            $jumlahKegiatas = $result->jumlah_kegiatan;

            if (!isset($labs[$lab])) {
                $labs[$lab] = [];
            }

            $labs[$lab][$dayOfWeek] = $jumlahKegiatas;
        }

        foreach ($labs as $lab => $aktivitas) {
            $item = [];
            $item['lab'] = $lab;
            $jumlahAktivitas = [];

            for ($i = 1; $i <= 7; $i++) {
                if (isset($aktivitas[$i])) {
                    $jumlahAktivitas[] = $aktivitas[$i];
                } else {
                    $jumlahAktivitas[] = 0;
                }
            }

            $item['jumlah_aktivitas'] = $jumlahAktivitas;
            $data[] = $item;
        }

        // Tambahkan lab yang tidak memiliki aktivitas
        $allLabs = DB::table('lokasi')->pluck('nama_lokasi')->toArray();
        $labsWithActivities = array_column($data, 'lab');
        $labsWithoutActivities = array_diff($allLabs, $labsWithActivities);

        foreach ($labsWithoutActivities as $lab) {
            $item = [
                'lab' => $lab,
                'jumlah_aktivitas' => array_fill(0, 7, 0)
            ];
            $data[] = $item;
        }

        return response()->json($data);
    }

    public function dataLaboratorium(Request $request)
    {
        // if ($request->ajax()) {
            $model = Laboratorium::query();

            return DataTables::of($model)
                ->addColumn('nama_lokasi', function ($model) {
                    return $model->lokasi->nama_lokasi;
                })
                ->toJson();
        // }
    }
}
