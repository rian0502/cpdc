<?php

namespace App\Http\Controllers\tugas_akhir_dua;

use Illuminate\Http\Request;
use App\Models\ModelSeminarKP;
use App\Http\Controllers\Controller;
use App\Models\ModelBaSeminarTaDua;
use App\Models\ModelSeminarTaDua;
use Illuminate\Support\Facades\Crypt;

class ValidasiBaTaDua extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $berkas = ModelSeminarTaDua::with('ba_seminar')
            ->where('status_koor', '!=', 'Selesai')
            ->get();

        return view('koor.ta2.validasi_ba.index', compact('berkas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('koor.ta2.validasi_ba.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $seminar = ModelSeminarTaDua::find(Crypt::decrypt($id));
        return view('koor.ta2.validasi_ba.edit', compact('seminar'));
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
        if ($request->status_admin == 'Process') {
            return redirect()->back()->with(
                'error',
                'Status Admin Harus Valid atau Invalid'
            );
        } elseif ($request->status_admin == 'Invalid') {
            $status = ['Valid', 'Invalid', 'Process'];
            $request->validate(
                [
                    'status_admin' => ['required', 'string', 'in:' . implode(',', $status)],
                    'komentar' => ['required', 'string'],
                ],
                [
                    'status_admin.required' => 'Status Admin Harus Diisi',
                    'komentar.required' => 'Komentar Harus Diisi',
                    'status_admin.in' => 'Status Admin Harus Valid, Invalid, atau Process',
                    'komentar.string' => 'Komentar Harus Berupa Kata'
                ]
            );
            $seminar = ModelSeminarTaDua::find(Crypt::decrypt($id));
            $seminar->status_admin = $request->status_admin;
            $seminar->komentar = $request->komentar;
            $seminar->save();
        } else {
            $status = ['Valid', 'Invalid', 'Process'];
            $request->validate(
                [
                    'status_admin' => ['required', 'string', 'in:' . implode(',', $status)],
                ],
                [
                    'status_admin.required' => 'Status Admin Harus Diisi',
                    'status_admin.in' => 'Status Admin Harus Valid, Invalid, atau Process',
                ]
            );
            $seminar = ModelSeminarTaDua::find(Crypt::decrypt($id));
            $seminar->status_admin = $request->status_admin;
            $seminar->komentar = null;
            $seminar->save();
        }
        return redirect()->route('berkas.validasi.seminar.ta2.index')
            ->with('success', 'Berhasil Mengubah Data Seminar');
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
}
