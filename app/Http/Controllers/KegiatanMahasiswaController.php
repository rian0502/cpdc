<?php

namespace App\Http\Controllers;

use COM;
use Illuminate\Http\Request;
use App\Models\AktivitasMahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreKegiatanMhsRequest;
use Exception;
use Illuminate\Support\Facades\File;

class KegiatanMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mahasiswa.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKegiatanMhsRequest $request)
{
        $id_mhs = Auth::user()->mahasiswa->id;
        $file = $request->file('file_aktivitas');
        $nama_file = $file->hashName();
        $data = [
            'nama_aktivitas' => $request->nama_aktivitas,
            'peran' => $request->peran,
            "sks_konversi" => $request->sks_konversi,
            "tanggal" => $request->tanggal,
            "file_aktivitas" => $nama_file,
            "mahasiswa_id" => $id_mhs,
        ];
        $insert_Data = AktivitasMahasiswa::create($data);
        $insert_id = $insert_Data->id;
        $updated = AktivitasMahasiswa::find($insert_id);
        $updated->encrypt_id = Crypt::encrypt($insert_id);
        $updated->save();
        $file->move(('uploads/file_act_mhs'), $nama_file);
        return redirect()->route('mahasiswa.profile.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $kegiatan = AktivitasMahasiswa::find(Crypt::decrypt($id));
            if ($kegiatan->mahasiswa_id != Auth::user()->mahasiswa->id) {
                return redirect()->back();
            }
            return view('mahasiswa.kegiatan.edit', compact('kegiatan'));
        } catch (Exception $e) {
            return redirect()->back();
        }
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
        $kegaitan = AktivitasMahasiswa::find(Crypt::decrypt($id));
        if($request->file('file_aktivitas') != null){
            $file = $request->file('file_aktivitas');
            $nama_file = $file->hashName();
            $file->move(('uploads/file_act_mhs'), $nama_file);
            if($kegaitan->file_aktivitas != null){
                File::delete(('uploads/file_act_mhs/'.$kegaitan->file_aktivitas));
            }
            $kegaitan->file_aktivitas = $nama_file;
        }
        $kegaitan->nama_aktivitas = $request->nama_aktivitas;
        $kegaitan->peran = $request->peran;
        $kegaitan->sks_konversi = $request->sks_konversi;
        $kegaitan->tanggal = $request->tanggal;
        $kegaitan->updated_at = date('Y-m-d H:i:s');
        $kegaitan->save();
        return redirect()->route('mahasiswa.profile.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aktivitas = AktivitasMahasiswa::find(Crypt::decrypt($id));
        if($aktivitas->mahasiswa_id != Auth::user()->mahasiswa->id){
            return redirect()->back();
        }
        if($aktivitas->file_aktivitas != null){
            File::delete(('uploads/file_act_mhs/'.$aktivitas->file_aktivitas));
        }
        $aktivitas->delete();
        return redirect()->route('mahasiswa.profile.index')->with('success', 'Data berhasil dihapus');
    }
}
