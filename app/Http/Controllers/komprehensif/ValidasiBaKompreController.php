<?php

namespace App\Http\Controllers\komprehensif;

use Illuminate\Http\Request;
use App\Models\ModelSeminarKP;
use App\Http\Controllers\Controller;
use App\Models\ModelSeminarKompre;
use Illuminate\Support\Facades\Crypt;

class ValidasiBaKompreController extends Controller
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
        $data = [
            'berkas' => ModelSeminarKompre::with('beritaAcara')
                ->where('status_admin', 'Valid')
                ->where('status_koor', '!=', 'Selesai')
                ->orderBy('updated_at', 'desc')
                ->get(),
        ];
        return view('koor.kompre.validasi_ba.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('koor.kompre.validasi_ba.create');
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
        $data = [
            'seminar' => ModelSeminarKompre::find(Crypt::decrypt($id)),
        ];
        return view('koor.kompre.validasi_ba.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $seminar = ModelSeminarKompre::find(Crypt::decrypt($id));

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

            return redirect()->route('koor.validasiBaKompre.index')->with('success', 'Berhasil memvalidasi berita acara seminar');
        }
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
        return redirect()->back();
    }
}
