<?php

namespace App\Http\Controllers\tugas_akhir_dua;

use App\Http\Controllers\Controller;
use App\Models\ModelSeminarTaDua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ValidasiAdminTaDua extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seminar = ModelSeminarTaDua::where('status_admin', '!=', 'Valid')->get();
        return view('admin.admin_berkas.validasi.seminar.ta2.index', compact('seminar'));
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
        $mahasiswa = $seminar->mahasiswa;
        $data = [
            'mahasiswa' => $mahasiswa,
            'seminar' => $seminar,
        ];
        return view('admin.admin_berkas.validasi.seminar.ta2.edit', $data);
    }
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
            $seminar->updated_at = now();
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
            $seminar->updated_at = now();
            $seminar->save();
        }
        return redirect()->route('berkas.validasi.seminar.ta2.index')
            ->with('success', 'Berhasil Mengubah Data Seminar');
    }
}
