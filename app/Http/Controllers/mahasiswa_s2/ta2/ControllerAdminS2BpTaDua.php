<?php

namespace App\Http\Controllers\mahasiswa_s2\ta2;

use Illuminate\Http\Request;
use App\Models\ModelSeminarTaDuaS2;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ControllerAdminS2BpTaDua extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'ta2' => ModelSeminarTaDuaS2::where('status_admin', '!=', 'Valid')->get()
        ];
        return view('admin.admin_berkas.validasi.seminarS2.ta2.index', $data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seminar = ModelSeminarTaDuaS2::find(Crypt::decrypt($id));
        $data = [
            'seminar' => $seminar,
            'mahasiswa' => $seminar->mahasiswa,
        ];
        return view('admin.admin_berkas.validasi.seminarS2.ta2.edit', $data);
    }
    public function update(Request $request, $id)
    {
        if ($request->status_admin == 'Invalid') {
            $request->validate([
                'komentar' => 'required|min:10|string|max:255'
            ], [
                'komentar.required' => 'Komentar harus diisi',
                'komentar.min' => 'Komentar minimal 10 karakter',
                'komentar.max' => 'Komentar maksimal 255 karakter'
            ]);
            $seminar = ModelSeminarTaDuaS2::find(Crypt::decrypt($id));
            $seminar->status_admin = $request->status_admin;
            $seminar->komentar = $request->komentar;
            $seminar->updated_at = date('Y-m-d H:i:s');
            $seminar->save();
        } else {
            $seminar = ModelSeminarTaDuaS2::find(Crypt::decrypt($id));
            $seminar->status_admin = $request->status_admin;
            $seminar->komentar = null;
            $seminar->updated_at = date('Y-m-d H:i:s');
            $seminar->save();
        }
        return redirect()->route('berkas.validasi.s2.tesis2.index')->with('success', 'Berhasil Mengubah data');
    }


}
