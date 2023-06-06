<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HistoryJabatanDosen;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJabatanDosenRequest;
use Illuminate\Support\Facades\Crypt;

class JabatanController extends Controller
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
        return view('dosen.jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJabatanDosenRequest $request)
    {
        //
        $file = $request->file('file_sk_jabatan');
        $nama_file = Str::random() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/sk_jabatan_dosen'), $nama_file);
        $insertJabatan = HistoryJabatanDosen::create([
            'jabatan' => $request->jaban,
            'tgl_sk' => $request->tanggal_sk_jabatan,
            'file_sk' => $nama_file,
            'dosen_id' => auth()->user()->dosen->id,
        ]);
        $id = $insertJabatan->id;
        $update = HistoryJabatanDosen::find($id)->update([
            'encrypted_id' => Crypt::encrypt($id),
        ]);
        return redirect()->route('dosen.profile.index')->with('success', 'Jabatan berhasil ditambahkan');
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
        $jabatan = HistoryJabatanDosen::find(Crypt::decrypt($id));
        return view('dosen.jabatan.update', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $jabatan = HistoryJabatanDosen::find(Crypt::decrypt($id));
        $id_Dosen = auth()->user()->dosen->id;
        if($jabatan->dosen_id == $id_Dosen){

            //cek apakah ada file yang diupload
            $jabatan->jabatan = $request->jabatan;
            $jabatan->tgl_sk = $request->tanggal_sk;

            if($request->hasFile('file_sk')){
                unlink(public_path('uploads/sk_jabatan_dosen/' . $jabatan->file_sk));
                $file = $request->file('file_sk');
                $nama_file = Str::random() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/sk_jabatan_dosen'), $nama_file);
                $jabatan->file_sk = $nama_file;
            }
            $jabatan->updated_at = date('Y-m-d H:i:s');
            $jabatan->save();
            return redirect()->route('dosen.profile.index')->with('success', 'Jabatan berhasil diubah');

        }else{
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
    }
}
