<?php

namespace App\Http\Controllers\mahasiswa_S2\ta1;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaSatuS2Request;
use App\Models\ModelSeminarTaSatuS2;
use Illuminate\Support\Facades\Auth;
use App\Models\BerkasPersyaratanSeminar;
use Illuminate\Support\Facades\Crypt;

class ControllerMahasiswaS2SeminarTaSatu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $seminar = ModelSeminarTaSatuS2::where('id_mahasiswa', Auth::user()->mahasiswa->id)->first();

        if (!$seminar) {
            return redirect()->route('mahasiswa.seminarta1s2.create');
        }
        $data = [
            'mahasiswa' => Auth::user()->mahasiswa,
            'seminar' => ModelSeminarTaSatuS2::where('id_mahasiswa', Auth::user()->mahasiswa->id)->first(),
        ];
        return view("mahasiswaS2.ta1.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'dosens' => Dosen::where('status', 'Aktif')->get(),
            'syarat' => BerkasPersyaratanSeminar::find(2),
        ];
        return view("mahasiswaS2.ta1.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaSatuS2Request $request)
    {
        //
        $file = $request->file('berkas_seminar_ta_satu');
        $nama_berkas = $file->hashName();
        $file->move('uploads/syarat_seminar_ta_satu_s2', $nama_berkas);
        $data = [
            'tahun_akademik' => $request->tahun_akademik,
            'semester' => $request->semester,
            'sumber_penelitian' => $request->sumber_penelitian,
            'periode_seminar' => $request->periode_seminar,
            'judul_ta' => $request->judul_ta,
            'sks' => $request->sks,
            'ipk' => $request->ipk,
            'toefl' => $request->toefl,
            'berkas_ta_satu' => $nama_berkas,
            'agreement' => 1,
            'id_pembimbing_1' => Crypt::decrypt($request->id_pembimbing_satu),
            'id_mahasiswa' => Auth::user()->mahasiswa->id,
        ];
        if ($request->id_pembimbing_dua != 'new') {
            $data['id_pembimbing_2'] = Crypt::decrypt($request->id_pembimbing_dua);
        } else {
            $request->validate([
                'pbl2_nama' => ['required', 'string', 'max:255'],
                'pbl2_nip' => ['required', 'string', 'max:255'],
            ], [
                'pbl2_nama.required' => 'Nama Pembimbing 2 harus diisi',
                'pbl2_nama.string' => 'Nama Pembimbing 2 harus berupa kata',
                'pbl2_nama.max' => 'Nama Pembimbing 2 maksimal 255 karakter',
                'pbl2_nip.required' => 'NIP Pembimbing 2 harus diisi',
                'pbl2_nip.string' => 'NIP Pembimbing 2 harus berupa kata',
                'pbl2_nip.max' => 'NIP Pembimbing 2 maksimal 255 karakter'
            ]);
            $data['pbl2_nama'] = $request->pbl2_nama;
            $data['pbl2_nip'] = $request->pbl2_nip;
        }
        //cek apakah pembahas 1 dari luar
        if ($request->id_pembahas_satu != 'new') {
            $request->validate([
                'id_pembahas_satu' => ['required', 'exists:dosen,encrypt_id'],
            ], [
                'id_pembahas_satu.required' => 'Pembahas 1 harus diisi',
                'id_pembahas_satu.exists' => 'Pembahas 1 tidak valid'
            ]);
            $data['id_pembahas_1'] = Crypt::decrypt($request->id_pembahas_satu);
        } else {
            $request->validate([
                'phs1_nama' => ['required', 'string', 'max:255'],
                'phs1_nip' => ['required', 'string', 'max:255'],
            ], [
                'phs1_nama.required' => 'Nama Pembahas 1 harus diisi',
                'phs1_nama.string' => 'Nama Pembahas 1 harus berupa kata',
                'phs1_nama.max' => 'Nama Pembahas 1 maksimal 255 karakter',
                'phs1_nip.required' => 'NIP Pembahas 1 harus diisi',
                'phs1_nip.string' => 'NIP Pembahas 1 harus berupa kata',
                'phs1_nip.max' => 'NIP Pembahas 1 maksimal 255 karakter'
            ]);
            $data['pembahas_external_1'] = $request->phs1_nama;
            $data['nip_pembahas_external_1'] = $request->phs1_nip;
        }
        //check apakah pembhas 2 dari luar
        if ($request->id_pembahas_dua != 'new') {
            $request->validate([
                'id_pembahas_dua' => ['required', 'exists:dosen,encrypt_id'],
            ], [
                'id_pembahas_dua.required' => 'Pembahas 1 harus diisi',
                'id_pembahas_dua.exists' => 'Pembahas 1 tidak valid'
            ]);
            $data['id_pembahas_2'] = Crypt::decrypt($request->id_pembahas_dua);
        } else {
            $request->validate([
                'phs2_nama' => ['required', 'string', 'max:255'],
                'phs2_nip' => ['required', 'string', 'max:255'],
            ], [
                'phs2_nama.required' => 'Nama Pembahas 1 harus diisi',
                'phs2_nama.string' => 'Nama Pembahas 1 harus berupa kata',
                'phs2_nama.max' => 'Nama Pembahas 1 maksimal 255 karakter',
                'phs2_nip.required' => 'NIP Pembahas 1 harus diisi',
                'phs2_nip.string' => 'NIP Pembahas 1 harus berupa kata',
                'phs2_nip.max' => 'NIP Pembahas 1 maksimal 255 karakter'
            ]);
            $data['pembahas_external_2'] = $request->phs2_nama;
            $data['nip_pembahas_external_2'] = $request->phs2_nip;
        }
        //check apakah pembhas 3 dari luar
        if ($request->id_pembahas_dua != 'new') {
            $request->validate([
                'id_pembahas_tiga' => ['required', 'exists:dosen,encrypt_id'],
            ], [
                'id_pembahas_tiga.required' => 'Pembahas 1 harus diisi',
                'id_pembahas_tiga.exists' => 'Pembahas 1 tidak valid'
            ]);
            $data['id_pembahas_3'] = Crypt::decrypt($request->id_pembahas_tiga);
        } else {
            $request->validate([
                'phs3_nama' => ['required', 'string', 'max:255'],
                'phs3_nip' => ['required', 'string', 'max:255'],
            ], [
                'phs3_nama.required' => 'Nama Pembahas 1 harus diisi',
                'phs3_nama.string' => 'Nama Pembahas 1 harus berupa kata',
                'phs3_nama.max' => 'Nama Pembahas 1 maksimal 255 karakter',
                'phs3_nip.required' => 'NIP Pembahas 1 harus diisi',
                'phs3_nip.string' => 'NIP Pembahas 1 harus berupa kata',
                'phs3_nip.max' => 'NIP Pembahas 1 maksimal 255 karakter'
            ]);
            $data['pembahas_external_3'] = $request->phs3_nama;
            $data['nip_pembahas_external_3'] = $request->phs3_nip;
        }
        $insert = ModelSeminarTaSatuS2::create($data);
        $update = ModelSeminarTaSatuS2::find($insert->id);
        $update->encrypt_id = Crypt::encrypt($insert->id);
        $update->save(); 
        return redirect()->route('mahasiswa.seminarta1s2.index')->with('success', 'Data Seminar TA 1 berhasil ditambahkan');
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
        //
        $seminar = ModelSeminarTaSatuS2::find(Crypt::decrypt($id));
        $mahasiswa = Auth::user()->mahasiswa;
        $data = [
            'mahasiswa' => $mahasiswa,
            'seminar' => $seminar,
            'dosens' => Dosen::where('status', 'Aktif')->get(),
            'syarat' => BerkasPersyaratanSeminar::find(2),
        ];

        return view("mahasiswaS2.ta1.edit", $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
