<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ModelPendataanAlumni;
use Illuminate\Support\Facades\Crypt;

class ValidasiPendataanAlumni extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumni = ModelPendataanAlumni::where('status', 'Pending')->orderBy('updated_at', 'asc')->get();
        return view('admin.admin_berkas.validasi.alumni.index', compact('alumni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'pendataan' => ModelPendataanAlumni::find(Crypt::decrypt($id)),
            'mahasiswa' => ModelPendataanAlumni::find(Crypt::decrypt($id))->mahasiswa,
        ];
        return view('admin.admin_berkas.validasi.alumni.edit', $data);
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

        $pendataan = ModelPendataanAlumni::find(Crypt::decrypt($id));
        if ($request->status == 'Invalid') {
            $request->validate([
                'keterangan' => 'required|min:10|string',
            ], [
                'keterangan.required' => 'Keterangan harus diisi',
                'keterangan.min' => 'Keterangan minimal 10 karakter',
                'keterangan.string' => 'Keterangan harus berupa string',
            ]);
            $pendataan->komentar = $request->keterangan;
            $pendataan->status = $request->status;
            $pendataan->updated_at = date('Y-m-d H:i:s');
            $pendataan->save();
        } else {
            $pendataan->status = $request->status;
            $pendataan->updated_at = date('Y-m-d H:i:s');
            $pendataan->save();
            $mahasiswa = Mahasiswa::find($pendataan->mahasiswa_id);
            $mahasiswa->status = 'Alumni';
            $mahasiswa->save();
            $user = User::find($mahasiswa->user_id);
            if ($user->hasRole('mahasiswa'))
                $user->removeRole('alumni');
            else if ($user->hasRole('mahasiswaS2')) {
                $user->asiignRole('alumniS2');
            }
            $user->save();
        }
        return redirect()->route('berkas.validasi.pendataan_alumni.index')->with('success', 'Data berhasil divalidasi');
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
