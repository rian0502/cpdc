<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrestasiMahasiswaRequest;
use App\Http\Requests\UpdatePrestasiMahasiswaRequest;
use App\Models\PrestasiMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PrestasiMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'prestasi' => PrestasiMahasiswa::where('mahasiswa_id', Auth::user()->mahasiswa->id)->get(),
        ];
        return view('mahasiswa.profile.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('mahasiswa.prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrestasiMahasiswaRequest $request)
    {
        $file_prestasi = $request->file('file_prestasi');
        $nama_file = $file_prestasi->hashName();
        $data = [
            'nama_prestasi' => $request->nama_prestasi,
            'scala' => $request->scala,
            'capaian' => $request->capaian,
            'file_prestasi' => $nama_file,
            'mahasiswa_id' => Auth::user()->mahasiswa->id,
            'tanggal' => $request->tanggal,
        ];
        $insert_data = PrestasiMahasiswa::create($data);
        $id_insert = $insert_data->id;
        $file_prestasi->move('uploads/file_prestasi', $nama_file);
        $update = PrestasiMahasiswa::where('id', $id_insert)->update(['encrypt_id' => Crypt::encrypt($id_insert)]);
        if ($update) {
            return redirect()->route('mahasiswa.profile.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('mahasiswa.profile.index')->with('error', 'Data gagal ditambahkan');
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
        $prestasi = PrestasiMahasiswa::find(Crypt::decrypt($id));
        if ($prestasi->mahasiswa_id != Auth::user()->mahasiswa->id) {
            return redirect()->back();
        }

        return view('mahasiswa.prestasi.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\ResponseP
     */
    public function update(UpdatePrestasiMahasiswaRequest $request, $id)
    {
        //
        $prestasi = PrestasiMahasiswa::find(Crypt::decrypt($id));
        if ($prestasi->mahasiswa_id != Auth::user()->mahasiswa->id) {
            return redirect()->back();
        }
        if ($request->file('file_prestasi') != null) {
            $file_prestasi = $request->file('file_prestasi');
            $nama_file = $file_prestasi->hashName();
            $file_prestasi->move(public_path('uploads/file_prestasi'), $nama_file);
            $data = [
                'nama_prestasi' => $request->nama_prestasi,
                'scala' => $request->scala,
                'capaian' => $request->capaian,
                'file_prestasi' => $nama_file,
                'tanggal' => $request->tanggal,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if ($prestasi->file_prestasi != null) {
                unlink(public_path('uploads\file_prestasi\\' . $prestasi->file_prestasi));
            }
        } else {
            $data = [
                'nama_prestasi' => $request->nama_prestasi,
                'scala' => $request->scala,
                'capaian' => $request->capaian,
                'tanggal' => $request->tanggal,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        $update = PrestasiMahasiswa::where('id', Crypt::decrypt($id))->update($data);
        return redirect()->route('mahasiswa.profile.index')->with('success', 'Data Prestasi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prestasi = PrestasiMahasiswa::find(Crypt::decrypt($id));
        if ($prestasi->mahasiswa_id != Auth::user()->mahasiswa->id) {
            return redirect()->back();
        } else {
            if ($prestasi->file_prestasi != null) {
                unlink(public_path('uploads/file_prestasi/' . $prestasi->file_prestasi));
            }
            $prestasi->delete();
            return redirect()->route('mahasiswa.profile.index')->with('success', 'Data berhasil dihapus');
        }
    }
}
