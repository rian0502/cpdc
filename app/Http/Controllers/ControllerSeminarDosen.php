<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelSeminarDosen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreSeminarDosenRequest;

class ControllerSeminarDosen extends Controller
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
    public function store(StoreSeminarDosenRequest $request)
    {
        //
        $insert = ModelSeminarDosen::create([
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'scala' => $request->scala,
            'uraian' => $request->uraian,
            'url' => $request->url,
            'dosen_id' => Auth::user()->dosen->id,
        ]);
        ModelSeminarDosen::find($insert->id)->update([
            'encrypt_id' => Crypt::encrypt($insert->id),
        ]);
        return redirect()->route('dosen.seminar.index')->with('success', 'Seminar berhasil ditambahkan');
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
            $seminar = ModelSeminarDosen::findOrFail(Crypt::decrypt($id));
            return view('dosen.seminar.show', compact('seminar'));
        } catch (\Exception $e) {
            return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
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
            $seminar = ModelSeminarDosen::findOrFail(Crypt::decrypt($id));
            if ($seminar->dosen_id != Auth::user()->dosen->id) {
                return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
            }
            return view('dosen.seminar.show', compact('seminar'));
        } catch (\Exception $e) {
            return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSeminarDosenRequest $request, $id)
    {
        //
        try {
            $seminar = ModelSeminarDosen::findOrFail(Crypt::decrypt($id));
            if ($seminar->dosen_id != Auth::user()->dosen->id) {
                return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
            }
            $seminar->update([
                'nama' => $request->nama,
                'tahun' => $request->tahun,
                'scala' => $request->scala,
                'uraian' => $request->uraian,
                'url' => $request->url,
            ]);
            return redirect()->route('dosen.seminar.index')->with('success', 'Seminar berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
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
            $seminar = ModelSeminarDosen::findOrFail(Crypt::decrypt($id));
            if ($seminar->dosen_id != Auth::user()->dosen->id) {
                return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
            }
            $seminar->delete();
            return redirect()->route('dosen.seminar.index')->with('success', 'Seminar berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('dosen.seminar.index')->with('error', 'Data seminar tidak ditemukan');
        }
    }
}
