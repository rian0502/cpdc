<?php

namespace App\Http\Controllers\controller_seminar;


use App\Models\Dosen;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Models\ModelSeminarTaDua;
use Illuminate\Support\Facades\DB;
use App\Models\ModelBaSeminarTaDua;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarTaDua;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateSeminarTugasAkhir2Request;

class EditSeminarTugasAkhir2Controller extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $seminar = ModelSeminarTaDua::query()->with('mahasiswa');
            return DataTables::of($seminar)
                ->addIndexColumn()->editColumn('mahasiswa.nama', function ($seminar) {
                    return $seminar->mahasiswa->nama;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($seminar) {
                    return $seminar->mahasiswa->npm;
                })->toJson();

        }
        return view('koor.ta2.arsip.index');
    }
    public function edit($id)
    {
        $seminar = ModelSeminarTaDua::with(['jadwal', 'ba_seminar'])->where('id', Crypt::decrypt($id))->first();
        $dosen = Dosen::select('encrypt_id', 'nama_dosen')->where('status', 'Aktif')->get();
        $lokasi = Lokasi::select('encrypt_id', 'nama_lokasi')->where('jenis_ruangan', 'Kelas')->get();

        $data = [
            'seminar' => $seminar,
            'dosen' => $dosen,
            'lokasi' => $lokasi,
        ];
        // return response()->json($seminar);
        return view('koor.ta2.arsip.edit', $data);
    }

    public function update(UpdateSeminarTugasAkhir2Request $request, $id)
    {
        try {
            $seminar = ModelSeminarTaDua::find(Crypt::decrypt($id));
            $jadwal = ModelJadwalSeminarTaDua::where('id_seminar', $seminar->id)->first();
            $ba = ModelBaSeminarTaDua::where('id_seminar', $seminar->id)->first();
            DB::beginTransaction();
            $seminar->tahun_akademik = $request->tahun_akademik;
            $seminar->semester = $request->semester;
            $seminar->judul_ta = $request->judul_ta;
            $seminar->sks = $request->sks;
            $seminar->ipk = $request->ipk;
            $seminar->toefl = $request->toefl;
            if ($request->berkas_ta_dua) {
                if (file_exists('uploads/syarat_seminar_ta2/' . $seminar->berkas_ta_dua)) {
                    unlink('uploads/syarat_seminar_ta2/' . $seminar->berkas_ta_dua);
                }
                $file = $request->file('berkas_ta_dua');
                $nama_file = $file->hashName();
                $file->move('uploads/syarat_seminar_ta2', $nama_file);
                $seminar->berkas_ta_dua = $nama_file;
            }
            $seminar->status_admin = $request->status_admin;
            $seminar->status_koor = $request->status_koor;
            $seminar->id_pembimbing_satu = Crypt::decrypt($request->id_pembimbing_satu);
            if ($request->id_pembimbing_dua) {
                $seminar->id_pembimbing_dua = Crypt::decrypt($request->id_pembimbing_dua);
                $seminar->pbl2_nama = null;
                $seminar->pbl2_nip = null;
            } else {
                $request->validate([
                    'pbl2_nama' => 'required',
                    'pbl2_nip' => 'required',
                ]);
                $seminar->id_pembimbing_dua = null;
                $seminar->pbl2_nama = $request->pbl2_nama;
                $seminar->pbl2_nip = $request->pbl2_nip;
            }
            $seminar->id_pembahas = Crypt::decrypt($request->id_pembahas);
            $seminar->updated_at = date('Y-m-d H:i:s');
            $seminar->save();
            //update jadwal
            $jadwal->tanggal_seminar_ta_dua = $request->tanggal_seminar_ta_dua;
            $jadwal->jam_mulai_seminar_ta_dua = $request->jam_mulai_seminar_ta_dua;
            $jadwal->jam_selesai_seminar_ta_dua = $request->jam_selesai_seminar_ta_dua;
            $jadwal->id_lokasi = Crypt::decrypt($request->id_lokasi);
            $jadwal->updated_at = date('Y-m-d H:i:s');
            $jadwal->save();
            //update berita acara
            $ba->no_berkas_ba_seminar_ta_dua = $request->no_berkas_ba_seminar_ta_dua;
            if ($request->berkas_ba_seminar_ta_dua) {
                if (file_exists('uploads/ba_seminar_ta_dua/' . $ba->berkas_ba_seminar_ta_dua)) {
                    unlink('uploads/ba_seminar_ta_dua/' . $ba->berkas_ba_seminar_ta_dua);
                }
                $file = $request->file('berkas_ba_seminar_ta_dua');
                $nama_file = $file->hashName();
                $file->move('uploads/ba_seminar_ta_dua', $nama_file);
                $ba->berkas_ba_seminar_ta_dua = $nama_file;
            }
            if ($request->berkas_nilai_seminar_ta_dua) {
                if (file_exists('uploads/nilai_seminar_ta_dua/' . $ba->berkas_nilai_seminar_ta_dua)) {
                    unlink('uploads/nilai_seminar_ta_dua/' . $ba->berkas_nilai_seminar_ta_dua);
                }
                $file = $request->file('berkas_nilai_seminar_ta_dua');
                $nama_file = $file->hashName();
                $file->move('uploads/nilai_seminar_ta_dua', $nama_file);
                $ba->berkas_nilai_seminar_ta_dua = $nama_file;
            }
            $ba->berkas_ppt_seminar_ta_dua = $request->berkas_ppt_seminar_ta_dua;
            $ba->nilai = $request->nilai;
            $ba->huruf_mutu = $request->huruf_mutu;
            $ba->updated_at = date('Y-m-d H:i:s');
            $ba->save();
            DB::commit();
            return redirect()->route('koor.arsip.ta2.index')->with('success', 'Berhasil mengubah data seminar TA 2 S1');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('koor.arsip.ta2.index')->with('error', $e->getMessage());
        }
    }
}
