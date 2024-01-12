<?php

namespace App\Http\Controllers\komprehensif;

use App\Http\Controllers\Controller;
use App\Models\ModelSeminarKompre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AdminKompreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seminar = ModelSeminarKompre::where('status_admin', '!=', 'Valid')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('admin.admin_berkas.validasi.sidang.kompre.index', compact('seminar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $seminar = ModelSeminarKompre::find(Crypt::decrypt($id));
        $mahasisswa = $seminar->mahasiswa;
        $data = [
            'mahasiswa' => $mahasisswa,
            'seminar' => $seminar
        ];
        return view('admin.admin_berkas.validasi.sidang.kompre.edit', $data);
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
            return redirect()->back()->with('error', 'Status Admin Harus Valid atau Invalid');
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
            $seminar = ModelSeminarKompre::find(Crypt::decrypt($id));
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
            $seminar = ModelSeminarKompre::find(Crypt::decrypt($id));
            $seminar->status_admin = $request->status_admin;
            $seminar->komentar = null;
            $seminar->save();
        }
        return redirect()->route('berkas.validasi.sidang.kompre.index')
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
