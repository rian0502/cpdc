<?php

namespace App\Http\Controllers\mahasiswa_s2\kompre;

use Illuminate\Http\Request;
use App\Models\ModelBaKompreS2;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreBaTaTesisRequest;
use App\Http\Requests\UpdateBaSidangTesisRequest;
use App\Models\ModelKompreS2;
use Illuminate\Support\Facades\Auth;

class ControllerMahasiswaS2BaKompre extends Controller
{
    public function create()
    {
        return view("mahasiswaS2.kompre.ba.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBaTaTesisRequest $request)
    {
        $file_ba = $request->file('file_ba');
        $nama_ba = $file_ba->hashName();
        $file_nilai = $request->file('file_nilai');
        $nama_nilai = $file_nilai->hashName();
        $data = [
            'nilai' => $request->nilai,
            'no_ba' => $request->no_ba,
            'nilai_mutu' => $request->nilai_mutu,
            'pengesahan' => $request->pengesahan,
            'file_ba' => $nama_ba,
            'file_nilai' => $nama_nilai,
            'id_seminar' => Auth::user()->mahasiswa->komprehensifS2->id,
        ];
        $insert = ModelBaKompreS2::create($data);
        $update = ModelBaKompreS2::find($insert->id);
        $update->encrypt_id = Crypt::encrypt($insert->id);
        $update->save();
        $file_ba->move('uploads/ba_sidang_tesis', $nama_ba);
        $file_nilai->move('uploads/nilai_sidang_tesis', $nama_nilai);
        return redirect()->route('mahasiswa.sidang.kompres2.index')->with('success', 'Berita Acara Sidang Tesis berhasil ditambahkan!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seminar = ModelBaKompreS2::find(Crypt::decrypt($id));
        return view("mahasiswaS2.kompre.ba.edit", compact('seminar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBaSidangTesisRequest $request, $id)
    {
        $berkas = ModelBaKompreS2::find(Crypt::decrypt($id));
        $berkas->nilai = $request->nilai;
        $berkas->no_ba = $request->no_ba;
        $berkas->nilai_mutu = $request->nilai_mutu;
        $berkas->pengesahan = $request->pengesahan;
        if ($request->file('file_ba')) {
            unlink('uploads/ba_sidang_tesis/' . $berkas->file_ba);
            $file_ba = $request->file('file_ba');
            $nama_ba = $file_ba->hashName();
            $berkas->file_ba = $nama_ba;
            $file_ba->move('uploads/ba_sidang_tesis', $nama_ba);
        }
        if ($request->file('file_nilai')) {
            unlink('uploads/nilai_sidang_tesis/' . $berkas->file_nilai);
            $file_nilai = $request->file('file_nilai');
            $nama_nilai = $file_nilai->hashName();
            $berkas->file_nilai = $nama_nilai;
            $file_nilai->move('uploads/nilai_sidang_tesis', $nama_nilai);
        }
        $berkas->updated_at = date('Y-m-d H:i:s');
        $berkas->save();
        $seminar = ModelKompreS2::find($berkas->id_seminar);
        $seminar->status_koor = 'Belum Selesai';
        $seminar->komentar = null;
        $seminar->updated_at = date('Y-m-d H:i:s');
        $seminar->save();
        return redirect()->route('mahasiswa.sidang.kompres2.index')->with('success', 'Berita Acara Sidang Tesis berhasil diubah!');;
    }

}
