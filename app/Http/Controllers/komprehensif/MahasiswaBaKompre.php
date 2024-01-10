<?php

namespace App\Http\Controllers\komprehensif;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\ModelSeminarKompre;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBaKompre;
use App\Models\ModelBaSeminarKompre;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateBaKompre;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarKompre;
use Illuminate\Support\Facades\DB;

class MahasiswaBaKompre extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        if ($mahasiswa->komprehensif->beritaAcara) {
            return redirect()->back();
        }
        return view('mahasiswa.kompre.ba.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBaKompre $request)
    {
        if ($request->_token != csrf_token()) {
            return redirect()->back();
        } else {
            try {
                DB::beginTransaction();
                $seminar = Auth::user()->mahasiswa->komprehensif;
                $ba = $request->file('ba_seminar_komprehensif');
                $file_ba = $ba->hashName();
                $nilai = $request->file('berkas_nilai_kompre');
                $file_nilai = $nilai->hashName();
                $ba->move(('uploads/ba_sidang_kompre/'), $file_ba);
                $nilai->move(('uploads/nilai_sidang_kompre/'), $file_nilai);

                $data = [
                    'no_ba_berkas' => $request->no_ba_berkas,
                    'ba_seminar_komprehensif' => $file_ba,
                    'berkas_nilai_kompre' => $file_nilai,
                    'laporan_ta' => $request->laporan_ta,
                    'nilai' => $request->nilai,
                    'huruf_mutu' => $request->huruf_mutu,
                    'id_seminar' => $seminar->id,
                ];
                $insBa = ModelBaSeminarKompre::create($data);
                $ins_id = $insBa->id;
                $update = ModelBaSeminarKompre::find($ins_id);
                $update->encrypt_id = Crypt::encrypt($ins_id);
                $update->save();
                $jadwal = ModelJadwalSeminarKompre::where('id_seminar', $seminar->id)->first();
                $jadwal->tanggal_komprehensif = $request->tgl_realisasi_seminar;
                $jadwal->updated_at = now();
                $jadwal->save();
                DB::commit();
                return redirect()->route('mahasiswa.sidang.kompre.index')
                    ->with('success', 'Berhasil mengunggah berita acara sidang komprehensif');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berkas = ModelBaSeminarKompre::with('seminar')->where('id', Crypt::decrypt($id))->first();

        if ($berkas->seminar->id_mahasiswa !=  Auth::user()->mahasiswa->id) {
            return redirect()->back();
        }
        return view('mahasiswa.kompre.ba.edit', compact('berkas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBaKompre $request, $id)
    {
        if ($request->_token != csrf_token()) {
            return redirect()->back();
        }
        //validasi user
        $ba = ModelBaSeminarKompre::find(Crypt::decrypt($id));
        if (Auth::user()->mahasiswa->id != $ba->seminar->id_mahasiswa) {
            return redirect()->back();
        }
        $data = [
            'no_ba_berkas' => $request->no_ba_berkas,
            'huruf_mutu' => $request->huruf_mutu,
            'nilai' => $request->nilai,
            'updated_at' => date('Y-m-d H:i:s'),
            'laporan_ta' => $request->laporan_ta,
        ];
        if ($request->file('ba_seminar_komprehensif')) {
            $oldFile = $ba->ba_seminar_komprehensif;
            if (file_exists(('uploads/ba_sidang_kompre/' . $oldFile))) {
                unlink(('uploads/ba_sidang_kompre/' . $oldFile));
            }
            $ba_file = $request->file('ba_seminar_komprehensif');
            $file_ba = $ba_file->hashName();
            $ba_file->move(('uploads/ba_sidang_kompre'), $file_ba);
            $data['ba_seminar_komprehensif'] = $file_ba;
        }
        if ($request->file('berkas_nilai_kompre')) {
            $oldFile = $ba->berkas_nilai_kompre;
            if (file_exists(('uploads/nilai_sidang_kompre/' . $oldFile))) {
                unlink(('uploads/nilai_sidang_kompre/' . $oldFile));
            }
            $nilai_file = $request->file('berkas_nilai_kompre');
            $file_nilai = $nilai_file->hashName();
            $nilai_file->move(('uploads/nilai_sidang_kompre'), $file_nilai);
            $data['berkas_nilai_kompre'] = $file_nilai;
        }
        $ba->update($data);
        $seminar = ModelSeminarKompre::find($ba->id_seminar);
        $seminar->komentar = null;
        $seminar->status_koor = 'Belum Selesai';
        $seminar->save();

        $jadwal = ModelJadwalSeminarKompre::where('id_seminar', $ba->seminar->id)->first();
        $jadwal->tanggal_komprehensif = $request->tgl_realisasi_seminar;
        $jadwal->updated_at = now();
        $jadwal->save();

        return redirect()->route('mahasiswa.sidang.kompre.index')->with('success', 'Berhasil mengubah berita acara sidang komprehensif');
    }
}
