<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModelBarangRequest;
use App\Models\Kategori;
use App\Models\ModelBarang;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'models' => ModelBarang::all()
        ];
        return view('admin.admin_lab.inventaris.model.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'categories' => Kategori::all()
        ];
        return view('admin.admin_lab.inventaris.model.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModelBarangRequest $request)
    {
        $data = [
            'nama_model' => $request->nama_model,
            'merk' => $request->merk,
            'id_kategori' => Crypt::decrypt($request->id_kategori),
            'created_at' => now(),
            'updated_at' => now()
        ];
        try {
            DB::beginTransaction();
            $simpan = ModelBarang::create($data);
            ModelBarang::where('id', $simpan->id)->update(['encrypt_id' => Crypt::encrypt($simpan->id)]);
            DB::commit();
            return redirect()->route('sudo.model.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $e) {
            return redirect()->route('sudo.model.index')->with('error', 'Data gagal ditambahkan');
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
        $data = [
            'model' => ModelBarang::where('id', Crypt::decrypt($id))->first(),
            'categories' => Kategori::all()
        ];
        return view('admin.admin_lab.inventaris.model.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreModelBarangRequest $request, $id)
    {
        //
        $data = [
            'nama_model' => $request->nama_model,
            'merk' => $request->merk,
            'id_kategori' => crypt::decrypt($request->id_kategori),
            'updated_at' => now()
        ];
        $update = ModelBarang::where('id', Crypt::decrypt($id))->update($data);
        if ($update) {
            return redirect()->route('sudo.model.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('sudo.model.index')->with('error', 'Data gagal disimpan');
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
        $model = ModelBarang::where('encrypt_id', $id)->first();
        if (!$model) {
            return redirect()->route('sudo.model.index')->with('error', 'model tidak ditemukan!');
        }
        $model->delete();
        return redirect()->route('sudo.model.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
