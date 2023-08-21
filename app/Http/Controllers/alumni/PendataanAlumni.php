<?php

namespace App\Http\Controllers\alumni;

use App\Http\Requests\StorePendataanAlumniRequest;
use App\Http\Requests\UpdatePendataanAlumniRequest;
use App\Models\Dosen;
use App\Models\ModelPendataanAlumni;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PendataanAlumni extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->mahasiswa->pendataanAlumni == null) {
            return redirect()->route('mahasiswa.pendataan_alumni.create');
        }
        $data = [
            'mahasiswa' => Auth::user()->mahasiswa,
            'pendataan' => Auth::user()->mahasiswa->pendataanAlumni,
        ];


        return view('mahasiswa.alumni.pendataan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->mahasiswa->pendataanAlumni) {
            return redirect()->route('mahasiswa.pendataan_alumni.index');
        }
        $data = [
            'dosens' => Dosen::select('id', 'encrypt_id', 'nama_dosen')->get(),

        ];
        return view('mahasiswa.alumni.pendataan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePendataanAlumniRequest $request)
    {
        //
        $berkas_pengesahan = $request->file('berkas_pengesahan');
        $name_pengesahan = $berkas_pengesahan->hashName();
        $berkas_transkrip = $request->file('transkrip');
        $name_transkrip = $berkas_transkrip->hashName();
        $berkas_toefl = $request->file('berkas_toefl');
        $name_toefl = $berkas_toefl->hashName();
        $berkas_pengesahan->move('uploads/berkas_pengesahan', $name_pengesahan);
        $berkas_transkrip->move('uploads/transkrip', $name_transkrip);
        $berkas_toefl->move('uploads/berkas_toefl', $name_toefl);
        $insert = ModelPendataanAlumni::create([
            'tahun_akademik' => $request->tahun_akademik,
            'sks' => $request->sks,
            'ipk' => $request->ipk,
            'tgl_lulus' => $request->tgl_lulus,
            'masa_studi' => $request->masa_studi,
            'periode_wisuda' => $request->periode_wisuda,
            'toefl' => $request->toefl,
            'berkas_pengesahan' => $name_pengesahan,
            'transkrip' => $name_transkrip,
            'berkas_toefl' => $name_toefl,
            'status' => 'Pending',
            'mahasiswa_id' => Auth::user()->mahasiswa->id,
        ]);
        $id = $insert->id;
        $update = ModelPendataanAlumni::find($id);
        $update->encrypted_id = Crypt::encrypt($id);
        $update->save();
        if (Auth::user()->hasRole('mahasiswa')) {
            return redirect()->route('mahasiswa.pendataan_alumni.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('mahasiswa.pendataan_alumni_S2.index')->with('success', 'Data berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pendataan = ModelPendataanAlumni::find(Crypt::decrypt($id));
        if ($pendataan->mahasiswa_id != Auth::user()->mahasiswa->id) {
            return redirect()->route('mahasiswa.pendataan_alumni.index');
        }
        $data = [
            'mahasiswa' => Auth::user()->mahasiswa,
            'pendataan' => $pendataan,
        ];
        return view('mahasiswa.alumni.pendataan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePendataanAlumniRequest $request, $id)
    {
        //
        $seminar = ModelPendataanAlumni::find(Crypt::decrypt($id));
        if ($seminar->mahasiswa_id != Auth::user()->mahasiswa->id) {
            return redirect()->route('mahasiswa.pendataan_alumni.index');
        }
        $seminar->tahun_akademik = $request->tahun_akademik;
        $seminar->sks = $request->sks;
        $seminar->ipk = $request->ipk;
        $seminar->tgl_lulus = $request->tgl_lulus;
        $seminar->masa_studi = $request->masa_studi;
        $seminar->periode_wisuda = $request->periode_wisuda;
        $seminar->toefl = $request->toefl;
        $seminar->updated_at = date('Y-m-d H:i:s');
        $seminar->komentar = null;
        $seminar->status = 'Pending';
        if ($request->file('berkas_pengesahan')) {
            $oldFile = $seminar->berkas_pengesahan;
            unlink('uploads/berkas_pengesahan/' . $oldFile);
            $file = $request->file('berkas_pengesahan');
            $name = $file->hashName();
            $file->move('uploads/berkas_pengesahan', $name);
            $seminar->berkas_pengesahan = $name;
        }
        if ($request->file('transkrip')) {
            $oldFile = $seminar->transkrip;
            unlink('uploads/transkrip/' . $oldFile);
            $file = $request->file('transkrip');
            $name = $file->hashName();
            $file->move('uploads/transkrip', $name);
            $seminar->transkrip = $name;
        }
        if ($request->file('berkas_toefl')) {
            $oldFile = $seminar->berkas_toefl;
            unlink('uploads/berkas_toefl/' . $oldFile);
            $file = $request->file('berkas_toefl');
            $name = $file->hashName();
            $file->move('uploads/berkas_toefl', $name);
            $seminar->berkas_toefl = $name;
        }
        $seminar->save();
        if (Auth::user()->hasRole('mahasiswa')) {
            return redirect()->route('mahasiswa.pendataan_alumni.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('mahasiswa.pendataan_alumni_S2.index')->with('success', 'Data berhasil diubah');
        }
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
        return redirect()->back();
    }
}
