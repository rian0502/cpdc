<?php

namespace App\Http\Controllers\mahasiswa_s2\kompre;

use Illuminate\Http\Request;
use App\Models\ModelKompreS2;
use App\Models\ModelSeminarTaDuaS2;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class ControllerArsipAdminS2BpKompre extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        if ($request->ajax()) {
            $seminar = ModelKompreS2::query()->with('mahasiswa');
            return DataTables::of($seminar)
                ->addIndexColumn()->editColumn('mahasiswa.nama', function ($seminar) {
                    return $seminar->mahasiswa->nama;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($seminar) {
                    return $seminar->mahasiswa->npm;
                })->toJson();
        }
        return view('admin.admin_berkas.validasi.sidang.kompreS2.arsip.index');
    }

    public function edit($id)
    {
        $seminar = ModelKompreS2::find(Crypt::decrypt($id));
        $data = [
            'mahasiswa' => $seminar->mahasiswa,
            'seminar' => $seminar,
        ];
        return view('admin.admin_berkas.validasi.sidang.kompreS2.arsip.edit', $data);
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
        if ($request->status_admin == 'Invalid') {
            $request->validate([
                'komentar' => 'required|min:10|string|max:255'
            ], [
                'komentar.required' => 'Komentar harus diisi',
                'komentar.min' => 'Komentar minimal 10 karakter',
                'komentar.max' => 'Komentar maksimal 255 karakter'
            ]);
            $seminar = ModelKompreS2::find(Crypt::decrypt($id));
            $seminar->status_admin = $request->status_admin;
            $seminar->komentar = $request->komentar;
            $seminar->updated_at = date('Y-m-d H:i:s');
            $seminar->save();
        } else {
            $seminar = ModelKompreS2::find(Crypt::decrypt($id));
            $seminar->komentar = null;
            $seminar->status_admin = $request->status_admin;
            $seminar->updated_at = date('Y-m-d H:i:s');
            $seminar->save();
        }
        return redirect()->route('berkas.arsip_validasi.s2.tesis3.index')->with('success', 'Berhasil Mengubah data');
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
