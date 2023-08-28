<?php

namespace App\Http\Controllers\mahasiswa_s2\kompre;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\ModelKompreS2;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSidangTesisS2Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\BerkasPersyaratanSeminar;

class ControllerMahasiswaS2SidangKompre extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->mahasiswa->komprehensifS2) {
            $seminar = Auth::user()->mahasiswa->komprehensifS2;
            $data = [
                'seminar' => $seminar,
                'mahasiswa' => Auth::user()->mahasiswa
            ];
            return view("mahasiswaS2.kompre.index", $data);
        } else {
            return redirect()->route("mahasiswa.sidang.kompres2.create");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::user()->mahasiswa->taDuaS2) {
            if (Auth::user()->mahasiswa->taDuaS2->status_koor == 'Selesai') {
                if (Auth::user()->mahasiswa->komprehensifS2) {
                    return redirect()->route("mahasiswa.sidang.kompres2.index");
                }
                $data = [
                    'syarat' => BerkasPersyaratanSeminar::find(7)
                ];
                return view("mahasiswaS2.kompre.create", $data);
            } else {
                return redirect()->route("mahasiswa.seminarta2s2.index");
            }
        } else {
            return redirect()->route("mahasiswa.seminarta2s2.index");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'berkas_kompre' => 'required|mimes:pdf|max:1024',
            'periode_seminar' => 'required|string|max:255',
            'url_draft_artikel' => 'required|url|max:255',
            'draft_artikel' => 'required|mimes:pdf|max:1024',
        ], [
            'berkas_kompre.required' => 'Berkas TA 2 wajib diisi',
            'berkas_kompre.mimes' => 'Berkas TA 2 harus bertipe pdf',
            'berkas_kompre.max' => 'Berkas TA 2 maksimal berukuran 1 MB',
            'periode_seminar.required' => 'Periode seminar wajib diisi',
            'periode_seminar.string' => 'Periode seminar harus berupa string',
            'periode_seminar.max' => 'Periode seminar terlalu panjang',
            'url_draft_artikel.required' => 'URL draft artikel wajib diisi',
            'url_draft_artikel.url' => 'URL draft artikel harus berupa url',
            'url_draft_artikel.max' => 'URL draft artikel terlalu panjang',
            'draft_artikel.required' => 'Draft artikel wajib diisi',
            'draft_artikel.mimes' => 'Draft artikel harus bertipe pdf',
            'draft_artikel.max' => 'Draft artikel maksimal berukuran 1 MB',
        ]);
        $berkas_artikel = $request->file('draft_artikel');
        $nama_artikel = $berkas_artikel->hashName();
        $berkas_artikel->move('uploads/draft_artikel_s2', $nama_artikel);
        $berkas_dua = $request->file('berkas_kompre');
        $nama_berkas = $berkas_dua->hashName();
        $berkas_dua->move('uploads/syarat_seminar_sidang_s2', $nama_berkas);
        $seminarta1 = Auth::user()->mahasiswa->taDuaS2;
        $data = [
            'tahun_akademik' => $seminarta1->tahun_akademik,
            'semester' => $seminarta1->semester,
            'periode_seminar' => $request->periode_seminar,
            'judul_ta' => $seminarta1->judul_ta,
            'sks' => $seminarta1->sks,
            'ipk' => $seminarta1->ipk,
            'toefl' => $seminarta1->toefl,
            'berkas_kompre' => $nama_berkas,
            'url_draft_artikel' => $request->url_draft_artikel,
            'draft_artikel' => $nama_artikel,
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
        $insert = ModelKompreS2::create($data);
        $update = ModelKompreS2::find($insert->id);
        $update->encrypt_id = Crypt::encrypt($insert->id);
        $update->save();
        return redirect()->route('mahasiswa.sidang.kompres2.index')->with('success', 'Berhasil mengajukan Sidang Tesis');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seminar = ModelKompreS2::find(Crypt::decrypt($id));
        $data = [
            'syarat' => BerkasPersyaratanSeminar::find(7),
            'seminar' => $seminar,
            'dosens' => Dosen::where('status', 'Aktif')->get(),
        ];
        return dd($data['seminar']);
        return view("mahasiswaS2.kompre.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSidangTesisS2Request $request, $id)
    {
        $seminar = ModelKompreS2::find(Crypt::decrypt($id));
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
            $seminar->id_pembimbing_2 = null;
            $seminar->pbl2_nama = $request->pbl2_nama;
            $seminar->pbl2_nip = $request->pbl2_nip;
        }
        if ($request->id_pembahas_1 != 'new') {
            $request->validate([
                'id_pembahas_1' => 'required|different:id_pembimbing_1|different:id_pembimbing_2|different:id_pembahas_2|different:id_pembahas_3',
            ], [
                'id_pembahas_1.different' => 'Dosen Tidak Boleh Sama',
                'id_pembahas_1.required' => 'Dosen Pembahas 1 tidak boleh kosong'
            ]);
            $seminar->id_pembahas_1 = Crypt::decrypt($request->id_pembahas_1);
            $seminar->pembahas_external_1 = null;
            $seminar->nip_pembahas_external_1 = null;
        } else {
            $request->validate([
                'pembahas_external_1' => 'required|string|max:255',
                'nip_pembahas_external_1' => 'required|string|max:255',
            ], [
                'pembahas_external_1.required' => 'Nama Pembahas 1 tidak boleh kosong',
                'nip_pembahas_external_1.required' => 'NIP Pembahas 1 tidak boleh kosong',
                'pembahas_external_1.max' => 'Nama Pembahas 1 terlalu panjang',
                'nip_pembahas_external_1.max' => 'NIP Pembahas 1 terlalu panjang',
                'pembahas_external_1.string' => 'Nama Pembahas 1 harus berupa string',
                'nip_pembahas_external_1.string' => 'NIP Pembahas 1 harus berupa string'
            ]);
            $seminar->id_pembahas_1 = null;
            $seminar->pembahas_external_1 = $request->pembahas_external_1;
            $seminar->nip_pembahas_external_1 = $request->nip_pembahas_external_1;
        }
        if ($request->id_pembahas_2 != 'new') {
            $request->validate([
                'id_pembahas_2' => 'required|different:id_pembimbing_1|different:id_pembimbing_2|different:id_pembahas_1|different:id_pembahas_3',
            ], [
                'id_pembahas_2.different' => 'Dosen Tidak Boleh Sama',
                'id_pembahas_2.required' => 'Dosen Pembahas 2 tidak boleh kosong'
            ]);
            $seminar->id_pembahas_2 = Crypt::decrypt($request->id_pembahas_2);
            $seminar->pembahas_external_2 = null;
            $seminar->nip_pembahas_external_2 = null;
        } else {
            $request->validate([
                'pembahas_external_2' => 'required|string|max:255',
                'nip_pembahas_external_2' => 'required|string|max:255',
            ], [
                'pembahas_external_2.required' => 'Nama Pembahas 2 tidak boleh kosong',
                'nip_pembahas_external_2.required' => 'NIP Pembahas 2 tidak boleh kosong',
                'pembahas_external_2.max' => 'Nama Pembahas 2 terlalu panjang',
                'nip_pembahas_external_2.max' => 'NIP Pembahas 2 terlalu panjang',
                'pembahas_external_2.string' => 'Nama Pembahas 2 harus berupa string',
                'nip_pembahas_external_2.string' => 'NIP Pembahas 2 harus berupa string'
            ]);
            $seminar->id_pembahas_2 = null;
            $seminar->pembahas_external_2 = $request->pembahas_external_2;
            $seminar->nip_pembahas_external_2 = $request->nip_pembahas_external_2;
        }
        if ($request->id_pembahas_3 != 'new') {
            $request->validate([
                'id_pembahas_3' => 'required|different:id_pembimbing_1|different:id_pembimbing_2|different:id_pembahas_1|different:id_pembahas_2',
            ], [
                'id_pembahas_3.different' => 'Dosen Tidak Boleh Sama',
                'id_pembahas_3.required' => 'Dosen Pembahas 3 tidak boleh kosong'
            ]);
            $seminar->id_pembahas_3 = Crypt::decrypt($request->id_pembahas_3);
            $seminar->pembahas_external_3 = null;
            $seminar->nip_pembahas_external_3 = null;
        } else {
            $request->validate([
                'pembahas_external_3' => 'required|string|max:255',
                'nip_pembahas_external_3' => 'required|string|max:255',
            ], [
                'pembahas_external_3.required' => 'Nama Pembahas 3 tidak boleh kosong',
                'nip_pembahas_external_3.required' => 'NIP Pembahas 3 tidak boleh kosong',
                'pembahas_external_3.max' => 'Nama Pembahas 3 terlalu panjang',
                'nip_pembahas_external_3.max' => 'NIP Pembahas 3 terlalu panjang',
                'pembahas_external_3.string' => 'Nama Pembahas 3 harus berupa string',
                'nip_pembahas_external_3.string' => 'NIP Pembahas 3 harus berupa string'
            ]);
            $seminar->id_pembahas_3 = null;
            $seminar->pembahas_external_3 = $request->pembahas_external_3;
            $seminar->nip_pembahas_external_3 = $request->nip_pembahas_external_3;
        }
        if ($request->file('berkas_kompre')) {
            unlink('uploads/syarat_seminar_sidang_s2/' . $seminar->berkas_kompre);
            $berkas_dua = $request->file('berkas_kompre');
            $nama_berkas = $berkas_dua->hashName();
            $berkas_dua->move('uploads/syarat_seminar_sidang_s2', $nama_berkas);
            $seminar->berkas_kompre = $nama_berkas;
        }
        if ($request->file('draft_artikel')) {
            unlink('uploads/draft_artikel_s2/' . $seminar->draft_artikel);
            $berkas_artikel = $request->file('draft_artikel');
            $nama_artikel = $berkas_artikel->hashName();
            $berkas_artikel->move('uploads/draft_artikel_s2', $nama_artikel);
            $seminar->draft_artikel = $nama_artikel;
        }
        $seminar->updated_at = date('Y-m-d H:i:s');
        $seminar->save();
        return redirect()->route('mahasiswa.sidang.kompres2.index')->with('success', 'Berhasil mengubah sidang tesis');
    }
}
