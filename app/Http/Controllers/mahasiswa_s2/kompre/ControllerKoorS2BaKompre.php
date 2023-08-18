<?php

namespace App\Http\Controllers\mahasiswa_s2\kompre;

use App\Http\Controllers\Controller;
use App\Models\ModelKompreS2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ControllerKoorS2BaKompre extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berkas = ModelKompreS2::with(['beritaAcara', 'mahasiswa'])
            ->whereHas('beritaAcara')
            ->where('status_koor', '!=', 'Selesai')
            ->get();
        return View('koorS2.sidang.validasi_ba.index', compact('berkas'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seminar = ModelKompreS2::with(['beritaAcara', 'mahasiswa'])
            ->whereHas('beritaAcara')
            ->where('id', Crypt::decrypt($id))
            ->first();
        return View('koorS2.sidang.validasi_ba.edit', compact('seminar'));
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
        $seminar = ModelKompreS2::find(Crypt::decrypt($id));
        if ($request->_token != csrf_token()) {
            return redirect()->back();
        } else {
            if ($request->status_koor == 'Perbaikan' || $request->status_koor == 'Tidak Lulus') {
                $validated = $request->validate([
                    'keterangan' => 'required|min:3|max:255',
                ], [
                    'keterangan.required' => 'Keterangan harus diisi',
                    'keterangan.min' => 'Keterangan minimal 3 karakter',
                    'keterangan.max' => 'Keterangan maksimal 255 karakter',
                ]);
                $seminar->status_koor = $request->status_koor;
                $seminar->komentar = $request->keterangan;
                $seminar->updated_at = date('Y-m-d H:i:s');
                $seminar->save();
            } else {
                $seminar->status_koor = $request->status_koor;
                $seminar->updated_at = date('Y-m-d H:i:s');
                $seminar->save();
            }
        }
        return redirect()->route('koor.ValidasiBaKompreS2.index')->with('success', 'Berhasil mengubah status berkas sidang komprehensif mahasiswa');
    }
}
