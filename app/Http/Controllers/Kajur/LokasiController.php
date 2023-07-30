<?php

namespace App\Http\Controllers\Kajur;

use App\Models\Lokasi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreLokasiRequest;


class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:jurusan');
    }
    public function index()
    {
        //
        $data = [
            'locations' => Lokasi::select('encrypt_id', 'nama_lokasi', 'nama_gedung', 'lantai_tingkat')->get()
        ];
        return view('jurusan.lokasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('jurusan.lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLokasiRequest $request)
    {
        //
        $data = [
            'nama_lokasi' => $request->nama_lokasi,
            'nama_gedung' => $request->nama_gedung,
            'lantai_tingkat' => $request->lantai_tingkat,
            'jenis_ruangan' => $request->jenis_ruangan,
            'created_at' => now()
        ];
        $simpan = Lokasi::create($data);
        $id = Lokasi::latest()->first()->id;
        $update = Lokasi::where('id', $id)->update(['encrypt_id' => Crypt::encrypt($id)]);
        if ($simpan && $update) {
            return redirect()->route('jurusan.lokasi.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('jurusan.lokasi.index')->with('error', 'Data gagal disimpan');
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
        $lokasi = Lokasi::where('id', Crypt::decrypt($id))->first();
        return view('jurusan.lokasi.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLokasiRequest $request, $id)
    {
        //
        return dd($request->all());
        $data = [
            'nama_lokasi' => $request->nama_lokasi,
            'nama_gedung' => $request->nama_gedung,
            'lantai_tingkat' => $request->lantai_tingkat,
            'jenis_ruangan' => $request->jenis_ruangan,
            'updated_at' => now()
        ];
        $update = Lokasi::where('id', Crypt::decrypt($id))->update($data);
        if ($update) {
            return redirect()->route('jurusan.lokasi.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('jurusan.lokasi.index')->with('error', 'Data gagal diubah');
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
        $delete = Lokasi::where('id', Crypt::decrypt($id))->delete();
        if ($delete) {
            return redirect()->route('jurusan.lokasi.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('jurusan.lokasi.index')->with('error', 'Data gagal dihapus');
        }
    }
}
