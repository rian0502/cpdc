<?php

namespace App\Http\Controllers\dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKinerjaDosen;
use App\Models\ModelKinerjaDosen;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class RekapKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['kinerja'] = ModelKinerjaDosen::where('dosen_id', Auth::user()->dosen->id)->get();
        return view('dosen.kinerja.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dosen.kinerja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKinerjaDosen $request)
    {
        //
        $kinerja = ModelKinerjaDosen::create([
            'semester' => $request->semester,
            'tahun_akademik' => $request->tahun_akademik,
            'sks_pendidikan' => $request->sks_pendidikan,
            'sks_penelitian' => $request->sks_penelitian,
            'sks_pengabdian' => $request->sks_pengabdian,
            'sks_penunjang' => $request->sks_penunjang,
            'dosen_id' => Auth::user()->dosen->id,
        ]);
        $kinerja->encrypted_id = Crypt::encrypt($kinerja->id);
        $kinerja->save();
        return redirect()->route('dosen.kinerja.index')->with('success', 'Data Kinerja Dosen berhasil disimpan');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $kinerja = ModelKinerjaDosen::findOrFail(Crypt::decrypt($id));
            if ($kinerja->dosen_id == Auth::user()->dosen->id) {
                return view('dosen.kinerja.update', compact('kinerja'));
            } else {
                return redirect()->route('dosen.kinerja.index')->with('error', 'Data Kinerja Dosen tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->route('dosen.kinerja.index')->with('error', 'Data Kinerja Dosen tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreKinerjaDosen $request, $id)
    {
        //
        try {
            $kinerja = ModelKinerjaDosen::findOrFail(Crypt::decrypt($id));
            if ($kinerja->dosen_id == Auth::user()->dosen->id) {
                $kinerja->semester = $request->semester;
                $kinerja->tahun_akademik = $request->tahun_akademik;
                $kinerja->sks_pendidikan = $request->sks_pendidikan;
                $kinerja->sks_penelitian = $request->sks_penelitian;
                $kinerja->sks_pengabdian = $request->sks_pengabdian;
                $kinerja->sks_penunjang = $request->sks_penunjang;
                $kinerja->save();
                return redirect()->route('dosen.kinerja.index')->with('success', 'Data Kinerja Dosen berhasil diubah');
            } else {
                return redirect()->route('dosen.kinerja.index')->with('error', 'Data Kinerja Dosen tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->route('dosen.kinerja.index')->with('error', 'Data Kinerja Dosen tidak ditemukan');
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
            $kinerja = ModelKinerjaDosen::findOrFail(Crypt::decrypt($id));
            if ($kinerja->dosen_id == Auth::user()->dosen->id) {
                $kinerja->delete();
                return redirect()->route('dosen.kinerja.index')->with('success', 'Data Kinerja Dosen berhasil dihapus');
            } else {
                return redirect()->route('dosen.kinerja.index')->with('error', 'Data Kinerja Dosen tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->route('dosen.kinerja.index')->with('error', 'Data Kinerja Dosen tidak ditemukan');
        }
    }
}
