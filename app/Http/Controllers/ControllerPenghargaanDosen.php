<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenghargaanDosenRequest;
use App\Models\ModelPenghargaanDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ControllerPenghargaanDosen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StorePenghargaanDosenRequest $request)
    {
        //
        $insert = ModelPenghargaanDosen::create([
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'scala' => $request->scala,
            'uraian' => $request->uraian,
            'url' => $request->url,
            'dosen_id' => auth()->user()->dosen->id,
        ]);
        ModelPenghargaanDosen::find($insert->id)->update([
            'encrypt_id' => Crypt::encrypt($insert->id),
        ]);
        return redirect()->route('dosen.penghargaan.index')->with('success', 'Penghargaan berhasil ditambahkan');
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
        try {
            $data = [
                'penghargaan' => ModelPenghargaanDosen::findOrFail(Crypt::decrypt($id)),
            ];
            return view('dosen.penghargaan.show', $data);
        } catch (\Exception $e) {
            return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
        }
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
        try {


            $penghargaan = ModelPenghargaanDosen::findOrFail(Crypt::decrypt($id));
            if ($penghargaan->dosen_id != auth()->user()->dosen->id) {
                return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
            }
            $data = [
                'penghargaan' => $penghargaan,
            ];
            return view('dosen.penghargaan.show', $data);
        } catch (\Exception $e) {
            return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePenghargaanDosenRequest $request, $id)
    {
        //
        try {
            $penghargaan = ModelPenghargaanDosen::findOrFail(Crypt::decrypt($id));
            $penghargaan->update([
                'nama' => $request->nama,
                'tahun' => $request->tahun,
                'scala' => $request->scala,
                'uraian' => $request->uraian,
                'url' => $request->url,
            ]);
            return redirect()->route('dosen.penghargaan.index')->with('success', 'Penghargaan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
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
        try {
            $penghargaan = ModelPenghargaanDosen::findOrFail(Crypt::decrypt($id));
            if ($penghargaan->dosen_id != auth()->user()->dosen->id) {
                return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
            }
            $penghargaan->delete();
            return redirect()->route('dosen.penghargaan.index')->with('success', 'Penghargaan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('dosen.penghargaan.index')->with('error', 'Penghargaan tidak ditemukan');
        }
    }
}
