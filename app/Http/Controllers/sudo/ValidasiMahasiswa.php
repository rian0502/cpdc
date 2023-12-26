<?php

namespace App\Http\Controllers\sudo;

use App\Http\Controllers\Controller;
use App\Models\BaseNPM;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ValidasiMahasiswa extends Controller
{
    //
    public function index()
    {
        $data = [
            'mahasiswa' => Mahasiswa::with('user')->where('status_register', 0)->get(),
        ];
        return view('sudo.validasi.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'mahasiswa' => Mahasiswa::with('user')->where('npm', $id)->first(),
        ];
        return view('sudo.validasi.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if ($request->status == 1) {
            $mahasiswa = Mahasiswa::find($id);
            $mahasiswa->status_register = 1;
            $file = $mahasiswa->berkas_upload;
            unlink('uploads/syarat/' . $file);
            $mahasiswa->save();
        } else {
            $mahasiswa = Mahasiswa::with('user')->where('id', $id)->first();
            $npm = $mahasiswa->npm;
            BaseNPM::where('npm', $npm)->update(['status' => 'nonaktif']);
            $file = $mahasiswa->berkas_upload;
            unlink('uploads/syarat/' . $file);
            $mahasiswa->user->delete();
            $mahasiswa->delete();
        }
        return redirect()->route('sudo.validasi.mahasiswa.index')->with('success', 'Data berhasil diubah');
    }
}
