<?php

namespace App\Http\Controllers;


use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckInAlternativLabRequest;
use App\Http\Requests\StoreCheckInBelumTaAlterLabRequest;
use App\Http\Requests\StoreCheckInBelumTaLabRequest;
use App\Http\Requests\StoreCheckInLabRequest;
use App\Models\Laboratorium;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LabTAController extends Controller
{
    //
    public function index()
    {
        $data = [
            'user' => Auth::user(),
            'lokasi' => Lokasi::where('jenis_ruangan', 'Lab')->get(),
            'alternatif' => Lokasi::where('jenis_ruangan', 'Lab')->where('id', '!=', Auth::user()->lokasi_id)->get(),
            'absen' => Laboratorium::where('user_id', Auth::user()->id)->where('id_lokasi', Auth::user()->lokasi_id)
                ->where('tanggal_kegiatan', date('Y-m-d'))->first(),
            'absen_second' => Laboratorium::where('user_id', Auth::user()->id)->where('id_lokasi', '!=', Auth::user()->lokasi_id)
                ->where('tanggal_kegiatan', date('Y-m-d'))->first(),
        ];
        return view('mahasiswa.lab_ta.index', $data);
    }
    
    public function belumTaAlternativ(StoreCheckInBelumTaAlterLabRequest $request)
    {
        $request->validate([
            'id_lokasi2' => 'required|exists:lokasi,encrypt_id',
        ], [
            'id_lokasi2.required' => 'Lokasi harus diisi',
            'id_lokasi2.exists' => 'Lokasi tidak ditemukan',
        ]);
        $data = [
            'nama_kegiatan' => $request->nama_kegiatan2,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi2),
            'keperluan' => 'Penelitian',
            'tanggal_kegiatan' => date('Y-m-d'),
            'jam_mulai' => $request->jam_mulai2,
            'jam_selesai' => $request->jam_selesai2,
            'keterangan' => $request->ket2,
            'jumlah_mahasiswa' => 1,
            'user_id' => Auth::user()->id,
        ];
        $insert = Laboratorium::create($data);
        $update = Laboratorium::find($insert->id);
        $update->encrypted_id = Crypt::encrypt($insert->id);
        $update->save();
        return redirect()->route('mahasiswa.lab.index')->with('success', 'Berhasil Check In Alternatif');
    }


    public function belumTA(StoreCheckInBelumTaLabRequest $request)
    {

        $data = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'id_lokasi' => Auth::user()->lokasi_id,
            'keperluan' => 'Penelitian',
            'tanggal_kegiatan' => date('Y-m-d'),
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keterangan' => $request->ket,
            'jumlah_mahasiswa' => 1,
            'user_id' => Auth::user()->id,
        ];
        $insert = Laboratorium::create($data);
        $update = Laboratorium::find($insert->id);
        $update->encrypted_id = Crypt::encrypt($insert->id);
        $update->save();
        return redirect()->route('mahasiswa.lab.index')->with('success', 'Berhasil Check In');
    }

    public function perGroup(Request $request)
    {

        $request->validate([
            'lokasi_pergroup' => 'required|exists:lokasi,encrypt_id',
        ], [
            'lokasi_pergroup.required' => 'Lokasi harus diisi',
            'lokasi_pergroup.exists' => 'Lokasi tidak ditemukan',
        ]);
        $user = User::find(Auth::user()->id);
        $user->lokasi_id = Crypt::decrypt($request->lokasi_pergroup);
        $user->save();
        return redirect()->route('mahasiswa.lab.index')->with('success', 'Berhasil Mendaftar Per Group');
    }

    public function cekinStore(StoreCheckInLabRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $id_user = $user->id;
        $mahasiswa = Auth::user()->mahasiswa;
        if ($mahasiswa->ta_satu->first()) {
            $judul_kegiatan = $mahasiswa->ta_satu->first()->judul_ta;
        }
        if ($mahasiswa->ta_dua->first()) {
            $judul_kegiatan = $mahasiswa->ta_dua->first()->judul_ta;
        }
        if ($mahasiswa->komprehensif->first()) {
            $judul_kegiatan = $mahasiswa->komprehensif->first()->judul_ta;
        }
        $lab = Laboratorium::create([
            'nama_kegiatan' => $judul_kegiatan,
            'id_lokasi' => $user->lokasi_id,
            'keperluan' => 'Penelitian',
            'tanggal_kegiatan' => date('Y-m-d'),
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keterangan' => $request->ket,
            'jumlah_mahasiswa' => 1,
            'user_id' => Auth::user()->id,
        ]);
        $update = Laboratorium::find($lab->id);
        $update->encrypted_id = Crypt::encrypt($lab->id);
        $update->save();
        return redirect()->route('mahasiswa.lab.index')->with('success', 'Berhasil Check In');
    }
    public function alternatif(StoreCheckInAlternativLabRequest $request)
    {
        $request->validate([
            'id_lokasi2' => 'required|exists:lokasi,encrypt_id',
        ], [
            'id_lokasi2.required' => 'Lokasi harus diisi',
            'id_lokasi2.exists' => 'Lokasi tidak ditemukan',
        ]);
        $user = User::find(Auth::user()->id);
        $id_user = $user->id;
        $mahasiswa = Auth::user()->mahasiswa;
        if ($mahasiswa->ta_satu->first()) {
            $judul_kegiatan = $mahasiswa->ta_satu->first()->judul_ta;
        }
        if ($mahasiswa->ta_dua->first()) {
            $judul_kegiatan = $mahasiswa->ta_dua->first()->judul_ta;
        }
        if ($mahasiswa->komprehensif->first()) {
            $judul_kegiatan = $mahasiswa->komprehensif->first()->judul_ta;
        }
        $lab = Laboratorium::create([
            'nama_kegiatan' => $judul_kegiatan,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi2),
            'keperluan' => 'Penelitian',
            'tanggal_kegiatan' => date('Y-m-d'),
            'jam_mulai' => $request->jam_mulai2,
            'jam_selesai' => $request->jam_selesai2,
            'keterangan' => $request->ket2,
            'jumlah_mahasiswa' => 1,
            'user_id' => Auth::user()->id,
        ]);
        $update = Laboratorium::find($lab->id);
        $update->encrypted_id = Crypt::encrypt($lab->id);
        $update->save();
        return redirect()->route('mahasiswa.lab.index')->with('success', 'Berhasil Check In Alternatif');
    }
}
