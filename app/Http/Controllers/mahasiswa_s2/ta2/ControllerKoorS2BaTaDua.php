<?php

namespace App\Http\Controllers\mahasiswa_s2\ta2;

use App\Http\Controllers\Controller;
use App\Models\ModelSeminarTaDuaS2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ControllerKoorS2BaTaDua extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berkas = ModelSeminarTaDuaS2::with(['beritaAcara', 'mahasiswa'])
            ->whereHas('beritaAcara')
            ->where('status_koor', '!=', 'Selesai')
            ->get();
        return View('koorS2.tesis2.validasi_ba.index', compact('berkas'));
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
        $seminar = ModelSeminarTaDuaS2::find(Crypt::decrypt($id));
        $data = [
            'seminar' => $seminar,
            'mahasiswa' => $seminar->mahasiswa,
        ];
        return View('koorS2.tesis2.validasi_ba.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $seminar = ModelSeminarTaDuaS2::find(Crypt::decrypt($id));
        if ($request->_token != csrf_token()) {
            return redirect()->back();
        } else {
            if (
                $request->status_koor == 'Perbaikan'
                || $request->status_koor == 'Tidak Lulus'
            ) {
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
        return redirect()->route('koor.ValidasiBaTa2S2.index')
            ->with('success', "Berita acara seminar berhasil diperbarui");
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
