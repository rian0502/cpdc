<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\History;
use App\Models\Kategori;
use App\Models\ModelBarang;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('admin.admin_lab.inventaris.barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'models' => ModelBarang::all(),
            'categories' => Kategori::all(),
            'lokasi' => Auth::user()->administrasi->lokasi,
        ];

        return view('admin.admin_lab.inventaris.barang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        $data = [
            'nama_barang' => $request->nama_barang,
            'jumlah_akhir' => $request->jumlah_akhir,
            'id_lokasi' => Auth::user()->administrasi->lokasi,
            'id_model' => Crypt::decrypt($request->id_model),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $simpan = Barang::insert($data);
        $id = Barang::latest()->first()->id;
        $encrypt_id = Crypt::encrypt($id);
        $update = Barang::where('id', $id)->update(['encrypt_id' => $encrypt_id]);
        if ($simpan && $update) {
            return redirect()->route('lab.barang.index')->with('success', 'Barang berhasil ditambahkan!');
        } else {
            return redirect()->route('lab.barang.index')->with('error', 'Barang gagal ditambahkan!');
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
        $data = [
            'barang' => Barang::where('id', Crypt::decrypt($id))->first(),
            'histories' => History::where('id_barang', Crypt::decrypt($id))->get(),
        ];
        return view('admin.admin_lab.inventaris.barang.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'barang' => Barang::where('id', Crypt::decrypt($id))->first(),
            'lokasi' => Auth::user()->administrasi->lokasi,
            'models' => ModelBarang::all(),
            'categories' => Kategori::all(),
        ];

        return view('admin.admin_lab.inventaris.barang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangRequest $request, $id)
    {

        if ($request->input('ket') || $request->input('jumlah_akhir')) {
            //proses memasukkan data ke dalam tabel histori
            $jumlahBarangAwal = Barang::where('id', Crypt::decrypt($id))->first()->jumlah_akhir;
            $dataHistori = [
                'jumlah_awal' => $jumlahBarangAwal,
                'ket' => $request->ket,
                'id_barang' => Crypt::decrypt($id),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $simpanHistori = History::insert($dataHistori);
            $idHistori = History::latest()->first()->id;
            $encrypt_id = Crypt::encrypt($idHistori);
            $updateHistori = History::where('id', $idHistori)->update(['encrypt_id' => $encrypt_id]);
            //proses update table barang
            $data = [
                'nama_barang' => $request->nama_barang,
                'id_lokasi' => Auth::user()->administrasi->lokasi,
                'id_model' => Crypt::decrypt($request->id_model),
                'jumlah_akhir' => $request->jumlah_akhir,
                'updated_at' => now(),
            ];
            $update = Barang::where('id', Crypt::decrypt($id))->update($data);
            if ($update && $simpanHistori && $updateHistori) {
                return redirect()->route('lab.barang.index')->with('success', 'Barang berhasil diubah!');
            } else {
                return redirect()->route('lab.barang.index')->with('error', 'Barang gagal diubah!');
            }
        } else {
            $data = [
                'nama_barang' => $request->nama_barang,
                'id_lokasi' => Auth::user()->administrasi->lokasi,
                'id_model' => Crypt::decrypt($request->id_model),
                'updated_at' => now(),
            ];
            $update = Barang::where('id', Crypt::decrypt($id))->update($data);
            if ($update) {
                return redirect()->route('lab.barang.index')->with('success', 'Barang berhasil diubah!');
            } else {
                return redirect()->route('lab.barang.index')->with('error', 'Barang gagal diubah!');
            }
        }
    }

    public function destroy($id)
    {
        $deleted = Barang::where('id', Crypt::decrypt($id))->delete();
        if ($deleted) {
            return redirect()->route('lab.barang.index')->with('success', 'Barang berhasil dihapus!');
        } else {
            return redirect()->route('lab.barang.index')->with('error', 'Barang gagal dihapus!');
        }
    }
}
