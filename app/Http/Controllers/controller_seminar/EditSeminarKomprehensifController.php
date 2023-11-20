<?php

namespace App\Http\Controllers\controller_seminar;

use App\Models\Dosen;
use App\Models\Lokasi;
use App\Models\ModelSeminarKompre;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSeminarKomprehensifRequest;
use App\Models\ModelBaSeminarKompre;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarKompre;

class EditSeminarKomprehensifController extends Controller
{
    //
    public function index()
    {
    }
    public function edit($id)
    {
        $seminar = ModelSeminarKompre::with(['jadwal', 'beritaAcara'])->where('id', Crypt::decrypt($id))->first();
        $dosen = Dosen::select('encrypt_id', 'nama_dosen')->where('status', 'Aktif')->get();
        $lokasi = Lokasi::select('encrypt_id', 'nama_lokasi')->where('jenis_ruangan', 'Kelas')->get();
    }


    public function update(UpdateSeminarKomprehensifRequest $request, $id)
    {
        try {
            $seminar = ModelSeminarKompre::find(Crypt::decrypt($id));
            $jadwal = ModelJadwalSeminarKompre::where('id_seminar', $seminar->id)->first();
            $ba = ModelBaSeminarKompre::where('id_seminar', $seminar->id)->first();
            DB::beginTransaction();
            $seminar->tahun_akademik = $request->tahun_akademik;
            $seminar->semester = $request->semester;
            $seminar->judul_ta = $request->judul_ta;
            $seminar->sks = $request->sks;
            $seminar->ipk = $request->ipk;
            $seminar->toefl = $request->toefl;
            if ($request->berkas_kompre) {
                if (file_exists('uploads/syarat_sidang_kompre/' . $seminar->berkas_kompre)) {
                    unlink('uploads/syarat_sidang_kompre/' . $seminar->berkas_kompre);
                }
                $file = $request->file('berkas_kompre');
                $nama_file = $file->hashName();
                $file->move('uploads/syarat_sidang_kompre/', $nama_file);
                $seminar->berkas_kompre = $nama_file;
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
            $jadwal->tanggal_komprehensif = $request->tanggal_komprehensif;
            $jadwal->jam_mulai_komprehensif = $request->jam_mulai_komprehensif;
            $jadwal->jam_selesai_komprehensif = $request->jam_selesai_komprehensif;
            $jadwal->id_lokasi = Crypt::decrypt($request->id_lokasi);
            $jadwal->updated_at = date('Y-m-d H:i:s');
            $jadwal->save();
            //update berita acara
            $ba->no_ba_berkas = $request->no_ba_berkas;
            if ($request->ba_seminar_komprehensif) {
                if (file_exists('uploads/ba_sidang_kompre/' . $ba->ba_seminar_komprehensif)) {
                    unlink('uploads/ba_sidang_kompre/' . $ba->ba_seminar_komprehensif);
                }
                $file = $request->file('ba_seminar_komprehensif');
                $nama_file = $file->hashName();
                $file->move('uploads/ba_sidang_kompre/', $nama_file);
                $ba->ba_seminar_komprehensif = $nama_file;
            }
            if ($request->berkas_nilai_kompre) {
                if (file_exists('uploads/nilai_sidang_kompre/' . $ba->berkas_nilai_kompre)) {
                    unlink('uploads/nilai_sidang_kompre/' . $ba->berkas_nilai_kompre);
                }
                $file = $request->file('berkas_nilai_kompre');
                $nama_file = $file->hashName();
                $file->move('uploads/nilai_sidang_kompre/', $nama_file);
                $ba->berkas_nilai_kompre = $nama_file;
            }
            $ba->laporan_ta = $request->laporan_ta;
            $ba->nilai = $request->nilai;
            $ba->huruf_mutu = $request->huruf_mutu;
            $ba->updated_at = date('Y-m-d H:i:s');
            $ba->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
