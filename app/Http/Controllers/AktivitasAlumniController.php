<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AktivitasAlumni;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreAktivitasAlumniRequest;

class AktivitasAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->hasRole('alumni')) {
            return redirect()->back();
        }
        $aktivitas = AktivitasAlumni::where('mahasiswa_id', Auth::user()->mahasiswa->id)->orderBy('tahun_masuk', 'desc')->get();
        return view('mahasiswa.alumni.aktivitas.index', compact('aktivitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (!Auth::user()->hasRole('alumni')) {
            return redirect()->back();
        }
        return  view('mahasiswa.alumni.aktivitas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAktivitasAlumniRequest $request)
    {
        if (!Auth::user()->hasRole('alumni')) {
            return redirect()->back();
        }
        $data = [
            'tempat' => Str::title($request->tempat),
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'tahun_masuk' => $request->tanggal_masuk,
            'hubungan' => $request->hubungan,
            'gaji' => $request->gaji,
            'status' => $request->status,
            'mahasiswa_id' => Auth::user()->mahasiswa->id,
        ];
        $insert = AktivitasAlumni::create($data);
        $update = AktivitasAlumni::where('id', $insert->id)->update(['encrypted_id' => Crypt::encrypt($insert->id)]);
        return redirect()->route('mahasiswa.aktivitas_alumni.index')->with('success', 'Aktivitas alumni berhasil ditambahkan');
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
        if (!Auth::user()->hasRole('alumni')) {
            return redirect()->back();
        }
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
        if (!Auth::user()->hasRole('alumni')) {
            return redirect()->back();
        }
        $item = AktivitasAlumni::find(Crypt::decrypt($id));
        if($item->mahasiswa_id != Auth::user()->mahasiswa->id){
            return redirect()->back();
        }
        return  view('mahasiswa.alumni.aktivitas.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAktivitasAlumniRequest $request, $id)
    {
        //
        if (!Auth::user()->hasRole('alumni')) {
            return redirect()->back();
        }
        $aktivitas = AktivitasAlumni::find(Crypt::decrypt($id));
        $aktivitas->tempat = Str::title($request->tempat);
        $aktivitas->alamat = $request->alamat;
        $aktivitas->jabatan = $request->jabatan;
        $aktivitas->tahun_masuk = $request->tanggal_masuk;
        $aktivitas->hubungan = $request->hubungan;
        $aktivitas->gaji = $request->gaji;
        $aktivitas->status = $request->status;
        $aktivitas->updated_at = date('Y-m-d H:i:s');
        $aktivitas->save();
        return redirect()->route('mahasiswa.aktivitas_alumni.index')->with('success', 'Aktivitas alumni berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasRole('alumni')) {
            return redirect()->back();
        }
        $aktivitas = AktivitasAlumni::find(Crypt::decrypt($id));
        if($aktivitas->mahasiswa_id != Auth::user()->mahasiswa->id){
            return redirect()->back();
        }
        $aktivitas->delete();
        return redirect()->route('mahasiswa.aktivitas_alumni.index')->with('success', 'Aktivitas alumni berhasil dihapus');
    }
}
