<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityLab;
use App\Models\Laboratorium;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
    public function chartAktivitasLab()
    {
        $data = [
            [
                'lab' => 'Laboratorium A',
                'aktivitas' => [10, 12, 8, 15, 11, 9, 13]
            ],
            [
                'lab' => 'Laboratorium B',
                'aktivitas' => [8, 7, 9, 6, 10, 8, 11]
            ],
            [
                'lab' => 'Laboratorium C',
                'aktivitas' => [6, 9, 7, 5, 8, 10, 12]
            ],
            [
                'lab' => 'Laboratorium D',
                'aktivitas' => [12, 10, 11, 9, 13, 7, 9]
            ]
        ];
        return response()->json($data);
    }
}
