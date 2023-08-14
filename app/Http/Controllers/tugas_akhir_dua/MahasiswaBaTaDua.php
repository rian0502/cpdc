<?php

namespace App\Http\Controllers\tugas_akhir_dua;

use Illuminate\Http\Request;
use App\Models\ModelBaSeminarTaDua;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBaTaDuaRequest;
use App\Http\Requests\UpdateBaTaDuaRequest;
use App\Models\ModelJadwalSeminarTaDua;
use App\Models\ModelSeminarTaDua;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MahasiswaBaTaDua extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('mahasiswa.ta2.ba.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('mahasiswa.ta2.ba.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBaTaDuaRequest $request)
    {
        //
        if ($request->_token != csrf_token()) {
            return redirect()->back();
        } else {
            $seminar = Auth::user()->mahasiswa->ta_dua;
            $ta2 = ModelSeminarTaDua::where('id_mahasiswa', Auth::user()->mahasiswa->id)->first();
            $ta2->status_koor = 'Selesai';
            $ta2->save();
            $ba = $request->file('berkas_ba_seminar_ta_dua');
            $file_ba = $ba->hashName();
            $nilai = $request->file('berkas_nilai_seminar_ta_dua');
            $file_nilai = $nilai->hashName();
            $ba->move(('uploads/ba_seminar_ta_dua/'), $file_ba);
            $nilai->move(('uploads/nilai_seminar_ta_dua/'), $file_nilai);

            $data = [
                'no_berkas_ba_seminar_ta_dua' => $request->no_berkas_ba_seminar_ta_dua,
                'berkas_ba_seminar_ta_dua' => $file_ba,
                'berkas_nilai_seminar_ta_dua' => $file_nilai,
                'berkas_ppt_seminar_ta_dua' => $request->berkas_ppt_seminar_ta_dua,
                'nilai' => $request->nilai,
                'huruf_mutu' => $request->huruf_mutu,
                'id_seminar' => $seminar->id,
            ];
            $insBa = ModelBaSeminarTaDua::create($data);
            $ins_id = $insBa->id;
            $update = ModelBaSeminarTaDua::find($ins_id);
            $update->encrypt_id = Crypt::encrypt($ins_id);
            $update->save();
            $jadwal = ModelJadwalSeminarTaDua::where('id_seminar', $seminar->id)->first();
            $jadwal->tanggal_seminar_ta_dua = $request->tgl_realisasi_seminar;
            $jadwal->updated_at = now();
            $jadwal->save();
            return redirect()->route('mahasiswa.seminar.tugas_akhir_2.index')->with('success', 'Berhasil mengunggah berita acara seminar TA 2');
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

        $data = [
            'seminar' => ModelBaSeminarTaDua::find(Crypt::decrypt($id)),
        ];

        return view('mahasiswa.ta2.ba.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBaTaDuaRequest $request, $id)
    {
        if ($request->_token != csrf_token()) {
            return redirect()->back();
        }
        //validasi user
        $ba = ModelBaSeminarTaDua::find(Crypt::decrypt($id));
        if (Auth::user()->mahasiswa->id != $ba->seminar->id_mahasiswa) {
            return redirect()->back();
        }
        $data = [
            'no_berkas_ba_seminar_ta_dua' => $request->no_berkas_ba_seminar_ta_dua,
            'huruf_mutu' => $request->huruf_mutu,
            'nilai' => $request->nilai,
            'updated_at' => date('Y-m-d H:i:s'),
            'berkas_ppt_seminar_ta_dua' => $request->berkas_ppt_seminar_ta_dua,
        ];
        if ($request->file('berkas_ba_seminar_ta_dua')) {
            $oldFile = $ba->berkas_ba_seminar_ta_dua;
            if (file_exists(('uploads/ba_seminar_ta_dua/' . $oldFile))) {
                unlink(('uploads/ba_seminar_ta_dua/' . $oldFile));
            }
            $ba_file = $request->file('berkas_ba_seminar_ta_dua');
            $file_ba = $ba_file->hashName();
            $ba_file->move(('uploads/ba_seminar_ta_dua'), $file_ba);
            $data['berkas_ba_seminar_ta_dua'] = $file_ba;
        }
        if ($request->file('berkas_nilai_seminar_ta_dua')) {
            $oldFile = $ba->berkas_nilai_seminar_ta_dua;
            if (file_exists(('uploads/nilai_seminar_ta_dua/' . $oldFile))) {
                unlink(('uploads/nilai_seminar_ta_dua/' . $oldFile));
            }
            $nilai_file = $request->file('berkas_nilai_seminar_ta_dua');
            $file_nilai = $nilai_file->hashName();
            $nilai_file->move(('uploads/nilai_seminar_ta_dua'), $file_nilai);
            $data['berkas_nilai_seminar_ta_dua'] = $file_nilai;
        }
        $ba->update($data);
        $jadwal = ModelJadwalSeminarTaDua::where('id_seminar', $ba->seminar->id)->first();
        $jadwal->tanggal_seminar_ta_dua = $request->tgl_realisasi_seminar;
        $jadwal->updated_at = now();
        $jadwal->save();
        return redirect()->route('mahasiswa.seminar.tugas_akhir_2.index')->with('success', 'Berhasil mengubah berita acara seminar TA 2');
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
