<?php

namespace App\Http\Controllers\mahasiswa_s2\ta2;

use Illuminate\Http\Request;
use App\Models\ModelSeminarTaDuaS2;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelBaSeminarTaDuaS2;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreBaTaDuaS2Request;
use App\Http\Requests\UpdateBaTaSatuS2Request;

class ControllerMahasiswaS2BaTaDua extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("mahasiswaS2.ta2.ba.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBaTaDuaS2Request $request)
    {
        $ba = $request->file('file_ba');
        $nama_ba = $ba->hashName();
        $ba->move('uploads/ba_seminar_tesis_2', $nama_ba);
        $nilai = $request->file('file_nilai');
        $nama_nilai = $nilai->hashName();
        $nilai->move('uploads/nilai_seminar_tesis_2', $nama_nilai);
        $data = [
            'nilai' => $request->nilai,
            'no_ba' => $request->no_ba,
            'nilai_mutu' => $request->nilai_mutu,
            'ppt' => $request->ppt,
            'file_ba' => $nama_ba,
            'file_nilai' => $nama_nilai,
            'id_seminar' => Auth::user()->mahasiswa->taDuaS2->id
        ];
        $insert = ModelBaSeminarTaDuaS2::create($data);
        $update = ModelBaSeminarTaDuaS2::find($insert->id);
        $update->encrypt_id = Crypt::encrypt($insert->id);
        $update->save();
        return redirect()->route('mahasiswa.seminarta2s2.index')->with(['success' => 'Berhasil mengunggah berita acara seminar tesis 2']);
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
        $data = [
            'seminar' => ModelBaSeminarTaDuaS2::find(Crypt::decrypt($id)),
        ];
        return view("mahasiswaS2.ta2.ba.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBaTaSatuS2Request $request, $id)
    {
        //
        $berita_acara = ModelBaSeminarTaDuaS2::find(Crypt::decrypt($id));
        $berita_acara->no_ba = $request->no_ba;
        $berita_acara->nilai = $request->nilai;
        $berita_acara->nilai_mutu = $request->nilai_mutu;
        $berita_acara->ppt = $request->ppt;
        if ($request->file('file_ba')) {
            unlink('uploads/ba_seminar_tesis_1/' . $berita_acara->file_ba);
            $file_ba = $request->file('file_ba');
            $name_file_ba = $file_ba->hashName();
            $file_ba->move('uploads/ba_seminar_tesis_1', $name_file_ba);
            $berita_acara->file_ba = $name_file_ba;
        }
        if($request->file('file_nilai')){
            unlink('uploads/nilai_seminar_tesis_1/' . $berita_acara->file_nilai);
            $file_nilai = $request->file('file_nilai');
            $name_file_nilai = $file_nilai->hashName();
            $file_nilai->move('uploads/nilai_seminar_tesis_1', $name_file_nilai);
            $berita_acara->file_nilai = $name_file_nilai;
        }
        $berita_acara->save();
        $seminar = ModelSeminarTaDuaS2::find($berita_acara->id_seminar);
        $seminar->status_koor = 'Belum Selesai';
        $seminar->komentar = '';
        $seminar->updated_at = now();
        $seminar->save();
        return redirect()->route('mahasiswa.seminarta2s2.index')->with('success', 'Berhasil mengubah berita acara seminar tesis 2');
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
    }
}
