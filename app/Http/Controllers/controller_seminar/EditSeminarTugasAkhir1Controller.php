<?php

namespace App\Http\Controllers\controller_seminar;

use App\Models\Dosen;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Support\Facades\DB;
use App\Models\ModelBaSeminarTaSatu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarTaSatu;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateSeminarTugasAkhir1Request;

class EditSeminarTugasAkhir1Controller extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $seminar = ModelSeminarTaSatu::query()->with('mahasiswa');
            return DataTables::of($seminar)
                ->addIndexColumn()->editColumn('mahasiswa.nama', function ($seminar) {
                    return $seminar->mahasiswa->nama;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($seminar) {
                    return $seminar->mahasiswa->npm;
                })->toJson();
        }
        return view('koor.ta1.arsip.index');
    }
    public function edit($id){
        $seminar = ModelSeminarTaSatu::with(['jadwal', 'ba_seminar'])->where('id', Crypt::decrypt($id))->first();
        $dosen = Dosen::select('id', 'encrypt_id', 'nama_dosen')->where('status', 'Aktif')->get();
        $lokasi = Lokasi::select('encrypt_id', 'nama_lokasi')->where('jenis_ruangan', 'Kelas')->get();
        $data = [
            'seminar' => $seminar,
            'dosen' => $dosen,
            'lokasi' => $lokasi,
        ];
        // return response()->json($seminar);
        return view('koor.ta1.arsip.edit', $data);
    }

    public function update(UpdateSeminarTugasAkhir1Request $request, $id){
        try{
            $seminar = ModelSeminarTaSatu::find(Crypt::decrypt($id));
            $jadwal = ModelJadwalSeminarTaSatu::where('id_seminar', $seminar->id)->first();
            $ba = ModelBaSeminarTaSatu::where('id_seminar', $seminar->id)->first();
            DB::beginTransaction();
            $seminar->tahun_akademik = $request->tahun_akademik;
            $seminar->semester = $request->semester;
            $seminar->judul_ta = $request->judul_ta;
            $seminar->sks = $request->sks;
            $seminar->ipk = $request->ipk;
            $seminar->toefl = $request->toefl;
            if ($request->berkas_ta_satu) {
                if (file_exists('uploads/syarat_seminar_ta1/' . $seminar->berkas_ta_satu)) {
                    unlink('uploads/syarat_seminar_ta1/' . $seminar->berkas_ta_satu);
                }
                $file = $request->file('berkas_ta_satu');
                $nama_file = $file->hashName();
                $file->move('uploads/syarat_seminar_ta1', $nama_file);
                $seminar->berkas_ta_satu = $nama_file;
            }
            $seminar->status_admin = $request->status_admin;
            $seminar->status_koor = $request->status_koor;
            $seminar->id_pembimbing_satu = Crypt::decrypt($request->id_pembimbing_satu);
            if($request->id_pembimbing_dua){
                $seminar->id_pembimbing_dua = Crypt::decrypt($request->id_pembimbing_dua);
                $seminar->pbl2_nama = null;
                $seminar->pbl2_nip = null;
            }else{
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
            $jadwal->tanggal_seminar_ta_satu = $request->tanggal_seminar_ta_satu;
            $jadwal->jam_mulai_seminar_ta_satu = $request->jam_mulai_seminar_ta_satu;
            $jadwal->jam_selesai_seminar_ta_satu = $request->jam_selesai_seminar_ta_satu;
            $jadwal->id_lokasi = Crypt::decrypt($request->id_lokasi);
            $jadwal->updated_at = date('Y-m-d H:i:s');
            $jadwal->save();
            //update berita acara
            $ba->no_berkas_ba_seminar_ta_satu = $request->no_berkas_ba_seminar_ta_satu;
            if($request->berkas_ba_seminar_ta_satu){
                if (file_exists('uploads/ba_seminar_ta_satu/' . $ba->berkas_ba_seminar_ta_satu)) {
                    unlink('uploads/ba_seminar_ta_satu/' . $ba->berkas_ba_seminar_ta_satu);
                }
                $file = $request->file('berkas_ba_seminar_ta_satu');
                $nama_file = $file->hashName();
                $file->move('uploads/ba_seminar_ta_satu', $nama_file);
                $ba->berkas_ba_seminar_ta_satu = $nama_file;
            }
            if($request->berkas_nilai_ta_satu){
                if (file_exists('uploads/nilai_seminar_ta_satu/' . $ba->berkas_nilai_ta_satu)) {
                    unlink('uploads/nilai_seminar_ta_satu/' . $ba->berkas_nilai_ta_satu);
                }
                $file = $request->file('berkas_nilai_ta_satu');
                $nama_file = $file->hashName();
                $file->move('uploads/nilai_seminar_ta_satu', $nama_file);
                $ba->berkas_nilai_ta_satu = $nama_file;
            }
            $ba->berkas_ppt_seminar_ta_satu = $request->berkas_ppt_seminar_ta_satu;
            $ba->nilai = $request->nilai;
            $ba->huruf_mutu = $request->huruf_mutu;
            $ba->updated_at = date('Y-m-d H:i:s');
            $ba->save();
            DB::commit();
            return redirect()->route('koor.arsip.ta1.index')->with('success', 'Berhasil mengubah data seminar TA 1 S1');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('koor.arsip.ta1.index')->with('error', $e->getMessage());
        }

    }
}
