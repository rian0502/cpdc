<?php

namespace App\Http\Controllers\Kajur;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Laboratorium;
use App\Models\Lokasi;
use App\Models\ModelBarang;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class InventarisController extends Controller
{
    //
    public function index(Request $request){
        $lab = Lokasi::where('jenis_ruangan', 'Lab')->get();

        $inputFilter = $request->input('id_lab', null);




        if($request->ajax() && $inputFilter != null && $inputFilter != "new"){
            $id_lokasi = Lokasi::where('encrypt_id', $inputFilter)->first();
            $id_lokasi = $id_lokasi->id;
            $filterLokasi = $id_lokasi;
            $data = Barang::with('modelBarang', 'lokasi', 'modelBarang.kategori')->where('id_lokasi', $filterLokasi);

            return DataTables::of($data)
            ->addIndexColumn()->editColumn('modelBarang.nama_model', function ($data) {
                return $data->modelBarang->nama_model;
            })
            ->addIndexColumn()->editColumn('modelBarang.merk', function ($data) {
                return $data->modelBarang->merk;
            })
            ->addIndexColumn()->editColumn('modelBarang.kategori.nama_kategori', function ($data) {
                return $data->modelBarang->kategori->nama_kategori;
            })
            ->addIndexColumn()->editColumn('lokasi.nama_lokasi', function ($data) {
                return $data->lokasi->nama_lokasi;
            })
            ->toJson();
        } else if ($request->ajax() && $inputFilter == null || $inputFilter == "new") {
            $data = Barang::with('modelBarang', 'lokasi', 'modelBarang.kategori');
            return DataTables::of($data)
            ->addIndexColumn()->editColumn('modelBarang.nama_model', function ($data) {
                return $data->modelBarang->nama_model;
            })
            ->addIndexColumn()->editColumn('modelBarang.merk', function ($data) {
                return $data->modelBarang->merk;
            })
            ->addIndexColumn()->editColumn('modelBarang.kategori.nama_kategori', function ($data) {
                return $data->modelBarang->kategori->nama_kategori;
            })
            ->addIndexColumn()->editColumn('lokasi.nama_lokasi', function ($data) {
                return $data->lokasi->nama_lokasi;
            })
            ->toJson();
        }

        return view('jurusan.inventaris.index', compact('lab'));
    }
}
