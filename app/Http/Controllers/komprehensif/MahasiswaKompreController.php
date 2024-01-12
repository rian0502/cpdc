<?php

namespace App\Http\Controllers\komprehensif;

use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ModelSeminarKompre;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSidangKompreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\BerkasPersyaratanSeminar;
use App\Models\ModelJadwalSeminarKompre;
use JadwalSeminarKomprehensif;

class MahasiswaKompreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kompre = Auth::user()->mahasiswa->komprehensif;
        if ($kompre) {
            $data = [
                'seminar' => $kompre,
                'mahasiswa' => Auth::user()->mahasiswa,
            ];

            return view('mahasiswa.kompre.index', $data);
        }
        return redirect()->route('mahasiswa.sidang.kompre.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->mahasiswa->ta_dua) {
            if (Auth::user()->mahasiswa->ta_dua->status_koor == 'Selesai') {
                if (Auth::user()->mahasiswa->komprehensif) {
                    return redirect()->route('mahasiswa.sidang.kompre.index');
                }
                $data = [
                    'syarat' => BerkasPersyaratanSeminar::find(4)
                ];
                return view('mahasiswa.kompre.create', $data);
            } else {
                return redirect()->route('mahasiswa.seminar.tugas_akhir_2.index')
                    ->with('error', 'Anda belum menyelesaikan seminar tugas akhir 2');
            }
        } else {
            return redirect()->route('mahasiswa.seminar.tugas_akhir_2.index')
                ->with('error', 'Anda belum menyelesaikan seminar tugas akhir 2');
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
        $request->validate([
            'periode_seminar' => ['required'],
            'agreement' => ['required'],
            'berkas_kompre' => ['required', 'mimes:pdf', 'max:2048', 'file', 'mimetypes:application/pdf'],
        ], [
            'periode_seminar.required' => 'Periode seminar tidak boleh kosong',
            'agreement.required' => 'agreement harus di ceklis',
            'berkas_kompre.required' => 'Berkas seminar tidak boleh kosong',
            'berkas_kompre.mimes' => 'Berkas seminar harus berupa pdf',
            'berkas_kompre.max' => 'Berkas seminar maksimal 1MB',
        ]);
        $mahasiswa = Auth::user()->mahasiswa;
        $seminar = $mahasiswa->ta_dua;
        $file = $request->file('berkas_kompre');
        $name_file = $file->hashName();
        $file->move('uploads/syarat_sidang_kompre', $name_file);
        $ta2 = [
            'tahun_akademik' => $seminar->tahun_akademik,
            'semester' => $seminar->semester,
            'periode_seminar' => $request->periode_seminar,
            'judul_ta' => $seminar->judul_ta,
            'sks' => $seminar->sks,
            'ipk' => $seminar->ipk,
            'toefl' => $seminar->toefl,
            'berkas_kompre' => $name_file,
            'agreement' => 1,
            'id_pembimbing_satu' => $seminar->id_pembimbing_satu,
            'id_pembahas' => $seminar->id_pembahas,
            'id_mahasiswa' => $seminar->id_mahasiswa,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if ($seminar->id_pembimbing_dua != null) {
            $ta2['id_pembimbing_dua'] = $seminar->id_pembimbing_dua;
        } else {
            $ta2['pbl2_nama'] = $seminar->pbl2_nama;
            $ta2['pbl2_nip'] = $seminar->pbl2_nip;
        }
        $insert = ModelSeminarKompre::create($ta2);
        $id = $insert->id;
        $update = ModelSeminarKompre::find($id);
        $update->encrypt_id = Crypt::encrypt($id);
        $update->save();
        return redirect()->route('mahasiswa.sidang.kompre.index')
            ->with('success', 'Berhasil mengajukan seminar komprehensif');
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
        return view('mahasiswa.kompre.detail');
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
        $mahasiswa = Auth::user()->mahasiswa;
        $data = [
            'dosens' => Dosen::select('encrypt_id', 'nama_dosen')->get(),
            'seminar' => ModelSeminarKompre::find(Crypt::decrypt($id)),
            'mahasiswa' => $mahasiswa,
        ];
        return view('mahasiswa.kompre.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSidangKompreRequest $request, $id)
    {
        $seminar = ModelSeminarKompre::find(Crypt::decrypt($id));
        if ($seminar->id_mahasiswa != Auth::user()->mahasiswa->id) {
            return redirect()->back();
        }
        $seminar->tahun_akademik = $request->tahun_akademik;
        $seminar->semester = $request->semester;
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

        if ($request->file('berkas_kompre')) {
            $file = $request->file('berkas_kompre');
            $file_name = $file->hashName();
            if (file_exists(('uploads/syarat_sidang_kompre/' . $seminar->berkas_kompre))) {
                unlink(('uploads/syarat_sidang_kompre/' . $seminar->berkas_kompre));
            }
            $seminar->berkas_kompre = $file_name;
            $file->move(('uploads/syarat_sidang_kompre'), $file_name);
        }
        $seminar->updated_at = date('Y-m-d H:i:s');
        $seminar->komentar = null;
        $seminar->status_admin = 'Process';
        $seminar->save();
        return redirect()->route('mahasiswa.sidang.kompre.index')
            ->with('success', 'Berhasil Mengubah data Sidang Komprehensif');
    }
}
