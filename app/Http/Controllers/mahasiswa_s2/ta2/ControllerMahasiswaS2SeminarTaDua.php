<?php

namespace App\Http\Controllers\mahasiswa_s2\ta2;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\ModelSeminarTaDuaS2;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSeminarTaDuaS2Request;
use App\Models\ModelSeminarTaSatuS2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\BerkasPersyaratanSeminar;

class ControllerMahasiswaS2SeminarTaDua extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->mahasiswa->taDuaS2) {
            $data = [
                'seminar' => Auth::user()->mahasiswa->taDuaS2,
                'mahasiswa' => Auth::user()->mahasiswa,
            ];
            return view("mahasiswaS2.ta2.index", $data);
        }
        return redirect()->route('mahasiswa.seminarta2s2.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->mahasiswa->taSatuS2) {
            if (Auth::user()->mahasiswa->taSatuS2->status_koor == 'Selesai') {
                if (Auth::user()->mahasiswa->taDuaS2) {
                    return redirect()->route("mahasiswa.seminarta2s2.index");
                }
                $data = [
                    'syarat' => BerkasPersyaratanSeminar::find(6),
                ];
                return view("mahasiswaS2.ta2.create", $data);
            } else {
                return redirect()->route("mahasiswa.seminarta1s2.index");
            }
        } else {
            return redirect()->route("mahasiswa.seminarta1s2.index");
        }
    }

    /**
     * Store a newly created resource in storage.
     *ErrorException
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'berkas_ta_dua' => 'required|mimes:pdf|max:1024',
            'periode_seminar' => 'required|string|max:255',
        ], [
            'berkas_ta_dua.required' => 'Berkas TA 2 wajib diisi',
            'berkas_ta_dua.mimes' => 'Berkas TA 2 harus bertipe pdf',
            'berkas_ta_dua.max' => 'Berkas TA 2 maksimal berukuran 1 MB',
            'periode_seminar.required' => 'Periode seminar wajib diisi',
            'periode_seminar.string' => 'Periode seminar harus berupa string',
        ]);
        $berkas_dua = $request->file('berkas_ta_dua');
        $nama_berkas = $berkas_dua->hashName();
        $berkas_dua->move('uploads/syarat_seminar_ta_dua_s2', $nama_berkas);
        $seminarta1 = Auth::user()->mahasiswa->taSatuS2;
        $data = [
            'tahun_akademik' => $seminarta1->tahun_akademik,
            'semester' => $seminarta1->semester,
            'periode_seminar' => $request->periode_seminar,
            'judul_ta' => $seminarta1->judul_ta,
            'sks' => $seminarta1->sks,
            'ipk' => $seminarta1->ipk,
            'toefl' => $seminarta1->toefl,
            'berkas_ta_dua' => $nama_berkas,
            'agreement' => 1,
            'id_mahasiswa' => Auth::user()->mahasiswa->id,
            'id_pembimbing_1' => $seminarta1->id_pembimbing_1,
        ];
        if ($seminarta1->id_pembimbing_2) {
            $data['id_pembimbing_2'] = $seminarta1->id_pembimbing_2;
        } else {
            $data['pbl2_nama'] = $seminarta1->pbl2_nama;
            $data['pbl2_nip'] = $seminarta1->pbl2_nip;
        }
        if ($seminarta1->id_pembahas_1) {
            $data['id_pembahas_1'] = $seminarta1->id_pembahas_1;
        } else {
            $data['pembahas_external_1'] = $seminarta1->pembahas_external_1;
            $data['nip_pembahas_external_1'] = $seminarta1->nip_pembahas_external_1;
        }
        if ($seminarta1->id_pembahas_2) {
            $data['id_pembahas_2'] = $seminarta1->id_pembahas_2;
        } else {
            $data['pembahas_external_2'] = $seminarta1->pembahas_external_2;
            $data['nip_pembahas_external_2'] = $seminarta1->nip_pembahas_external_2;
        }
        if ($seminarta1->id_pembahas_3) {
            $data['id_pembahas_3'] = $seminarta1->id_pembahas_3;
        } else {
            $data['pembahas_external_3'] = $seminarta1->pembahas_external_3;
            $data['nip_pembahas_external_3'] = $seminarta1->nip_pembahas_external_3;
        }
        $insert = ModelSeminarTaDuaS2::create($data);
        $update = ModelSeminarTaDuaS2::find($insert->id);
        $update->encrypt_id = Crypt::encrypt($insert->id);
        $update->save();
        return redirect()->route('mahasiswa.seminarta2s2.index')->with('success', 'Berhasil mengajukan seminar Tesis 2');
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
            'seminar' => ModelSeminarTaDuaS2::find(Crypt::decrypt($id)),
            'mahasiswa' => Auth::user()->mahasiswa,
            'syarat' => BerkasPersyaratanSeminar::find(6),
            'dosens' => Dosen::where('status', 'Aktif')->get(),
        ];
        return view("mahasiswaS2.ta2.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeminarTaDuaS2Request $request, $id)
    {

        $seminar = ModelSeminarTaDuaS2::find(Crypt::decrypt($id));
        $seminar->semester = $request->semester;
        $seminar->tahun_akademik = $request->tahun_akademik;
        $seminar->sks = $request->sks;
        $seminar->ipk = $request->ipk;
        $seminar->periode_seminar = $request->periode_seminar;
        $seminar->toefl = $request->toefl;
        $seminar->judul_ta = $request->judul_ta;
        $seminar->id_pembimbing_1 = Crypt::decrypt($request->id_pembimbing_1);
        $seminar->status_admin = 'Process';
        if ($request->id_pembimbing_2 != 'new') {
            $seminar->id_pembimbing_2 = Crypt::decrypt($request->id_pembimbing_2);
            $seminar->pbl2_nama = null;
            $seminar->pbl2_nip = null;
        } else {
            $request->validate([
                'pbl2_nama' => 'required|string|max:255',
                'pbl2_nip' => 'required|string|max:255',
            ], [
                'pbl2_nama.required' => 'Nama Pembimbing 2 harus diisi',
                'pbl2_nama.string' => 'Nama Pembimbing 2 harus berupa kata',
                'pbl2_nama.max' => 'Nama Pembimbing 2 maksimal 255 karakter',
                'pbl2_nip.required' => 'NIP Pembimbing 2 harus diisi',
                'pbl2_nip.string' => 'NIP Pembimbing 2 harus berupa kata',
                'pbl2_nip.max' => 'NIP Pembimbing 2 maksimal 255 karakter'
            ]);
            $seminar->id_pembimbing_2 = null;
            $seminar->pbl2_nama = $request->pbl2_nama;
            $seminar->pbl2_nip = $request->pbl2_nip;
        }
        if ($request->id_pembahas_1 != 'new') {
            $request->validate([
                'id_pembahas_1' => ['required', 'different:id_pembimbing_1', 'different:id_pembimbing_2', 'different:id_pembahas_2', 'different:id_pembahas_3', 'exists:dosen,encrypt_id']
            ], [
                'id_pembahas_1.different' => 'Dosen Tidak Boleh Sama',
                'id_pembahas_1.exists' => 'Dosen Pembahas 1 tidak ditemukan',
                'id_pembahas_1.required' => 'Dosen Pembahas 1 tidak boleh kosong'
            ]);
            $seminar->id_pembahas_1 = Crypt::decrypt($request->id_pembahas_1);
            $seminar->pembahas_external_1 = null;
            $seminar->nip_pembahas_external_1 = null;
        } else {
            $request->validate([
                'pembahas_external_1' => ['required', 'string', 'max:255'],
                'nip_pembahas_external_1' => ['required', 'max:255']
            ], [
                'pembahas_external_1.required' => 'Nama Pembahas 1 tidak boleh kosong',
                'nip_pembahas_external_1.required' => 'NIP Pembahas 1 tidak boleh kosong',
                'pembahas_external_1.max' => 'Nama Pembahas 1 terlalu panjang, maksimal 255 karakter',
                'nip_pembahas_external_1.max' => 'NIP Pembahas 1 terlalu panjang, maksimal 255 karakter',
                'pembahas_external_1.string' => 'Nama Pembahas 1 harus berupa string'
            ]);
            $seminar->id_pembahas_1 = null;
            $seminar->pembahas_external_1 = $request->pembahas_external_1;
            $seminar->nip_pembahas_external_1 = $request->nip_pembahas_external_1;
        }
        if ($request->id_pembahas_2 != 'new') {
            $request->validate([
                'id_pembahas_2' => ['required', 'different:id_pembimbing_1', 'different:id_pembimbing_2', 'different:id_pembahas_1', 'different:id_pembahas_3', 'exists:dosen,encrypt_id']
            ], [
                'id_pembahas_2.different' => 'Dosen Tidak Boleh Sama',
                'id_pembahas_2.exists' => 'Dosen Pembahas 2 tidak ditemukan',
            ]);
            $seminar->id_pembahas_2 = Crypt::decrypt($request->id_pembahas_2);
            $seminar->pembahas_external_2 = null;
            $seminar->nip_pembahas_external_2 = null;
        } else {
            $request->validate([
                'pembahas_external_2' => ['required', 'string', 'max:255'],
                'nip_pembahas_external_2' => ['required', 'max:255']
            ], [
                'pembahas_external_2.required' => 'Nama Pembahas 2 tidak boleh kosong',
                'nip_pembahas_external_2.required' => 'NIP Pembahas 2 tidak boleh kosong',
                'pembahas_external_2.max' => 'Nama Pembahas 2 terlalu panjang, maksimal 255 karakter',
                'nip_pembahas_external_2.max' => 'NIP Pembahas 2 terlalu panjang, maksimal 255 karakter',
                'pembahas_external_2.string' => 'Nama Pembahas 2 harus berupa string'
            ]);
            $seminar->id_pembahas_2 = null;
            $seminar->pembahas_external_2 = $request->pembahas_external_2;
            $seminar->nip_pembahas_external_2 = $request->nip_pembahas_external_2;
        }
        if ($request->id_pembahas_3 != 'new') {
            $request->validate([
                'id_pembahas_3' => ['required', 'different:id_pembimbing_1', 'different:id_pembimbing_2', 'different:id_pembahas_1', 'different:id_pembahas_2', 'exists:dosen,encrypt_id']
            ], [
                'id_pembahas_3.different' => 'Dosen Tidak Boleh Sama',
                'id_pembahas_3.exists' => 'Dosen Pembahas 3 tidak ditemukan',
            ]);
            $seminar->id_pembahas_3 = Crypt::decrypt($request->id_pembahas_3);
            $seminar->pembahas_external_3 = null;
            $seminar->nip_pembahas_external_3 = null;
        } else {
            $request->validate([
                'pembahas_external_3' => ['required', 'string', 'max:255'],
                'nip_pembahas_external_3' => ['required', 'max:255']
            ], [
                'pembahas_external_3.required' => 'Nama Pembahas 3 tidak boleh kosong',
                'nip_pembahas_external_3.required' => 'NIP Pembahas 3 tidak boleh kosong',
                'pembahas_external_3.max' => 'Nama Pembahas 3 terlalu panjang, maksimal 255 karakter',
                'nip_pembahas_external_3.max' => 'NIP Pembahas 3 terlalu panjang, maksimal 255 karakter',
                'pembahas_external_3.string' => 'Nama Pembahas 3 harus berupa string'
            ]);
            $seminar->id_pembahas_3 = null;
            $seminar->pembahas_external_3 = $request->pembahas_external_3;
            $seminar->nip_pembahas_external_3 = $request->nip_pembahas_external_3;
        }
        if ($request->file('berkas_ta_dua')) {
            unlink('uploads/syarat_seminar_ta_dua_s2/' . $seminar->berkas_ta_dua);
            $berkas_dua = $request->file('berkas_ta_dua');
            $nama_berkas = $berkas_dua->hashName();
            $berkas_dua->move('uploads/syarat_seminar_ta_dua_s2', $nama_berkas);
            $seminar->berkas_ta_dua = $nama_berkas;
        }
        $seminar->save();
        return redirect()->route('mahasiswa.seminarta2s2.index')->with('success', 'Berhasil mengubah seminar Tesis 2');
    }
}
