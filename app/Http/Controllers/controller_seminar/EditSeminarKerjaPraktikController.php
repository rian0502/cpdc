<?php

namespace App\Http\Controllers\controller_seminar;

use App\Models\BaSKP;
use App\Models\Dosen;
use App\Models\Lokasi;
use App\Models\JadwalSKP;
use Illuminate\Http\Request;
use App\Models\ModelSeminarKP;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\BerkasPersyaratanSeminar;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateSeminarPKLRequest;

class EditSeminarKerjaPraktikController extends Controller
{
    //

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $seminar = ModelSeminarKP::query()->with('mahasiswa');
            return DataTables::of($seminar)
                ->addIndexColumn()->editColumn('mahasiswa.nama', function ($seminar) {
                    return $seminar->mahasiswa->nama;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($seminar) {
                    return $seminar->mahasiswa->npm;
                })->toJson();
        }
        return view('koor.pkl.arsip.index');
    }


    public function edit($id)
    {
        $syarat = BerkasPersyaratanSeminar::find(1);
        $seminar = ModelSeminarKP::with(['jadwal', 'berita_acara'])->where('id', Crypt::decrypt($id))->first();
        $dosen = Dosen::select('id', 'encrypt_id', 'nama_dosen')->where('status', 'Aktif')->get();
        $lokasi = Lokasi::select('encrypt_id', 'nama_lokasi')->where('jenis_ruangan', 'Kelas')->get();
        $data = [
            'seminar' => $seminar,
            'dosen' => $dosen,
            'lokasi' => $lokasi,
            'syarat' => $syarat
        ];
        return view('koor.pkl.arsip.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $seminar = ModelSeminarKP::find(Crypt::decrypt($id));
            $jadwal = JadwalSKP::where('id_skp', $seminar->id)->first();
            $ba_pkl = BaSKP::where('id_seminar', $seminar->id)->first();
            DB::beginTransaction();
            $seminar->judul_kp = $request->judul_kp;
            $seminar->semester = $request->semester;
            $seminar->tahun_akademik = $request->tahun_akademik;
            $seminar->mitra = $request->mitra;
            $seminar->region = $request->region;
            $seminar->rencana_seminar = $request->rencana_seminar;
            $seminar->pembimbing_lapangan = $request->pembimbing_lapangan;
            $seminar->ni_pemlap = $request->ni_pemlap;
            $seminar->toefl = $request->toefl;
            $seminar->sks = $request->sks;
            $seminar->ipk = $request->ipk;
            $seminar->status_seminar = $request->status_seminar;
            $seminar->proses_admin = $request->proses_admin;
            $seminar->id_dospemkp = Crypt::decrypt($request->id_dospemkp);
            if ($request->berkas_seminar_pkl) {
                $request->validate([
                    'berkas_seminar_pkl' => 'required|mimes:pdf|max:1024'
                ]);
                $file = $request->file('berkas_seminar_pkl');
                $nama_file = $file->hashName();
                $file->move('uploads/syarat_seminar_kp', $nama_file);
                $seminar->berkas_seminar_pkl = $nama_file;
            }
            $seminar->updated_at = date('Y-m-d H:i:s');
            $seminar->save();

            if ($jadwal) {
                $jadwal->tanggal_skp = $request->tanggal_skp;
                $jadwal->jam_mulai_skp = $request->jam_mulai_skp;
                $jadwal->jam_selesai_skp = $request->jam_selesai_skp;
                $jadwal->id_lokasi = Crypt::decrypt($request->id_lokasi);
                $jadwal->updated_at = date('Y-m-d H:i:s');
                $jadwal->save();
            }
            if ($ba_pkl) {
                $ba_pkl->no_ba_seminar_kp = $request->no_ba_seminar_kp;
                $ba_pkl->nilai_lapangan = $request->nilai_lapangan;
                $ba_pkl->nilai_akd = $request->nilai_akd;
                $ba_pkl->nilai_akhir = $request->nilai_akhir;
                $ba_pkl->nilai_mutu = $request->nilai_mutu;
                if ($request->berkas_ba_seminar_kp) {
                    $request->validate([
                        'berkas_ba_seminar_kp' => 'required|mimes:pdf|max:1024'
                    ]);
                    if (file_exists('uploads/berita_acara_seminar_kp/' . $ba_pkl->berkas_ba_seminar_kp)) {
                        unlink('uploads/berita_acara_seminar_kp/' . $ba_pkl->berkas_ba_seminar_kp);
                    }
                    $file = $request->file('berkas_ba_seminar_kp');
                    $nama_file = $file->hashName();
                    $file->move('uploads/berita_acara_seminar_kp', $nama_file);
                    $ba_pkl->berkas_ba_seminar_kp = $nama_file;
                }
                if ($request->laporan_kp) {
                    $request->validate([
                        'laporan_kp' => 'required|mimes:pdf|max:1024'
                    ]);
                    if (file_exists('uploads/laporan_kp/' . $ba_pkl->berkas_ba_seminar_kp)) {
                        unlink('uploads/laporan_kp/' . $ba_pkl->berkas_ba_seminar_kp);
                    }
                    $file = $request->file('laporan_kp');
                    $nama_file = $file->hashName();
                    $file->move('uploads/laporan_kp', $nama_file);
                    $ba_pkl->laporan_kp = $nama_file;
                }
                $ba_pkl->updated_at = date('Y-m-d H:i:s');
                $ba_pkl->save();
            }
            DB::commit();
            return redirect()->route('koor.arsip.pkl.index')->with('success', 'Berhasil mengubah data seminar KP');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('koor.arsip.pkl.index')->with('error', $e->getMessage());
        }
    }
}
