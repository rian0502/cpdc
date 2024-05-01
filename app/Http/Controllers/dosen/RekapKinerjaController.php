<?php

namespace App\Http\Controllers\dosen;

use App\Models\Dosen;
use App\Models\ModelKinerjaDosen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreKinerjaDosen;

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
        $dosen = Dosen::findOrFail(Auth::user()->dosen->id);

        // Check if the combination already exists
        $existingRecord = ModelKinerjaDosen::where('dosen_id', $dosen->id)
            ->where('semester', $request->semester)
            ->where('tahun_akademik', $request->tahun_akademik)
            ->where('kategori', $request->kategori)
            ->first();

        if ($existingRecord) {
            // Combination already exists, return with validation error
            return redirect()->back()->withInput()->withErrors(['validation_error' => 'Data dengan periode dan jenis tersebut sudah ada']);
        }
        // Combination does not exist, create a new record
        $kinerja = ModelKinerjaDosen::create([
            'semester' => $request->semester,
            'kategori' => $request->kategori,
            'tahun_akademik' => $request->tahun_akademik,
            'sks_pendidikan' => $request->sks_pendidikan,
            'sks_penelitian' => $request->sks_penelitian,
            'sks_pengabdian' => $request->sks_pengabdian,
            'sks_penunjang' => $request->sks_penunjang,
            'dosen_id' => Auth::user()->dosen->id,
        ]);
        
        // Encrypt the ID and save
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
            $dosen = Dosen::findOrFail(Auth::user()->dosen->id);
            $existingRecord = ModelKinerjaDosen::where('dosen_id', $dosen->id)
            ->where('semester', $request->semester)
            ->where('tahun_akademik', $request->tahun_akademik)
            ->where('kategori', $request->kategori)
            ->where('id', '!=', Crypt::decrypt($id)) // Exclude the current record from the check
            ->first();


        if ($existingRecord) {
            // Combination already exists, return with validation error
            return redirect()->back()->withInput()->withErrors(['validation_error' => 'Data dengan periode dan jenis terse']);
        }
            $kinerja = ModelKinerjaDosen::findOrFail(Crypt::decrypt($id));
            if ($kinerja->dosen_id == Auth::user()->dosen->id) {
                $kinerja->semester = $request->semester;
                $kinerja->kategori = $request->kategori;
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
