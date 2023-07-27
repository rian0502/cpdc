<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrganisasiDosenRequest;
use App\Models\OrganisasiDosen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class OrganisasiController extends Controller
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
        return view('dosen.organisasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganisasiDosenRequest $request)
    {
        //
        $data = [
            'nama_organisasi' => $request->nama_organisasi,
            'tahun_menjabat' => $request->tahun_menjabat,
            'tahun_berakhir' => $request->tahun_berakhir,
            'jabatan' => $request->jabatan,
            'dosen_id' => Auth::user()->dosen->id,
        ];
        $organisasi = OrganisasiDosen::create($data);
        $id = $organisasi->id;
        $update = OrganisasiDosen::where('id', $id)->update(['encrypt_id' => Crypt::encrypt($id)]);
        if ($update) {
            return redirect()->route('dosen.profile.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('dosen.organisasi.create')->with('error', 'Data gagal disimpan');
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
            'organisasi' => OrganisasiDosen::find(Crypt::decrypt($id)),
        ];
        return view('dosen.organisasi.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganisasiDosenRequest $request, $id)
    {
        $data = [
            'nama_organisasi' => $request->nama_organisasi,
            'tahun_menjabat' => $request->tahun_menjabat,
            'tahun_berakhir' => $request->tahun_berakhir,
            'jabatan' => $request->jabatan,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $organisasi = OrganisasiDosen::find(Crypt::decrypt($id));
        if (Auth::user()->dosen->id == $organisasi['dosen_id']) {
            $update = OrganisasiDosen::where('id', Crypt::decrypt($id))->update($data);
            if ($update) {
                return redirect()->route('dosen.profile.index')->with('success', 'Data berhasil diubah');
            } else {
                return redirect()->route('dosen.organisasi.edit', $id)->with('error', 'Data gagal diubah');
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
        $organisasi = OrganisasiDosen::find(Crypt::decrypt($id));
        if($organisasi->dosen_id == Auth::user()->dosen->id){
            $organisasi->delete();
            return redirect()->route('dosen.profile.index')->with('success', 'Data berhasil dihapus');
        }
        else{
            return redirect()->route('dosen.profile.index')->with('error', 'Data gagal dihapus');
        }

    }
}
