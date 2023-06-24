<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\BerkasPersyaratanSeminar;

class BerkasPersyaratanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'files' => BerkasPersyaratanSeminar::select('encrypt_id', 'nama_file', 'path_file')->get()
        ];
        return view('admin.admin_berkas.berkas_persyaratan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.admin_berkas.berkas_persyaratan.create');
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
            'file' => BerkasPersyaratanSeminar::select('encrypt_id', 'nama_file', 'path_file')->where('id', Crypt::decrypt($id))->first()
        ];
        return view('admin.admin_berkas.berkas_persyaratan.edit', $data);
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
        $validation = $request->validate([
            'file_persyaratan' => 'required|mimes:pdf|max:2048'
        ], [
            'file_persyaratan.required' => 'File persyaratan seminar tidak boleh kosong',
            'file_persyaratan.mimes' => 'File persyaratan seminar harus berupa pdf',
            'file_persyaratan.max' => 'Ukuran file persyaratan seminar maksimal 1MB'
        ]);
        $file = $request->file('file_persyaratan');
        $nama_file = $file->hashName();
        $syarat = BerkasPersyaratanSeminar::find(Crypt::decrypt($id));
        $old_file = $syarat->path_file;
        $syarat->path_file = $nama_file;
        $syarat->updated_at = date('Y-m-d H:i:s');
        $syarat->save();
        $file->move(public_path('uploads/syarat_seminar'), $nama_file);
        if (file_exists(public_path('uploads/syarat_seminar/' . $old_file))) {
            unlink(public_path('uploads/syarat_seminar/' . $old_file));
        }
        return redirect()->route('berkas.berkas_persyaratan.index')->with('success', 'File persyaratan seminar berhasil diubah');
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
