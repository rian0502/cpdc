<?php

namespace App\Http\Controllers\mahasiswa;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckInAlternativLabRequest;
use App\Http\Requests\StoreCheckInBelumTaAlterLabRequest;
use App\Http\Requests\StoreCheckInBelumTaLabRequest;
use App\Http\Requests\StoreCheckInLabRequest;
use App\Models\Laboratorium;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

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
            'id_lokasi_bta' => 'required|exists:lokasi,encrypt_id',
        ], [
            'id_lokasi_bta.required' => 'Lokasi harus diisi',
            'id_lokasi_bta.exists' => 'Lokasi tidak ditemukan',
        ]);
        $data = [
            'nama_kegiatan' => Str::title($request->nama_kegiatan_bta),
            'id_lokasi' => Crypt::decrypt($request->id_lokasi_bta),
            'keperluan' => 'Penelitian',
            'tanggal_kegiatan' => date('Y-m-d'),
            'jam_mulai' => date('H:i:s', strtotime($request->jam_mulai_bta)),
            'jam_selesai' => date('H:i:s', strtotime($request->jam_selesai_bta)),
            'keterangan' => $request->ket_bta,
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
            'nama_kegiatan' => Str::title($request->nama_kegiatan_bt),
            'id_lokasi' => Auth::user()->lokasi_id,
            'keperluan' => 'Penelitian',
            'tanggal_kegiatan' => date('Y-m-d'),
            'jam_mulai' => date('H:i:s', strtotime($request->jam_mulai_bt)),
            'jam_selesai' => date('H:i:s', strtotime($request->jam_selesai_bt)),
            'keterangan' => $request->ket_bt,
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
        $mahasiswa = Auth::user()->mahasiswa;
        if ($mahasiswa->ta_satu) {
            $judul_kegiatan = $mahasiswa->ta_satu->judul_ta;
        }
        if ($mahasiswa->ta_dua) {
            $judul_kegiatan = $mahasiswa->ta_dua->judul_ta;
        }
        if ($mahasiswa->komprehensif) {
            $judul_kegiatan = $mahasiswa->komprehensif->judul_ta;
        }
        $lab = Laboratorium::create([
            'nama_kegiatan' => $judul_kegiatan,
            'id_lokasi' => $user->lokasi_id,
            'keperluan' => 'Penelitian',
            'tanggal_kegiatan' => date('Y-m-d'),
            'jam_mulai' => date('H:i:s', strtotime($request->jam_mulai_per_ta)),
            'jam_selesai' => date('H:i:s', strtotime($request->jam_selesai_per_ta)),
            'keterangan' => $request->ket_per_ta,
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
            'id_lokasi_alternatif' => 'required|exists:lokasi,encrypt_id',
        ], [
            'id_lokasi_alternatif.required' => 'Lokasi harus diisi',
            'id_lokasi_alternatif.exists' => 'Lokasi tidak ditemukan',
        ]);
        $mahasiswa = Auth::user()->mahasiswa;
        if ($mahasiswa->ta_satu) {
            $judul_kegiatan = $mahasiswa->ta_satu->judul_ta;
        }
        if ($mahasiswa->ta_dua) {
            $judul_kegiatan = $mahasiswa->ta_dua->judul_ta;
        }
        if ($mahasiswa->komprehensif) {
            $judul_kegiatan = $mahasiswa->komprehensif->judul_ta;
        }
        $lab = Laboratorium::create([
            'nama_kegiatan' => $judul_kegiatan,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi_alternatif),
            'keperluan' => 'Penelitian',
            'tanggal_kegiatan' => date('Y-m-d'),
            'jam_mulai' => date('H:i:s', strtotime($request->jam_mulai_alternatif)),
            'jam_selesai' => date('H:i:s', strtotime($request->jam_selesai_alternatif)),
            'keterangan' => $request->ket_alternatif,
            'jumlah_mahasiswa' => 1,
            'user_id' => Auth::user()->id,
        ]);
        $update = Laboratorium::find($lab->id);
        $update->encrypted_id = Crypt::encrypt($lab->id);
        $update->save();
        return redirect()->route('mahasiswa.lab.index')->with('success', 'Berhasil Check In Alternatif');
    }
}