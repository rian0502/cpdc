<?php

namespace App\Http\Controllers\mahasiswa;

use App\Models\Dosen;
use Illuminate\Support\Str;
use App\Models\PrestasiMahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StorePrestasiMahasiswaRequest;
use App\Http\Requests\UpdatePrestasiMahasiswaRequest;

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
        $data = ['dosen' => Dosen::select('id', 'encrypt_id', 'nama_dosen')
            ->where('status', 'Aktif')->get()];
        return view('mahasiswa.prestasi.create', $data);
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
            'jenis' => $request->jenis,
            'tanggal' => $request->tanggal,
        ];
        if ($request->id_pembimbing == 'new') {
            $request->validate([
                'nama_pembimbing' => 'required|string|max:255|min:3',
                'nip_pembimbing' => 'required|numeric|digits:18',
            ], [
                'nama_pembimbing.required' => 'Nama Dosen Pembimbing tidak boleh kosong',
                'nama_pembimbing.string' => 'Nama Dosen Pembimbing harus berupa string',
                'nama_pembimbing.max' => 'Nama Dosen Pembimbing maksimal 255 karakter',
                'nama_pembimbing.min' => 'Nama Dosen Pembimbing minimal 3 karakter',
                'nip_pembimbing.required' => 'NIP Dosen Pembimbing tidak boleh kosong',
                'nip_pembimbing.numeric' => 'NIP Dosen Pembimbing harus berupa angka',
                'nip_pembimbing.digits' => 'NIP Dosen Pembimbing harus 18 digit',
            ]);
            $data['nama_pembimbing'] = Str::title($request->nama_pembimbing);
            $data['nip_pembimbing'] = $request->nip_pembimbing;
        } else{
            $request->validate([
                'id_pembimbing' => 'required|exists:dosen,id',
            ], [
                'id_pembimbing.required' => 'Dosen Pembimbing tidak boleh kosong',
                'id_pembimbing.exists' => 'Dosen Pembimbing tidak ditemukan',
            ]);
            $data['id_pembimbing'] = $request->id_pembimbing;
        }

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
        $dosen = Dosen::select('id', 'encrypt_id', 'nama_dosen')
            ->where('status', 'Aktif')->get();
        if ($prestasi->mahasiswa_id != Auth::user()->mahasiswa->id) {
            return redirect()->back();
        }

        return view('mahasiswa.prestasi.edit', compact('prestasi', 'dosen'));
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
            $file_prestasi->move(('uploads/file_prestasi'), $nama_file);
            $data = [
                'nama_prestasi' => $request->nama_prestasi,
                'scala' => $request->scala,
                'capaian' => $request->capaian,
                'file_prestasi' => $nama_file,
                'tanggal' => $request->tanggal,
                'jenis'=>$request->jenis,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if ($request->id_pembimbing == 'new') {
                $request->validate([
                    'nama_pembimbing' => 'required|string|max:255|min:3',
                    'nip_pembimbing' => 'required|numeric|digits:18',
                ], [
                    'nama_pembimbing.required' => 'Nama Dosen Pembimbing tidak boleh kosong',
                    'nama_pembimbing.string' => 'Nama Dosen Pembimbing harus berupa string',
                    'nama_pembimbing.max' => 'Nama Dosen Pembimbing maksimal 255 karakter',
                    'nama_pembimbing.min' => 'Nama Dosen Pembimbing minimal 3 karakter',
                    'nip_pembimbing.required' => 'NIP Dosen Pembimbing tidak boleh kosong',
                    'nip_pembimbing.numeric' => 'NIP Dosen Pembimbing harus berupa angka',
                    'nip_pembimbing.digits' => 'NIP Dosen Pembimbing harus 18 digit',
                ]);
                $data['nama_pembimbing'] = Str::title($request->nama_pembimbing);
                $data['nip_pembimbing'] = $request->nip_pembimbing;
                $data['id_pembimbing'] = null;
            } else{
                $request->validate([
                    'id_pembimbing' => 'required|exists:dosen,id',
                ], [
                    'id_pembimbing.required' => 'Dosen Pembimbing tidak boleh kosong',
                    'id_pembimbing.exists' => 'Dosen Pembimbing tidak ditemukan',
                ]);
                $data['nama_pembimbing'] = null;
                $data['nip_pembimbing'] = null;
                $data['id_pembimbing'] = $request->id_pembimbing;
            }
            if ($prestasi->file_prestasi != null) {
                unlink(('uploads/file_prestasi/' . $prestasi->file_prestasi));
            }
        } else {
            $data = [
                'nama_prestasi' => $request->nama_prestasi,
                'scala' => $request->scala,
                'capaian' => $request->capaian,
                'tanggal' => $request->tanggal,
                'jenis'=>$request->jenis,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if ($request->id_pembimbing == 'new') {
                $request->validate([
                    'nama_pembimbing' => 'required|string|max:255|min:3',
                    'nip_pembimbing' => 'required|numeric|digits:18',
                ], [
                    'nama_pembimbing.required' => 'Nama Dosen Pembimbing tidak boleh kosong',
                    'nama_pembimbing.string' => 'Nama Dosen Pembimbing harus berupa string',
                    'nama_pembimbing.max' => 'Nama Dosen Pembimbing maksimal 255 karakter',
                    'nama_pembimbing.min' => 'Nama Dosen Pembimbing minimal 3 karakter',
                    'nip_pembimbing.required' => 'NIP Dosen Pembimbing tidak boleh kosong',
                    'nip_pembimbing.numeric' => 'NIP Dosen Pembimbing harus berupa angka',
                    'nip_pembimbing.digits' => 'NIP Dosen Pembimbing harus 18 digit',
                ]);
                $data['nama_pembimbing'] = Str::title($request->nama_pembimbing);
                $data['nip_pembimbing'] = $request->nip_pembimbing;
                $data['id_pembimbing'] = null;
            } else{
                $request->validate([
                    'id_pembimbing' => 'required|exists:dosen,id',
                ], [
                    'id_pembimbing.required' => 'Dosen Pembimbing tidak boleh kosong',
                    'id_pembimbing.exists' => 'Dosen Pembimbing tidak ditemukan',
                ]);
                $data['nama_pembimbing'] = null;
                $data['nip_pembimbing'] = null;
                $data['id_pembimbing'] = $request->id_pembimbing;
            }
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
                unlink(('uploads/file_prestasi/' . $prestasi->file_prestasi));
            }
            $prestasi->delete();
            return redirect()->route('mahasiswa.profile.index')->with('success', 'Data berhasil dihapus');
        }
    }
}
