<?php

namespace App\Http\Controllers\mahasiswa_s2\ta1;

use App\Http\Controllers\Controller;
use App\Models\ModelBaSeminarTaSatuS2;
use App\Models\ModelSeminarTaSatuS2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ControllerKoorS2BaTaSatu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seminar = ModelSeminarTaSatuS2::with(['beritaAcara', 'mahasiswa'])
            ->whereHas('beritaAcara')
            ->where('status_koor', '!=', 'Selesai')
            ->get();
        return View('koorS2.tesis1.validasi_ba.index', compact('seminar'));
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
        $seminar = ModelSeminarTaSatuS2::with(['beritaAcara', 'mahasiswa'])
            ->whereHas('beritaAcara')
            ->where('id', Crypt::decrypt($id))
            ->first();
        return View('koorS2.tesis1.validasi_ba.edit', compact('seminar'));
    }

    public function update(Request $request, $id)
    {
        $seminar = ModelSeminarTaSatuS2::find(Crypt::decrypt($id));
        if ($request->_token != csrf_token()) {
            return redirect()->back();
        } else {
            if (
                $request->status_koor == 'Perbaikan' ||
                $request->status_koor == 'Tidak Lulus'
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
        return redirect()->route('koor.ValidasiBaTa1S2.index')
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
