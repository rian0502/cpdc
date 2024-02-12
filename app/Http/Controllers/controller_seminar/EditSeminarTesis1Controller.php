<?php

namespace App\Http\Controllers\controller_seminar;

use App\Models\Dosen;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ModelSeminarTaSatuS2;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelBaSeminarTaSatuS2;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ModelJadwalSeminarTaSatuS2;
use App\Http\Requests\UpdateSeminarTesis1Request;

class EditSeminarTesis1Controller extends Controller
{
    //

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $seminar = ModelSeminarTaSatuS2::query()->with('mahasiswa');
            return DataTables::of($seminar)
                ->addIndexColumn()->editColumn('mahasiswa.nama', function ($seminar) {
                    return $seminar->mahasiswa->nama;
                })
                ->addIndexColumn()->editColumn('mahasiswa.npm', function ($seminar) {
                    return $seminar->mahasiswa->npm;
                })->toJson();
        }
        return view('koorS2.tesis1.arsip.index');
    }

    public function edit($id)
    {
        $seminar = ModelSeminarTaSatuS2::find(Crypt::decrypt($id));
        $dosen = Dosen::select('id', 'encrypt_id', 'nama_dosen')->where('status', 'Aktif')->get();
        $lokasi = Lokasi::select('encrypt_id', 'nama_lokasi')->where('jenis_ruangan', 'Kelas')->get();
        $data = [
            'seminar' => $seminar,
            'dosen' => $dosen,
            'lokasi' => $lokasi,
        ];
        return view('koorS2.tesis1.arsip.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $seminar = ModelSeminarTaSatuS2::find(Crypt::decrypt($id));
            $jadwal = ModelJadwalSeminarTaSatuS2::where('id_seminar', $seminar->id)->first();
            $ba = ModelBaSeminarTaSatuS2::where('id_seminar', $seminar->id)->first();
            DB::beginTransaction();
            $seminar->tahun_akademik = $request->tahun_akademik;
            $seminar->semester = $request->semester;
            $seminar->sumber_penelitian = $request->sumber_penelitian;
            $seminar->periode_seminar = $request->periode_seminar;
            $seminar->judul_ta = $request->judul_ta;
            $seminar->sks = $request->sks;
            $seminar->ipk = $request->ipk;
            $seminar->toefl = $request->toefl;
            if ($request->hasFile('berkas_ta_satu')) {
                $request->validate([
                    'berkas_ta_satu' => 'required|mimes:pdf|max:10000',
                ]);
                if (file_exists('uploads/syarat_seminar_ta_satu_s2/' . $seminar->berkas_ta_satu)) {
                    unlink('uploads/syarat_seminar_ta_satu_s2/' . $seminar->berkas_ta_satu);
                }
                $file = $request->file('berkas_ta_satu');
                $filename = $file->hashName();
                $file->move('uploads/syarat_seminar_ta_satu_s2', $filename);
                $seminar->berkas_ta_satu = $filename;
            }
            $seminar->komentar = $request->komentar;
            $seminar->status_admin = $request->status_admin;
            $seminar->status_koor = $request->status_koor;
            $seminar->id_pembimbing_1 = Crypt::decrypt($request->id_pembimbing_1);
            if ($request->id_pembimbing_2 != 'new') {
                $seminar->id_pembimbing_2 = Crypt::decrypt($request->id_pembimbing_2);
                $seminar->pbl2_nama = null;
                $seminar->pbl2_nip = null;
            } else {
                $request->validate([
                    'pbl2_nama' => 'required',
                    'pbl2_nip' => 'required',
                ]);
                $seminar->id_pembimbing_2 = null;
                $seminar->pbl2_nama = $request->pbl2_nama;
                $seminar->pbl2_nip = $request->pbl2_nip;
            }
            if ($request->id_pembahas_1 != 'new') {
                $seminar->id_pembahas_1 = Crypt::decrypt($request->id_pembahas_1);
                $seminar->pembahas_external_1 = null;
                $seminar->nip_pembahas_external_1 = null;
            } else {
                $request->validate([
                    'pembahas_external_1' => 'required',
                    'nip_pembahas_external_1' => 'required',
                ]);
                $seminar->id_pembahas_1 = null;
                $seminar->pembahas_external_1 = $request->pembahas_external_1;
                $seminar->nip_pembahas_external_1 = $request->nip_pembahas_external_1;
            }
            if ($request->id_pembahas_2 != 'new') {
                $seminar->id_pembahas_2 = Crypt::decrypt($request->id_pembahas_2);
                $seminar->pembahas_external_2 = null;
                $seminar->nip_pembahas_external_2 = null;
            } else {
                $request->validate([
                    'pembahas_external_2' => 'required',
                    'nip_pembahas_external_2' => 'required',
                ]);
                $seminar->id_pembahas_2 = null;
                $seminar->pembahas_external_2 = $request->pembahas_external_2;
                $seminar->nip_pembahas_external_2 = $request->nip_pembahas_external_2;
            }
            if ($request->id_pembahas_3 != 'new') {
                $seminar->id_pembahas_3 = Crypt::decrypt($request->id_pembahas_3);
                $seminar->pembahas_external_3 = null;
                $seminar->nip_pembahas_external_3 = null;
            } else {
                $request->validate([
                    'pembahas_external_3' => 'required',
                    'nip_pembahas_external_3' => 'required',
                ]);
                $seminar->id_pembahas_3 = null;
                $seminar->pembahas_external_3 = $request->pembahas_external_3;
                $seminar->nip_pembahas_external_3 = $request->nip_pembahas_external_3;
            }
            $seminar->updated_at = date('Y-m-d H:i:s');
            $seminar->save();

            if ($jadwal) {
                $jadwal->tanggal = $request->tanggal;
                $jadwal->jam_mulai = $request->jam_mulai;
                $jadwal->jam_selesai = $request->jam_selesai;
                $jadwal->id_lokasi = Crypt::decrypt($request->id_lokasi);
                $jadwal->updated_at = date('Y-m-d H:i:s');
                $jadwal->save();
            }

            if ($ba) {
                $ba->no_ba = $request->no_ba;
                $ba->nilai = $request->nilai;
                $ba->nilai_mutu = $request->nilai_mutu;
                $ba->ppt = $request->ppt;
                if ($request->berkas_ba) {
                    $request->validate([
                        'berkas_ba' => 'required|mimes:pdf|max:1024'
                    ]);
                    if (file_exists('uploads/ba_seminar_tesis_1/' . $ba->berkas_ba)) {
                        unlink('uploads/ba_seminar_tesis_1/' . $ba->berkas_ba);
                    }
                    $file = $request->file('berkas_ba');
                    $filename = $file->hashName();
                    $file->move('uploads/ba_seminar_tesis_1', $filename);
                    $ba->berkas_ba = $filename;
                }
                if ($request->file_nilai) {
                    $request->validate([
                        'file_nilai' => 'required|mimes:pdf|max:1024'
                    ]);
                    if (file_exists('uploads/nilai_seminar_tesis_1/' . $ba->file_nilai)) {
                        unlink('uploads/nilai_seminar_tesis_1/' . $ba->file_nilai);
                    }
                    $file = $request->file('file_nilai');
                    $filename = $file->hashName();
                    $file->move('uploads/nilai_seminar_tesis_1', $filename);
                    $ba->file_nilai = $filename;
                }
                $ba->updated_at = date('Y-m-d H:i:s');
                $ba->save();
            }
            DB::commit();
            return redirect()->route('koor.arsip.tesis1.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show($id){
        $seminar = ModelSeminarTaSatuS2::with(
            'mahasiswa',
            'jadwal',
            'beritaAcara',
            'pembimbingSatu',
            'pembimbingDua',
            'pembahasSatu',
            'pembahasDua',
            'pembahasTiga'
        )->find(Crypt::decrypt($id));
        $data = [
            'seminar' => $seminar,
        ];
        return view('koorS2.tesis1.arsip.show', $data);
    }
}
