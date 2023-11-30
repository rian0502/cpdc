<?php

namespace App\Http\Controllers\tugas_akhir_satu;

use App\Models\Mahasiswa;
use App\Models\ModelSeminarTaSatu;
use App\Http\Controllers\Controller;
use App\Models\ModelBaSeminarTaSatu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarTaSatu;
use App\Http\Requests\StoreBaTaSatuRequest;
use App\Http\Requests\UpdateBaTaSatuRequest;

class MahasiswaBaTaSatu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        if($mahasiswa->ta_satu->ba_seminar){
            return redirect()->back();
        }
        return view('mahasiswa.ta1.ba.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('mahasiswa.ta1.ba.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBaTaSatuRequest $request)
    {
        //
        if($request->_token != csrf_token()){
            return redirect()->back();
        }else{
            $seminar = Auth::user()->mahasiswa->ta_satu;
            $ba = $request->file('berkas_ba_seminar_ta_satu');
            $file_ba = $ba->hashName();
            $nilai = $request->file('berkas_nilai_seminar_ta_satu');
            $file_nilai = $nilai->hashName();
            $ba->move(('uploads/ba_seminar_ta_satu'), $file_ba);
            $nilai->move(('uploads/nilai_seminar_ta_satu'), $file_nilai);

            $data = [
                'no_berkas_ba_seminar_ta_satu' => $request->no_berkas_ba_seminar_ta_satu,
                'berkas_ba_seminar_ta_satu' => $file_ba,
                'berkas_nilai_seminar_ta_satu' => $file_nilai,
                'berkas_ppt_seminar_ta_satu' => $request->berkas_ppt_seminar_ta_satu,
                'nilai' => $request->nilai,
                'huruf_mutu' => $request->huruf_mutu,
                'id_seminar' => $seminar->id,
            ];
            $insBa = ModelBaSeminarTaSatu::create($data);
            $ins_id = $insBa->id;
            $update = ModelBaSeminarTaSatu::find($ins_id);
            $update->encrypt_id = Crypt::encrypt($ins_id);
            $update->save();
            $jadwal = ModelJadwalSeminarTaSatu::where('id_seminar', $seminar->id)->first();
            $jadwal->tanggal_seminar_ta_satu = $request->tgl_realisasi_seminar;
            $jadwal->updated_at = now();
            $jadwal->save();

            return redirect()->route('mahasiswa.seminar.tugas_akhir_1.index')->with('success', 'Berhasil mengunggah berita acara seminar TA 1');
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

        $seminar = ModelBaSeminarTaSatu::find(Crypt::decrypt($id));
        return view('mahasiswa.ta1.ba.edit', compact('seminar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBaTaSatuRequest $request, $id)
    {
        //validasi _token
        if($request->_token != csrf_token()){
            return redirect()->back();
        }
        //validasi user
        $ba = ModelBaSeminarTaSatu::find(Crypt::decrypt($id));
        if(Auth::user()->mahasiswa->id != $ba->seminar->id_mahasiswa){
            return redirect()->back();
        }
        $data = [
            'no_berkas_ba_seminar_ta_satu' => $request->no_berkas_ba_seminar_ta_satu,
            'huruf_mutu' => $request->huruf_mutu,
            'nilai' => $request->nilai,
            'updated_at' => date('Y-m-d H:i:s'),
            'berkas_ppt_seminar_ta_satu' => $request->berkas_ppt_seminar_ta_satu,
        ];
        if($request->file('berkas_ba_seminar_ta_satu')){
            $oldFile = $ba->berkas_ba_seminar_ta_satu;
            if (file_exists(('uploads/ba_seminar_ta_satu/' . $oldFile))) {
                unlink(('uploads/ba_seminar_ta_satu/' . $oldFile));
            }
            $ba_file = $request->file('berkas_ba_seminar_ta_satu');
            $file_ba = $ba_file->hashName();
            $ba_file->move(('uploads/ba_seminar_ta_satu'), $file_ba);
            $data['berkas_ba_seminar_ta_satu'] = $file_ba;
        }
        if($request->file('berkas_nilai_seminar_ta_satu')){
            $oldFile = $ba->berkas_nilai_seminar_ta_satu;
            if (file_exists(('uploads/nilai_seminar_ta_satu/' . $oldFile))) {
                unlink(('uploads/nilai_seminar_ta_satu/' . $oldFile));
            }
            $nilai_file = $request->file('berkas_nilai_seminar_ta_satu');
            $file_nilai = $nilai_file->hashName();
            $nilai_file->move(('uploads/nilai_seminar_ta_satu'), $file_nilai);
            $data['berkas_nilai_seminar_ta_satu'] = $file_nilai;
        }
        $ba->update($data);
        $jadwal = ModelJadwalSeminarTaSatu::where('id_seminar', $ba->seminar->id)->first();
        $jadwal->tanggal_seminar_ta_satu = $request->tgl_realisasi_seminar;
        $jadwal->updated_at = now();
        $jadwal->save();
        $seminar = ModelSeminarTaSatu::find($ba->id_seminar);
        $seminar->komentar = null;
        $seminar->status_koor = 'Belum Selesai';
        $seminar->save();
        return redirect()->route('mahasiswa.seminar.tugas_akhir_1.index')->with('success', 'Berhasil mengubah berita acara seminar TA 1');
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
