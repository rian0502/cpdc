<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\HistoryPangkatDosen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StorePangkatDosenRequest;
use App\Http\Requests\UpdatePangkatDosenRequest;

class PangkatDosenController extends Controller
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
        return view('pangkat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePangkatDosenRequest $request)
    {
        //
        $file_sk = $request->file('file_sk');
        $nama =  Str::random() . '.' . $file_sk->getClientOriginalExtension();
        $file_sk->move(public_path('uploads/sk_pangkat_dosen'), $nama);

        $insertPangkat = HistoryPangkatDosen::create([
            'kepangkatan' => $request->kepangkatan,
            'tgl_sk' => $request->tanggal_sk,
            'file_sk' => $nama,
            'dosen_id' => Auth::user()->dosen->id,
        ]);
        $id = $insertPangkat->id;
        $update = HistoryPangkatDosen::find($id);
        $update->encrypted_id = Crypt::encrypt($id);
        $update->save();

        return redirect()->route('dosen.profile.index')->with('success', 'Data Kepangkatan Berhasil disimpan');
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
        $pangkat = HistoryPangkatDosen::find(Crypt::decrypt($id));
        return view('pangkat.update', compact('pangkat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePangkatDosenRequest $request, $id)
    {
        $pangkat = HistoryPangkatDosen::find(Crypt::decrypt($id));
        $dosen_id = Auth::user()->dosen->id;
        if ($pangkat->dosen_id == $dosen_id) {
            $pangkat->kepangkatan = $request->kepangkatan;
            $pangkat->tgl_sk = $request->tgl_sk;
            if ($request->hasFile('file_sk')) {
                $path = public_path('uploads/sk_pangkat_dosen/' . $pangkat->file_sk);
                if (file_exists($path)) {
                    unlink($path);
                }
                $file_sk = $request->file('file_sk');
                $nama =  Str::random() . '.' . $file_sk->getClientOriginalExtension();
                $file_sk->move(public_path('uploads/sk_pangkat_dosen'), $nama);
                $pangkat->file_sk = $nama;
            }
            $pangkat->save();
            return redirect()->route('dosen.profile.index')->with('success', 'Data Kepangkatan Berhasil diubah');
        } else {
            return redirect()->route('dosen.profile.index')->with('error', 'Anda tidak memiliki akses untuk mengubah data ini');
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
        $pangkat = HistoryPangkatDosen::find(Crypt::decrypt($id));
        if ($pangkat->dosen_id == Auth::user()->dosen->id) {
            $path = ('uploads/sk_pangkat_dosen/' . $pangkat->file_sk);
            unlink($path);
            $pangkat->delete();
            return redirect()->route('dosen.profile.index')->with('success', 'Data Kepangkatan Berhasil dihapus');
        } else {
            return redirect()->route('dosen.profile.index')->with('error', 'Anda tidak memiliki akses untuk menghapus data ini');
        }
    }
}
