<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGelar;
use App\Models\ModelGelar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class GelarController extends Controller
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
return view('dosen.gelar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGelar $request)
    {
        //
        $data = [
            'instansi_pendidikan' => $request->instansi_pendidikan,
            'jurusan' => $request->jurusan,
            'tahun_lulus' => $request->tahun_lulus,
            'nama_gelar' => $request->nama_gelar,
            'singkatan_gelar' => $request->singkatan_gelar,
            'dosen_id' => Auth::user()->dosen->first()->id,
        ];
        $gelar = ModelGelar::create($data);
        $id = $gelar->id;
        $update = ModelGelar::where('id', $id)->update(['encrypt_id' => Crypt::encrypt($id)]);
        if ($update) {
            return redirect()->route('dosen.profile.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('dosen.gelar.create')->with('error', 'Data gagal disimpan');
        }
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
            'gelar' => ModelGelar::find(Crypt::decrypt($id)),
        ];
        return view('dosen.gelar.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGelar $request, $id)
    {
        //
        $data = [
            'instansi_pendidikan' => $request->instansi_pendidikan,
            'jurusan' => $request->jurusan,
            'tahun_lulus' => $request->tahun_lulus,
            'nama_gelar' => $request->nama_gelar,
            'singkatan_gelar' => $request->singkatan_gelar,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $gelar = ModelGelar::find(Crypt::decrypt($id));
        if (Auth::user()->dosen->first()->id == $gelar['dosen_id']) {
            $update = ModelGelar::where('id', Crypt::decrypt($id))->update($data);
            if ($update) {
                return redirect()->route('dosen.profile.index')->with('success', 'Data berhasil diubah');
            } else {
                return redirect()->route('dosen.gelar.edit', $id)->with('error', 'Data gagal diubah');
            }
        } else {
            return redirect()->route('dosen.profile.index')->with('error', 'Data gagal diubah');
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
        $gelar = ModelGelar::find(Crypt::decrypt($id));
        if ($gelar->dosen_id == Auth::user()->dosen->id){
            $gelar->delete();
            return redirect()->route('dosen.profile.index')->with('success', 'Data berhasil dihapus');
        }
        else{
            return redirect()->route('dosen.profile.index')->with('error', 'Data gagal dihapus');
        }
    }
}
