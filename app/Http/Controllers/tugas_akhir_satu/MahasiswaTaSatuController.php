<?php

namespace App\Http\Controllers\tugas_akhir_satu;

use App\Models\Dosen;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTugasAkhirSatuRequest;
use App\Http\Requests\UpdateSeminarTaSatuRequest;
use App\Models\BerkasPersyaratanSeminar;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Support\Facades\Crypt;


class MahasiswaTaSatuController extends Controller
{
    public function index()
    {
        if (Auth::user()->mahasiswa->ta_satu) {
            $seminar = ModelSeminarTaSatu::where('id_mahasiswa', Auth::user()
                ->mahasiswa->id)->first();

            $mahasiswa = Auth::user()->mahasiswa;
            return view('mahasiswa.ta1.index', compact(['seminar', 'mahasiswa']));
        }
        return redirect()->route('mahasiswa.seminar.tugas_akhir_1.create');
    }


    public function edit($id)
    {
        if (
            Auth::user()->mahasiswa->ta_satu->id != Crypt::decrypt($id)
            && Auth::user()->mahasiswa->ta_satu
        ) {
            return redirect()->back();
        }
        $data = [
            'dosens' => Dosen::select('id', 'encrypt_id', 'nama_dosen')
                ->where('status', 'Aktif')
                ->orderBy('nama_dosen', 'asc')
                ->get(),
            'seminar' => ModelSeminarTaSatu::find(Crypt::decrypt($id)),
        ];
        return view('mahasiswa.ta1.edit', $data);
    }

    public function create()
    {
        if (Auth::user()->mahasiswa->ta_satu) {
            return redirect()->back();
        }
        $data = [
            'dosens' => Dosen::select('id', 'encrypt_id', 'nama_dosen')
                ->where('status', 'Aktif')
                ->orderBy('nama_dosen', 'asc')
                ->get(),
            'syarat' => BerkasPersyaratanSeminar::find(2),
        ];
        return view('mahasiswa.ta1.create', $data);
    }

