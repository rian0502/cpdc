<?php

namespace App\Http\Controllers\mahasiswa_s2\ta1;

use App\Http\Controllers\Controller;
use App\Models\ModelSeminarTaSatuS2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ControllerAdminS2BpTaSatu extends Controller
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
            'ta1' => ModelSeminarTaSatuS2::where('status_admin', '!=', 'Valid')->get()
        ];
        return view('admin.admin_berkas.validasi.seminarS2.ta1.index', $data);
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
        $seminar = ModelSeminarTaSatuS2::find(Crypt::decrypt($id));
        $data = [
            'seminar' => $seminar,
            'mahasiswa' => $seminar->mahasiswa,
        ];
        return view('admin.admin_berkas.validasi.seminarS2.ta1.edit', $data);
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
            $seminar = ModelSeminarTaSatuS2::find(Crypt::decrypt($id));
            $seminar->status_admin = $request->status_admin;
            $seminar->komentar = $request->komentar;
            $seminar->updated_at = date('Y-m-d H:i:s');
            $seminar->save();
        } else {
            $seminar = ModelSeminarTaSatuS2::find(Crypt::decrypt($id));
            $seminar->status_admin = $request->status_admin;
            $seminar->komentar = null;
            $seminar->updated_at = date('Y-m-d H:i:s');
            $seminar->save();
        }
        return redirect()->route('berkas.validasi.s2.tesis1.index')->with('success', 'Berhasil Mengubah data');
    }

}
