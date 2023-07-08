<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryPangkatAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StorePangkatAdmin;

class PangkatAdminController extends Controller
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
        return view('admin.profile.pangkat_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePangkatAdmin $request)
    {
        //
        $file = $request->file('file_sk');
        $nama_file = $file->hashName();
        $data = [
            'pangkat' => $request->kepangkatan,
            'tgl_sk' => $request->tanggal_sk,
            'file_sk' => $nama_file,
            'administrasi_id' => Auth::user()->administrasi->id,
        ];
        $insert = HistoryPangkatAdmin::create($data);
        $id_insert = $insert->id;
        $update = HistoryPangkatAdmin::where('id', $id_insert)->update(['encrypt_id' => Crypt::encrypt($id_insert)]);
        $file->move(public_path('uploads/sk_pangkat_admin'), $nama_file);
        return redirect()->route('admin.profile.index')->with('success', 'Data berhasil ditambahkan');
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
        $pangkat = HistoryPangkatAdmin::find(Crypt::decrypt($id));

        return view('admin.profile.pangkat_edit', compact('pangkat'));
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
        //cek token 

        if ($request->_token != csrf_token()) {
            return redirect()->back();
        }

        $pangkat = HistoryPangkatAdmin::find(Crypt::decrypt($id));
        if ($pangkat->administrasi_id != Auth::user()->administrasi->id) {
            return redirect()->route('admin.profile.index')->with('error', 'Anda tidak memiliki akses');
        }
        if ($request->file('file_sk') != null) {
            $old_file = $pangkat->file_sk;
            unlink('uploads/sk_pangkat_admin/' . $old_file);
            $file = $request->file('file_sk');
            $nama_file = $file->hashName();
            $pangkat->file_sk = $nama_file;
            $file->move('uploads/sk_pangkat_admin', $nama_file);
        } else {
            $pangkat->pangkat = $request->kepangkatan;
            $pangkat->tgl_sk = $request->tanggal_sk;
        }
        $pangkat->save();

        return redirect()->route('admin.profile.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pangkat = HistoryPangkatAdmin::find(Crypt::decrypt($id));
        if ($pangkat->administrasi_id != Auth::user()->administrasi->id) {
            return redirect()->route('admin.profile.index')->with('error', 'Anda tidak memiliki akses');
        }
        $old_file = $pangkat->file_sk;
        unlink(public_path('uploads/sk_pangkat_admin/') . $old_file);
        $pangkat->delete();
        return redirect()->route('admin.profile.index')->with('success', 'Data berhasil dihapus');
    }
}
