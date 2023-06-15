<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Laboratorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreActivityLab;

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
        $data = [
            'activities' => Laboratorium::all()
        ];
        return view('admin.admin_lab.lab.index', $data);
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

        $start = $request->input('start');
        $end = $request->input('end');
        if ($start != null && $end != null) {
            $results = DB::table('lokasi')
            ->select(
                'lokasi.nama_lokasi as lab',
                DB::raw("GROUP_CONCAT(subquery.jumlah_kegiatan ORDER BY subquery.hari SEPARATOR ',') as jumlah_aktivitas")
            )
            ->leftJoin(DB::raw('(SELECT id_lokasi, DAYOFWEEK(tanggal_kegiatan) as hari, COUNT(id) as jumlah_kegiatan FROM activity_lab GROUP BY id_lokasi, DAYOFWEEK(tanggal_kegiatan)) as subquery'), function ($join) {
                $join->on('lokasi.id', '=', 'subquery.id_lokasi');
            })
            ->whereBetween('activity_lab.tanggal_kegiatan', [$start, $end])
            ->groupBy('lokasi.nama_lokasi')
            ->get();
        } else {
            $results = DB::table('lokasi')
                ->select(
                    'lokasi.nama_lokasi as lab',
                    DB::raw("GROUP_CONCAT(subquery.jumlah_kegiatan ORDER BY subquery.hari SEPARATOR ',') as jumlah_aktivitas")
                )
                ->leftJoin(DB::raw('(SELECT id_lokasi, DAYOFWEEK(tanggal_kegiatan) as hari, COUNT(id) as jumlah_kegiatan FROM activity_lab GROUP BY id_lokasi, DAYOFWEEK(tanggal_kegiatan)) as subquery'), function ($join) {
                    $join->on('lokasi.id', '=', 'subquery.id_lokasi');
                })
                ->groupBy('lokasi.nama_lokasi')
                ->get();
        }
        $data = [];
        foreach ($results as $result) {
            $item = [];
            $item['lab'] = $result->lab;
            $jumlahAktivitas = explode(',', $result->jumlah_aktivitas);
            $item['jumlah_aktivitas'] = array_map('intval', $jumlahAktivitas);
            $data[] = $item;
        }
        return response()->json($data);
    }
}