    public function store(StoreTugasAkhirSatuRequest $request)
    {
        $file = $request->file('berkas_seminar_ta_satu');
        $file_name = $file->hashName();
        $file->move(('uploads/syarat_seminar_ta1'), $file_name);

        $data = [
            'tahun_akademik' => $request->tahun_akademik,
            'sumber_penelitian' => $request->sumber_penelitian,
            'semester' => $request->semester,
            'periode_seminar' => $request->periode_seminar,
            'judul_ta' => Str::title($request->judul_ta),
            'sks' => $request->sks,
            'ipk' => $request->ipk,
            'toefl' => $request->toefl,
            'berkas_ta_satu' => $file_name,
            'agreement' => 1,
            'id_pembimbing_satu' => Crypt::decrypt($request->id_pembimbing_satu),
            'id_pembahas' => Crypt::decrypt($request->pembahas),
            'id_mahasiswa' => Auth::user()->mahasiswa->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if ($request->id_pembimbing_dua == 'new') {
            $request->validate([
                'pbl2_nama' => 'required|string|max:255|min:3',
                'pbl2_nip' => 'required|numeric|digits:18',
            ], [
                'pbl2_nama.required' => 'Nama Dosen Pembimbing 2 tidak boleh kosong',
                'pbl2_nama.string' => 'Nama Dosen Pembimbing 2 harus berupa string',
                'pbl2_nama.max' => 'Nama Dosen Pembimbing 2 maksimal 255 karakter',
                'pbl2_nama.min' => 'Nama Dosen Pembimbing 2 minimal 3 karakter',
                'pbl2_nip.required' => 'NIP Dosen Pembimbing 2 tidak boleh kosong',
                'pbl2_nip.numeric' => 'NIP Dosen Pembimbing 2 harus berupa angka',
                'pbl2_nip.digits' => 'NIP Dosen Pembimbing 2 harus 18 digit',
            ]);
            $data['pbl2_nama'] = Str::title($request->pbl2_nama);
            $data['pbl2_nip'] = $request->pbl2_nip;
        } else {
            $request->validate([
                'id_pembimbing_dua' => 'required|exists:dosen,encrypt_id',
            ], [
                'id_pembimbing_dua.required' => 'Dosen Pembimbing 2 Harus dipilih',
                'id_pembimbing_dua.exists' => 'Dosen Pembimbing 2 tidak ditemukan',
            ]);
            $data['id_pembimbing_dua'] = Crypt::decrypt($request->id_pembimbing_dua);
        }

        $store = ModelSeminarTaSatu::create($data);
        $store_id = $store->id;
        $update = ModelSeminarTaSatu::find($store_id);
        $update->encrypt_id = Crypt::encrypt($store_id);
        $update->save();
        return redirect()->route('mahasiswa.seminar.tugas_akhir_1.index')
            ->with('success', 'Berhasil Mendaftar Seminar Tugas Akhir 1');
    }


    public function update(UpdateSeminarTaSatuRequest $request, $id)
    {

        $seminar = ModelSeminarTaSatu::find(Crypt::decrypt($id));
        if ($seminar->id_mahasiswa != Auth::user()->mahasiswa->id) {
            return redirect()->back();
        }
        $seminar->tahun_akademik = $request->tahun_akademik;
        $seminar->semester = $request->semester;
        $seminar->sumber_penelitian = $request->sumber_penelitian;
        $seminar->periode_seminar = $request->periode_seminar;
        $seminar->judul_ta = Str::title($request->judul_ta);
        $seminar->sks = $request->sks;
        $seminar->ipk = $request->ipk;
        $seminar->toefl = $request->toefl;
        $seminar->agreement = 1;
        $seminar->id_pembimbing_satu = Crypt::decrypt($request->id_pembimbing_satu);
        $seminar->id_pembahas = Crypt::decrypt($request->pembahas);

        //melakukan cek apakah menggunakan dosen 2 dari external atau bukan
        if ($request->id_pembimbing_dua == 'new') {
            $request->validate([
                'pbl2_nama' => 'required|string|max:255|min:3',
                'pbl2_nip' => 'required|numeric|digits:18',
            ], [
                'pbl2_nama.required' => 'Nama Dosen Pembimbing 2 tidak boleh kosong',
                'pbl2_nama.string' => 'Nama Dosen Pembimbing 2 harus berupa string',
                'pbl2_nama.max' => 'Nama Dosen Pembimbing 2 maksimal 255 karakter',
                'pbl2_nama.min' => 'Nama Dosen Pembimbing 2 minimal 3 karakter',
                'pbl2_nip.required' => 'NIP Dosen Pembimbing 2 tidak boleh kosong',
                'pbl2_nip.numeric' => 'NIP Dosen Pembimbing 2 harus berupa angka',
                'pbl2_nip.digits' => 'NIP Dosen Pembimbing 2 harus 18 digit',
            ]);
            $seminar->pbl2_nama = Str::title($request->pbl2_nama);
            $seminar->pbl2_nip = $request->pbl2_nip;
            $seminar->id_pembimbing_dua = null;
        } else {
            $request->validate([
                'id_pembimbing_dua' => 'required|exists:dosen,encrypt_id',
            ], [
                'id_pembimbing_dua.required' => 'Dosen Pembimbing 2 Harus dipilih',
                'id_pembimbing_dua.exists' => 'Dosen Pembimbing 2 tidak ditemukan',
            ]);
            $seminar->id_pembimbing_dua = Crypt::decrypt($request->id_pembimbing_dua);
            $seminar->pbl2_nama = null;
            $seminar->pbl2_nip = null;
        }

        if ($request->file('berkas_seminar_ta_satu')) {
            $file = $request->file('berkas_seminar_ta_satu');
            $file_name = $file->hashName();
            if (file_exists(('uploads/syarat_seminar_ta1/' . $seminar->berkas_ta_satu))) {
                unlink(('uploads/syarat_seminar_ta1/' . $seminar->berkas_ta_satu));
            }
            $seminar->berkas_ta_satu = $file_name;
            $file->move(('uploads/syarat_seminar_ta1'), $file_name);
        }
        $seminar->updated_at = date('Y-m-d H:i:s');
        $seminar->komentar = null;
        $seminar->status_admin = 'Process';
        $seminar->save();
        return redirect()->route('mahasiswa.seminar.tugas_akhir_1.index')
            ->with('success', 'Berhasil Mengubah data Seminar Tugas Akhir 1');
    }
}
