<?php

namespace App\Http\Controllers;


use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $cek = Laboratorium::where('id_lokasi', Auth::user()->lokasi_id)->where('tanggal_kegiatan', date('Y-m-d'))->first();
        if (!$cek) {
            return redirect()->route('mahasiswa.lab.cekin');
        }
        $data = [
            'lab' => $cek,
            'user' => Auth::user(),
            'mahasiswa' => Auth::user()->mahasiswa,
        ];
        return view('mahasiswa.lab_ta.index', $data);
    }

    public function cekin()
    {
        $cek = Laboratorium::where('id_lokasi', Auth::user()->lokasi_id)->where('tanggal_kegiatan', date('Y-m-d'))->first();
        if ($cek) {
            return redirect()->route('mahasiswa.lab.index');
        }
        $data = [
            'lokasi' => Lokasi::where('jenis_ruangan', 'Lab')->get(),
            'user' => Auth::user(),
            'mahasiswa' => Auth::user()->mahasiswa,
        ];
        return view('mahasiswa.lab_ta.cekin', $data);
    }
    public function cekinStore(StoreCheckInLabRequest $request)
    {
        $user = User::find(Auth::user()->id);
        if($user->lokasi_id == null){
            $user->lokasi_id = $request->id_lokasi;
            $user->save();
        }
        $mahasiswa = Auth::user()->mahasiswa;
        if ($mahasiswa->ta_satu) {
            $judul_kegiatan = $mahasiswa->ta_satu->first()->judul_ta;
        }
        if ($mahasiswa->ta_dua) {
            $judul_kegiatan = $mahasiswa->ta_dua->first()->judul_ta;
        }
        if ($mahasiswa->komprehensif) {
            $judul_kegiatan = $mahasiswa->komprehensif->first()->judul_ta;
        }
        $lab = Laboratorium::create([
            'nama_kegiatan' => $judul_kegiatan,
            'id_lokasi' => $user->lokasi_id,
            'keperluan' => 'Penelitian',
            'tanggal_kegiatan' => date('Y-m-d'),
            'jam_mulai' => date('H:i:s'),
            'jam_selesai' => date('H:i:s', strtotime($request->jam_selesai)),
            'keterangan' => $request->ket,
            'jumlah_mahasiswa' => 1,
        ]);
        $update = Laboratorium::find($lab->id);
        $update->encrypted_id = Crypt::encrypt($lab->id);
        $update->save();
        return redirect()->route('mahasiswa.lab.index')->with('success', 'Berhasil Check In');
    }
}
