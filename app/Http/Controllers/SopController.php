<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\SopLab;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSopLabRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class SopController extends Controller
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
            'sop' => SopLab::where('id_lokasi', Auth::user()->lokasi_id)->get()
        ];
        return view('admin.admin_lab.sop.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'locations' => Auth::user()->lokasi,
        ];
        return view('admin.admin_lab.sop.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSopLabRequest $request)
    {
        $file_sop = $request->file('file_sop');
        $file_name = $file_sop->hashName();
        $file_sop->move('uploads/sop', $file_name);
        $data = [
            'nama_sop' => $request->nama_sop,
            'file_sop' => $file_name,
            'id_lokasi' => Auth::user()->lokasi_id,
        ];
        $insert = SopLab::create($data);
        $id = $insert->id;
        $update = SopLab::where('id', $id)->update([
            'encrypt_id' => encrypt($id),
        ]);
        if ($update) {
            return redirect()->route('lab.sop.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('lab.sop.index')->with('error', 'Data gagal ditambahkan');
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
            'sop' => SopLab::where('id', Crypt::decrypt($id))->first(),
            'locations' => Lokasi::all(),
        ];
        return view('admin.admin_lab.sop.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSopLabRequest $request, $id)
    {
        $id = Crypt::decrypt($id);
        $sop = SopLab::find($id);
        if (!$sop) {
            return redirect()->route('lab.sop.index')->with('error', 'Data tidak ditemukan');
        }
        $file_sop = $request->file('file_sop');
        if ($file_sop) {
            // Menghapus file lama
            if (File::exists(('uploads/sop/' . $sop->file_sop))) {
                File::delete(('uploads/sop/' . $sop->file_sop));
            }
            $file_name = Str::random(45) . '.' . $file_sop->getClientOriginalExtension();
            $file_sop->move('uploads/sop', $file_name);
            $sop->file_sop = $file_name;
        }
        $sop->updated_at = date('Y-m-d H:i:s');
        $sop->save();
        $update = SopLab::where('id', $id)->update([
            'encrypt_id' => encrypt($id),
            'updated_at' => now()
        ]);
        if ($update) {
            return redirect()->route('lab.sop.index')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->route('lab.sop.index')->with('error', 'Data gagal diupdate');
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
